<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('categories')->paginate(5);
        // echo '<pre>';
        // print_r($posts->toArray());
        // exit;

         // If a date is provided in the request, filter posts based on that date
        if ($request->has('date')) {
            $selectedDate = $request->input('date');
            $posts = Post::whereDate('created_at', $selectedDate)->paginate(5);
        }
        return view('post.index', compact('posts'));
    }
    public function create(){
        $categories = Category::all();
        $data = compact('categories');
        return view('post.create',$data);
    }
    public function store(Request $request)
    {
        // print_r($request->toArray());                                
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'category_id' => 'required|array',
            'category_id.*' => 'exists:categories,id' 
        ]);

        if($validator){
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->content;
            $post->status = $request->status;

            
            $post->save();
            
            // Handling multiple category IDs
            $post->categories()->attach($request['category_id']);

            return redirect()->route('post.index')->with('success', 'Post created successfully.');

        }

    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $validator = $request->validate ([
            'title' => 'required|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,published,archived',
        ]);


        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->status = $request->status;

        
        $post->save();
        
        $post->categories()->sync($request->category_id);
        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }
    public function filterByDate(Request $request) {
        $selectedDate = $request->input('date');
    
        // Query the database to filter posts based on the selected date
        $posts = Post::whereDate('created_at', $selectedDate)->paginate(5);
    
        return view('post.index', compact('posts'));
    }

}
