<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function gridSidebar(Request $request)
    {
        $query = Blog::with('category')->latest();

        // Filter by category if selected
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        $blogs = $query->paginate(10);

        $featuredBlogs = Blog::latest()->take(3)->get();
        $categories = Category::withCount('blogs')->orderByDesc('blogs_count')->get();

        return view('frontend.blog.blog-grid-sidebar', compact('blogs', 'featuredBlogs', 'categories'));
    }
    public function show($slug)
    {

        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();
        $categories = Category::withCount('blogs')->orderByDesc('blogs_count')->get();
        $featuredBlogs = Blog::latest()->take(3)->get();
        return view('frontend.blog.blog-single-sidebar', compact('blog', 'featuredBlogs', 'categories'));
    }
    public function single($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();

        return view('frontend.blog.blog-single', compact('blog'));
    }



    public function singleSidebar()
    {
        $blog = Blog::with('category')->firstOrFail();
        $featuredBlogs = Blog::latest()->take(3)->get();
        $categories = Category::withCount('blogs')->orderByDesc('blogs_count')->get();

        return view('frontend.blog.blog-single-sidebar', compact('blog', 'featuredBlogs', 'categories'));
    }
}
