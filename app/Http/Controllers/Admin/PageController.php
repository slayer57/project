<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::oldest('id')->paginate(10);
        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePageRequest $request)
    {
        $input = $request->all();
        $input['image'] = $this->fileUpload($request, 'image');
        $input['banner_image'] = $this->fileUpload($request, 'banner_image');
        $page =  Page::create($input);
        $page->update(['slug' => Str::slug($request->title)]);
        return redirect()->route('admin.pages.index')->with('message', 'Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        $old_image = $page->image;
        $old_banner_image = $page->banner_image;
        $input = $request->all();
        $image = $this->fileUpload($request, 'image');
        $banner_image = $this->fileUpload($request, 'banner_image');

        if ($image) {
            $this->removeFile($old_image);
            $input['image'] = $image;
        } else {
            unset($input['image']);
        }

        if ($banner_image) {
            $this->removeFile($old_banner_image);
            $input['banner_image'] = $banner_image;
        } else {
            unset($input['banner_image']);
        }

        $input['slug'] = Str::slug($request->title);
        $page->update($input);
        return redirect()->route('admin.pages.index')->with('message', 'Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->removeFile($page->image);
        $this->removeFile($page->banner_image);
        $page->delete();
        return redirect()->route('admin.pages.index')->with('message', 'Delete Successfully');
    }

    public function fileUpload(Request $request, $name)
    {
        $imageName = '';
        if ($image = $request->file($name)) {
            $destinationPath = public_path() . '/admin/images/page';
            $imageName = date('YmdHis') . $name . "-" . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $image = $imageName;
        }
        return $imageName;
    }

    public function removeFile($file)
    {
        $path = public_path() . '/admin/images/page/' . $file;
        if (File::exists($path)) {
            File::delete($path);
        }
    }
}
