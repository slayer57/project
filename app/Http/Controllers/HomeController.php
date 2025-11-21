<?php

namespace App\Http\Controllers;

use App\Mail\DemoEmail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Departure;
use App\Models\Destination;
use App\Models\Order;
use App\Models\Package;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::count();
        $products = Product::count();
        $orders = Order::count();
        $blogs = Blog::count();
        return view('admin.dashboard', compact('categories', 'products', 'orders', 'blogs'));
    }
}
