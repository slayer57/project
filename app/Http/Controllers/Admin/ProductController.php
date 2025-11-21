<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when($request->search, function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);

        $searchParams =  $_GET ?? '';
        return view('admin.product.index', compact('products', 'searchParams'));
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
        return redirect()->route('admin.products.edit', $product->id);
    }

    public function edit(Product $product)
    {
        $categories = Category::where('parent_id', 0)->get();
        $gallery = ProductGallery::where('product_id', $product->id)->get();
        $productCategories = ProductCategory::where('product_id', $product->id)->pluck('category_id')->toArray();

        return view('admin.product.edit', compact('product', 'categories', 'gallery', 'productCategories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($request->name);

        if ($request->discount && $request->mrp) {
            $input['price'] = priceAfterDiscount($request->mrp, $request->discount);
        } else {
            $input['price'] = $request->mrp;
        }
        $input['is_popular'] = $request->is_popular ? 1 : 0;

        $product->update($input);

        $product->categories()->detach();
        $product->categories()->attach($request->category);

        return redirect()->back()->with('success', 'Product Updated');
    }

    public function destroy(Product $product)
    {
        $this->removeFile($product->featured_image);
        $product->delete();

        //delete galleries according to product
        $galleries = $product->galleries()->get();
        foreach ($galleries as $g) {
            $this->removeFile($g->image);
        }
        $product->galleries()->delete();

        return redirect()->route('admin.products.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/product';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/product/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }


    public function featuredImage(Request $request, Product $product)
    {
        $featured_image = $this->fileUpload($request, 'file');
        if ($featured_image) {
            $this->removeFile($product->featured_image);
            $input['featured_image'] = $featured_image;
            $product->update($input);
        }

        return 'success';
    }

    public function gallery(Request $request, Product $product)
    {
        $image = $this->fileUpload($request, 'file');
        if ($image) {
            $this->removeFile($product->image);
            $input['image'] = $image;
            $input['product_id'] = $product->id;
            ProductGallery::create($input);
        }
        return 'success';
    }

    public function imageDelete($id, $type)
    {
        if ($type == 'featured') {
            $product = Product::where('id', $id)->first();
            $this->removeFile($product->featured_image);
            $product->update(['featured_image' => '']);
        }

        if ($type == 'gallery') {
            $productGallery = ProductGallery::where('id', $id)->first();
            $this->removeFile($productGallery->image);
            $productGallery->delete();
        }

        // return redirect()->back()->with('success', 'Image Deleted');
    }

    public function productReview(Product $product)
    {
        $reviews = ProductReview::where('product_id', $product->id)->latest()->paginate(15);
        return view('admin.product.review.index', compact('reviews', 'product'));
    }

    public function productReviewEdit(ProductReview $review)
    {
        return view('admin.product.review.edit-review', compact('review'));
    }

    public function productReviewUpdate(Request $request, ProductReview $review)
    {
        $review->update(
            ['status' => $request->status]
        );
        return redirect()->route('admin.product.review', $review->product_id)->with('success', 'Review Updated');
    }

    public function productReviewDestroy(ProductReview $review)
    {
        $review->delete();
        return redirect()->route('admin.product.review', $review->product_id)->with('success', 'Review Deleted');
    }
}
