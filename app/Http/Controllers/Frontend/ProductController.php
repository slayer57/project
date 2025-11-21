<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($slug)
    {
        $productdetail = Product::where('slug', $slug)->first();
        $recommended_products = Product::where('status', 1)->inRandomOrder()->limit(6)->latest()->get();
        $cart = \Cart::get($productdetail->id);
        $reviews = ProductReview::where('product_id', $productdetail->id)->where('status', 1)->get();

        $total_rating = $productdetail->reviews->sum('rating');;
        // dd($reviews);
        return view('frontend.product.show', compact('recommended_products', 'productdetail',  'cart', 'reviews', 'total_rating'));
    }

    public function categoryWise(Request $request, $slug)
    {
        $paginate = $request->paginate ?? 12;
        $sort = $request->sort ?? 'asc';
        $products = Product::select('products.*')->distinct('products.id');
        $data = '';

        $category = getCategoryFromSlug($slug);
        $category_ids = getAllChildCategories($slug);
        if ($category_ids) {
            $data = 1;
            $products = $products->join('product_categories', 'product_categories.product_id', '=', 'products.id')
                ->join('categories', 'categories.id', '=', 'product_categories.category_id')
                ->whereIn('product_categories.category_id', $category_ids);
        }

        if (isset($_GET['sort']) && $_GET['sort']) {
            $products = $products->orderBy('price', $sort);
        }

        if (isset($_GET['min_price']) && $_GET['min_price']) {
            $products = $products->where('products.price', '>=', $_GET['min_price']);
        }
        if (isset($_GET['max_price']) && $_GET['max_price']) {
            $products = $products->where('products.price', '<=', $_GET['max_price']);
        }

        $products = $products->paginate($paginate);
        $searchParams =  $_GET ?? '';
        return view('frontend.product.category-wise', compact('products', 'searchParams', 'category'));
    }

    public function index(Request $request)
    {
        $paginate = $request->paginate ?? 12;
        $sort = $request->sort ?? 'asc';

        $products = Product::where('status', 1)
            ->when(($request->search), function ($query) use ($request) {
                return $query->where('name', 'LIKE', '%' . $request->search . '%');
            })
            ->when(($request->min_price), function ($query) use ($request) {
                return $query->where('price', '>=', $request->min_price);
            })
            ->when(($request->max_price), function ($query) use ($request) {
                return $query->where('price', '<=', $request->max_price);
            })
            ->when(($sort), function ($query) use ($request, $sort) {
                return $query->orderBy('price', $sort);
            })
            ->paginate($paginate);
        $params = $_GET ?? '';
        return view('frontend.product.index', compact('products', 'params'));
    }
}
