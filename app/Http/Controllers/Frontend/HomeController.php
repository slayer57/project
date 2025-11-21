<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\StoreInquiryRequest;
use App\Models\Inquiry;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SocialMedia;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        $p_category = getParentCategories();
        $new_arrivals_products = Product::where('status', 1)->inRandomOrder()->limit(6)->latest()->get();
        $popular_products = Product::where('status', 1)->where('is_popular', 1)->inRandomOrder()->limit(6)->get();
        $sliders = Slider::oldest('order')->get();
        return view('frontend.index', compact('new_arrivals_products', 'popular_products', 'sliders', 'p_category'));
    }

    public function contact()
    {
        $socialmedias = SocialMedia::get();
        return view('frontend.contact', compact('socialmedias'));
    }

    public function inquiry(StoreInquiryRequest $request)
    {
        Inquiry::create($request->all());
        return redirect()->back()->with('message', 'Thank you, your enquiry has been Submitted Successfully');
    }

    public function pageDetail($slug)
    {
        $pagedetail = Page::where('slug', $slug)->first();
        return view('frontend.page', compact('pagedetail'));
    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Product::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
}
