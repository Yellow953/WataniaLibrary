<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();
        $products = Product::select('id', 'name', 'image')->get();

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
        $categories = Category::select('id', 'name', 'image')->where('parent_id', null)->with('subCategories')->get();

        if ($request->input('category')) {
            $category = Category::where('name', $request->input('category'))->firstOrFail();
            $products = Product::select('id', 'name', 'category_id', 'image')->where('category_id', $category->id)->paginate(12);
        } else {
            $products = Product::select('id', 'name', 'category_id', 'image')->paginate(12);
        }

        $data = compact('categories', 'products');
        return view('frontend.shop', $data);
    }

    public function product(Product $product)
    {
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
            'phone' => 'required|string|max:30|unique:users,phone',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zip' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
            'shipping' => 'required|numeric|min:1',
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

        DB::beginTransaction();
        try {
            $user = User::firstOrCreate(
                ['phone' => $request->phone],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'zip' => $request->zip,
                    'password' => bcrypt('password'),
                ]
            );

            $order = Order::create([
                'client_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'payment_method' => $request->payment_method,
                'sub_total' => $subTotal,
                'total' => $total,
                'products_count' => $productsCount,
                'notes' => $request->notes,
                'status' => 'new',
            ]);

            // Create order items
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

            $this->sendOrderEmails($order, $user);

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

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->take(5)
            ->get(['id', 'name', 'image']);

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

    private function sendOrderEmails(Order $order, User $user)
    {
        if ($user->email) {
            Mail::send('emails.order-confirmation', ['order' => $order, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Order Confirmation');
            });
        }

        Mail::send('emails.order-notification', ['order' => $order], function ($message) {
            $message->to('watania.library@gmail.com')
                ->subject('New Order Notification');
        });
    }
}
