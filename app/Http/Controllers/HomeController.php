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
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();

        // Collections
        $art_materials = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['3154148454182', '3167868323560', '4005401134220', '4005405542212', '4260192961336', '5907690865719', '6949905294975', '6971479810503', '6971479810633', '6971479810657', '6976272010389', '8003511423247', '8901765096050']);
            })
            ->get();
        $backpacks = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['529113416077', '5205698729836', '5205698759086', '5291134176098', '8002047095966', '9332934353312', '9332934359840', '9332934370623']);
            })
            ->get();
        $lunchs = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['3154148707011', '5205698759345', '5285011930088', '8904042647327', '9332934320802', '9332934323476', '9332934370739', '9332934383920']);
            })
            ->get();
        $pencil_cases = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['1234201580965', '5205698729508', '5205698759840', '5903235650994', '5903235651380', '5903235667527', '9332934384392', '9332934387638']);
            })
            ->get();
        $stationaries = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['3154140178116', '3154140511111', '3154149818679', '4902778913956', '6936699710132', '6941250541858', '6968581247012', '8003511330064', '8901765590954']);
            })
            ->get();
        $toys = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['000013870867', '5010993431878', '6901234566307', '6920062101184', '6987558961110', '8681842235052']);
            })
            ->get();
        $water_bottles = Product::select('id', 'name', 'image', 'price')
            ->where('public', true)
            ->where('quantity', '>=', 0)
            ->whereHas('barcodes', function ($query) {
                $query->whereIn('barcode', ['015205010105', '1234601574175', '5205698735455', '5205698735547', '5285011930040', '8681655543320', '8901765114556']);
            })
            ->get();

        $data = compact('categories', 'art_materials', 'backpacks', 'lunchs', 'pencil_cases', 'stationaries', 'toys', 'water_bottles');
        return view('frontend.index', $data);
    }

    public function about()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();
        return view('frontend.about', compact('categories'));
    }

    public function contact()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();
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
            ->limit(6)
            ->with('subCategories')
            ->get();

        $productsQuery = Product::select('id', 'name', 'category_id', 'image', 'price')->where('public', true)->where('quantity', '>', 0);

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

        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();
        $simillar_products = Product::select('id', 'name', 'image')->where('category_id', $product->category_id)->where('quantity', '>', 0)->limit(10)->get();

        $data = compact('product', 'simillar_products', 'categories');
        return view('frontend.product', $data);
    }

    public function checkout()
    {
        $countries = Helper::get_countries();
        $cities = Helper::get_cities();
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();

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

        $products = Product::where('name', 'like', '%' . $query . '%')->where('public', true)->where('quantity', '>', 0)->take(5)->get(['id', 'name', 'image']);

        $products = $products->map(function ($product) {
            $product->url = route('product', $product->name);
            return $product;
        });

        return response()->json($products);
    }

    public function privacy_policy()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();
        return view('frontend.policies.privacy_policy', compact('categories'));
    }

    public function return_policy()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();
        return view('frontend.policies.return_policy', compact('categories'));
    }

    public function terms_and_conditions()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->limit(6)->with('subCategories')->get();
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
