<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        $products = Product::select('id', 'name', 'image')->where('public', true)->get();

        $data = compact('categories', 'products');
        return view('frontend.index', $data);
    }

    public function about()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        return view('frontend.about', compact('categories'));
    }

    public function contact()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        return view('frontend.contact', compact('categories'));
    }

    public function contact_send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:12',
            'message' => 'required|string',
            'spam' => 'required|numeric',
        ]);

        if ($request->spam == 19) {
            $data = $request->all();

            Mail::send('emails.contact', ['data' => $data,], function ($message) {
                $message->to('watania.library@gmail.com')
                    ->subject('New Contact');
            });

            return redirect()->back()->with('success', 'Contact Form Submitted Successfully');
        } else {
            return redirect()->back()->with('error', 'Unable to Send...');
        }
    }

    public function shop(Request $request)
    {
        $categories = Category::select('id', 'name', 'image')
            ->whereNull('parent_id')
            ->with('subCategories')
            ->get();

        $productsQuery = Product::select('id', 'name', 'category_id', 'image', 'price')->where('public', true);

        if ($request->filled('category')) {
            $category = Category::where('name', urldecode($request->input('category')))->firstOrFail();
            $categoryIds = $this->getAllCategoryIds($category);
            $productsQuery->whereIn('category_id', $categoryIds);
        }

        if ($request->filled('price_min')) {
            $productsQuery->where('price', '>=', $request->input('price_min'));
        }
        if ($request->filled('price_max')) {
            $productsQuery->where('price', '<=', $request->input('price_max'));
        }

        switch ($request->input('sort_by')) {
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $productsQuery->orderBy('name', 'desc');
                break;
            default:
                $productsQuery->latest();
        }

        $products = $productsQuery->paginate(12)->withQueryString();

        return view('frontend.shop', compact('categories', 'products'));
    }

    public function product(Product $product)
    {
        if (!$product->public) return redirect()->back()->with('danger', 'This product is unavailable right now...');

        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        $simillar_products = Product::select('id', 'name', 'image')->where('category_id', $product->category_id)->limit(10)->get();

        $data = compact('product', 'simillar_products', 'categories');
        return view('frontend.product', $data);
    }

    public function checkout()
    {
        $countries = Helper::get_countries();
        $cities = Helper::get_cities();
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();

        $data = compact('countries', 'cities', 'categories');
        return view('frontend.checkout', $data);
    }

    public function order(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'note' => 'nullable|string',
            'shipping' => 'required|numeric|min:0',
        ]);

        $cart = json_decode($request->cart, true);
        if (!$cart || empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $subTotal = 0;
        $productsCount = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
            $productsCount += $item['quantity'];
        }
        $shippingFee = $request->shipping;
        $total = $subTotal + $shippingFee;
        $discount = 0;

        DB::beginTransaction();
        try {
            $client = Client::firstOrCreate(
                ['phone' => $request->phone],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'city' => $request->city,
                    'country' => $request->country,
                    'address' => $request->address,
                ]
            );

            $currency = Currency::where('code', 'USD')->firstOrFail();

            if ($request->promo != null) {
                $promo = Promo::where('code', $request->promo)->first();
                $discount = $total * ($promo->value / 100);
            }

            $order = Order::create([
                'client_id' => $client->id,
                'currency_id' => $currency->id,
                'order_number' => Order::generate_number(),
                'payment_method' => $request->payment_method,
                'sub_total' => $subTotal,
                'discount' => $discount,
                'total' => $total - $discount,
                'products_count' => $productsCount,
                'note' => $request->note,
            ]);

            foreach ($cart as $item) {
                $product = Product::findOrFail($item['id']);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            $this->sendOrderEmails($order, $client);

            setcookie('cart', '', time() - 3600, '/');

            return redirect()->back()->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('name', 'like', '%' . $query . '%')->where('public', true)->take(5)->get(['id', 'name', 'image']);

        $products = $products->map(function ($product) {
            $product->url = route('product', $product->name);
            return $product;
        });

        return response()->json($products);
    }

    public function privacy_policy()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        return view('frontend.policies.privacy_policy', compact('categories'));
    }

    public function return_policy()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        return view('frontend.policies.return_policy', compact('categories'));
    }

    public function terms_and_conditions()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        return view('frontend.policies.terms_conditions', compact('categories'));
    }

    public function check(Request $request)
    {
        $promo = Promo::where('code', $request->promo)->first();

        if ($promo) {
            return response()->json(['exists' => true, 'value' => $promo->value / 100]);
        } else {
            return response()->json(['exists' => false]);
        }
    }

    private function sendOrderEmails(Order $order, Client $client)
    {
        if ($client->email) {
            Mail::send('emails.order-confirmation', ['order' => $order, 'client' => $client], function ($message) use ($client) {
                $message->to($client->email)
                    ->subject('Order Confirmation');
            });
        }

        Mail::send('emails.order-notification', ['order' => $order], function ($message) {
            $message->to('watania.library@gmail.com')
                ->subject('New Order Notification');
        });
    }

    private function getAllCategoryIds($category)
    {
        $ids = [$category->id];

        foreach ($category->subCategories as $child) {
            $ids = array_merge($ids, $this->getAllCategoryIds($child));
        }

        return $ids;
    }
}
