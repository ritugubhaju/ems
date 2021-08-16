<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use App\Models\Blog\Blog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{

    public function homepage()
    {
        $blogs = Blog::where('is_published', 1)->where('is_featured', 1)->get();
        return view('frontend.home', compact('blogs'));
    }

    public function customerForm()
    {
       
        return view('frontend.customer.form');
    }
}
