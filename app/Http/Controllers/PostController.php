<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        //dd(123);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'text' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->text = $request->text;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;

            $file->move('img_uploaded/', $filename);
            $post->img = $filename;
        }

        $post->save();

        return redirect('/admin')->with('success', "Ma'lumot muvvafaqiyatli qo'shildi");
    }
    public function update(Request $request, int $id)
    {
        //dd($id);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'text' => 'required|string',
            'img' => 'image|mimes:jpeg,png,jpg,gif',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->text = $request->text;

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $filename = date("Y-m-d") . '_' . time() . '.' . $extension;

            $file->move('img_uploaded/', $filename);

            $post->img = $filename;
        }

        $post->save();

        return redirect('/admin')->with('success', "Ma'lumot muvvafaqiyatli yangilandi");
    }
    public function delete(int $id)
    {
        //dd(123);
        $post = Post::find($id);

        if ($post) {
            $post->delete();
            return redirect()->back()->with('success', 'Post deleted successfully.');
        }

        return redirect()->back()->with('error', 'Category not found.');
    }
}
