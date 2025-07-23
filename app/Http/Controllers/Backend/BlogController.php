<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Show all blogs
    public function index()
    {
        $blogs = Blog::with(['author', 'category'])->latest()->paginate(10);
        return view('backend.blogs.index', compact('blogs'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('backend.blogs.create', compact('categories'));
    }

    // Store a new blog
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['author_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('blogs.list')->with('success', 'Blog created successfully!');
    }

    // Show edit form
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('backend.blogs.edit', compact('blog', 'categories'));
    }

    // Update blog
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('blogs.list')->with('success', 'Blog updated successfully!');
    }

    // Delete blog
    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();
        return redirect()->route('blogs.list')->with('success', 'Blog deleted successfully!');
    }
}
