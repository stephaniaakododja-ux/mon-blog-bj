<?php

namespace App\Http\Controllers;

// LES DOSSIERS D'IMPORTATION DOIVENT ÊTRE ICI (EN DEHORS DE LA CLASSE) :
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // On récupère le mot-clé tapé dans la barre de recherche
        $search = $request->input('search');

        // On commence par la requête de base
        $query = Post::with('category')->where('is_published', true);

        // Si l'utilisateur a tapé quelque chose, on filtre !
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%");
            });
        }

        // On récupère les résultats
        $posts = $query->latest()->get();

        return view('home', compact('posts'));
    }
}