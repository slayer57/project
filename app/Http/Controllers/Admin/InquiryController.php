<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(10);
        return view('admin.inquiry.index', compact('inquiries'));
    }

    public function destroy(Inquiry $inquiryperson)
    {
        $inquiryperson->delete();
        return redirect()->route('admin.inquirypersons.index')->with('message', 'Delete Successfully');
    }
}
