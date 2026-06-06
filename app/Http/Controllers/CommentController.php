<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000',
        ]);

        Comment::create([
            'user_id' => auth()->id(), // L'ID de la personne connectée
            'post_id' => $post_id,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Votre avis a bien été publié !');
    }
}