<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // 1. Afficher les articles avec filtres (Recherche et Catégories)
 public function index(Request $request)
{
    // On charge la requête de base
    $query = Post::with(['category', 'likes'])->where('is_published', true);
    $query = Post::with(['category', 'likes', 'comments'])->where('is_published', true);

    // 🔍 Filtre Recherche
    if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%')
              ->orWhere('content', 'like', '%' . $request->search . '%');
        });
    }

    // 📂 Filtre Catégorie (Correction ici avec whereHas ou filtrage direct propre)
    if ($request->filled('category')) {
        $categoryId = $request->category;
        $query->where('category_id', $categoryId);
    }

    $posts = $query->latest()->get();

    return view('home', compact('posts'));
}

    // 2. Afficher le formulaire de création d'un article
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // 3. Enregistrer un nouvel article dans la base de données
   public function store(Request $request)
{
    // 1. Validation des données
    $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // 2. Gestion de l'image
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
    }

    // 3. Création de l'article en base de données
    \App\Models\Post::create([
        'title' => $request->title,
        'slug' => \Illuminate\Support\Str::slug($request->title) . '-' . rand(100, 999),
        'content' => $request->content,
        'category_id' => $request->category_id,
        'image' => $imagePath,
        'user_id' => auth()->id(),
        'is_published' => true,
    ]);

    // 4. Redirection vers l'accueil avec succès
    return redirect()->route('home')->with('success', 'Ton article sur le Amiwô est maintenant en ligne ! ✨');
}

    // 4. Afficher un article unique (Page de lecture)
    // Dans PostController.php, méthode show()
public function show($slug)
{
    // Ajoute 'user' dans le tableau with() pour charger l'auteur en même temps
    $post = \App\Models\Post::with(['category', 'comments.user', 'likes', 'user'])->where('slug', $slug)->firstOrFail();
    
    return view('posts.show', compact('post'));
}

    // 5. Gérer les mentions J'aime (Le bouton cœur rouge ❤️)
public function like(Post $post)
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $userId = auth()->id();

    $existingLike = Like::where('user_id', $userId)
                        ->where('post_id', $post->id)
                        ->first();

    if ($existingLike) {
        $existingLike->delete();
        $message = "Mention J'aime retirée !";
    } else {
        Like::create([
            'user_id' => $userId,
            'post_id' => $post->id,
        ]);
        $message = "Article aimé ! ❤️";
    }

    return redirect()->back()->with('success', $message);
}

    // 6. Ajouter un commentaire sous un article
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000',
        ]);

        Comment::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Ton avis a bien été publié ! 💬');
    }
    // 7. Afficher la page de toutes les catégories
    public function categories()
    {
        $categories = Category::withCount('posts')->get();
        return view('categories.index', compact('categories'));
    }

    // 8. Afficher les articles d'une catégorie spécifique
    public function showCategory($id)
    {
        // On récupère la catégorie demandée, ou erreur 404 si elle n'existe pas
        $category = Category::findOrFail($id);

        // On récupère uniquement les articles liés à cette catégorie
        $posts = Post::with(['category', 'likes'])
                     ->where('category_id', $id)
                     ->where('is_published', true)
                     ->latest()
                     ->get();

        return view('categories.show', compact('category', 'posts'));
    }
public function edit($slug)
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $post = Post::where('slug', $slug)->firstOrFail();
    $categories = Category::all();

    return view('posts.edit', compact('post', 'categories'));
}
public function deleteComment(Comment $comment)
{
    // L'auteur du commentaire OU l'admin peut supprimer
    if (auth()->id() !== $comment->user_id && !auth()->user()->is_admin) {
        abort(403);
    }

    $comment->delete();

    return redirect()->back()->with('success', 'Commentaire supprimé.');
}
public function destroy(Post $post)
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    // Supprimer l'image si elle existe
    if ($post->image) {
        \Storage::disk('public')->delete($post->image);
    }

    $post->delete();

    return redirect()->route('home')->with('success', 'Article supprimé.');
}
public function update(Request $request, $slug)
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $post = Post::where('slug', $slug)->firstOrFail();

    $request->validate([
        'title'       => 'required|max:255',
        'content'     => 'required',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Nouvelle image si uploadée
    if ($request->hasFile('image')) {
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }
        $post->image = $request->file('image')->store('posts', 'public');
    }

    $post->title       = $request->title; 
    $post->slug = \Illuminate\Support\Str::slug($request->title) . '-' . rand(100, 999);
    $post->content     = $request->content;
    $post->category_id = $request->category_id;
    $post->is_published = $request->boolean('is_published');
    $post->save();

    return redirect()->route('posts.show', $post->slug)->with('success', 'Article modifié avec succès ! ✨');
}
public function stat()
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $totalArticles  = Post::where('is_published', true)->count();
    $totalLikes     = \App\Models\Like::count();
    $totalComments  = Comment::count();
    $mostLiked      = Post::withCount('likes')->orderBy('likes_count', 'desc')->first();
    $mostCommented  = Post::withCount('comments')->orderBy('comments_count', 'desc')->first();
    $latestComments = Comment::with(['user', 'post'])->latest()->take(5)->get();

    return view('admin.stat', compact(
        'totalArticles', 'totalLikes', 'totalComments',
        'mostLiked', 'mostCommented', 'latestComments'
    ));
}
public function draft()
{
    if (!auth()->user()->is_admin) {
        abort(403);
    }

    $draft = Post::with(['category'])
                  ->where('is_published', false)
                  ->latest()
                  ->get();

    return view('admin.draft', compact('draft'));
}
}