<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest();
        $parent = 0;
        $parentCategory = '';
        if (isset($_GET['parent']) && $_GET['parent']) {
            $categories = $categories->where('parent_id', $_GET['parent']);
            $parent = $_GET['parent'];
            $parentCategory = Category::findOrFail($parent);
        } else {
            $categories = $categories->where('parent_id', 0);
        }

        $categories = $categories->paginate(10);

        $params = array('parent' => $parent); // for sub categories pagination
        return view('admin.category.index', compact('categories', 'parent', 'parentCategory', 'params'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $input = $request->except('image', 'banner_image');
        $input['image'] = $this->fileUpload($request, 'image');
        $input['banner_image'] = $this->fileUpload($request, 'banner_image');

        // for unique slug
        $slug = $request->name;
        if ($request->parent_id) {
            $parentId = $this->getParentCategoryId($request->parent_id);
            $parentCategory = Category::where('id', $parentId)->first();
            $slug = $parentCategory->name . '-' . $request->name;
        }
        $input['slug'] = Str::slug($slug);
        Category::create($input);

        if ($request->parent_id) {
            return redirect()->route('admin.categories.index', ['parent' => $request->parent_id])->with('success', 'New Category Created');
        }
        return redirect()->route('admin.categories.index')->with('success', 'New Category Created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $input = $request->except('image', 'banner_image');
        $image = $this->fileUpload($request, 'image');
        if ($image) {
            $this->removeFile($category->image);
            $input['image'] = $image;
        }

        $banner = $this->fileUpload($request, 'banner_image');
        if ($banner) {
            $this->removeFile($category->banner_image);
            $input['banner_image'] = $banner;
        }

        // for unique slug
        $slug = $request->name;
        if ($request->parent_id) {
            $parentId = $this->getParentCategoryId($request->parent_id);
            $parentCategory = Category::where('id', $parentId)->first();
            $slug = $parentCategory->name . '-' . $request->name;
        }
        $input['slug'] = Str::slug($slug);
        $input['status'] = $request->status ? 1 : 0;
        $input['is_featured'] = $request->is_featured ? 1 : 0;
        $category->update($input);

        if ($request->parent_id) {
            return redirect()->route('admin.categories.index', ['parent' => $request->parent_id])->with('success', 'Category Updated');
        }
        return redirect()->route('admin.categories.index')->with('success', 'Category Updated');
    }


    public function destroy(Category $category)
    {
        $this->removeFile($category->image);
        $this->removeFile($category->banner_image);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/category';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/category/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public function getParentCategoryId($parent_id)
    {
        $category = Category::where('id', $parent_id)->first();

        if ($category->parent_id != 0) {
            return $this->getParentCategoryId($category->parent_id);
        }

        return $category->id;
    }
}
