@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">

    <div class="text-center space-y-2 mb-10">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Espace Création</span>
        <h1 class="font-cultural text-3xl font-black text-stone-900 uppercase">Rédiger une nouvelle histoire</h1>
        <div class="h-1 w-16 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-stone-200/60 p-8 md:p-10">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Titre de l'article</label>
                <input type="text" name="title" required 
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 font-bold placeholder-stone-400" 
                    placeholder="Ex: Les secrets de la cité lacustre de Ganvié">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Photo de couverture</label>
                <input type="file" name="image" accept="image/*" 
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-2 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Thématique</label>
                <select name="category_id" required 
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800">
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Rédaction de l'article</label>
                <textarea name="content" rows="12" required 
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 leading-relaxed" 
                    placeholder="Raconte ici la richesse de notre culture..."></textarea>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit" class="bg-[#b91c1c] text-white px-8 py-3.5 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors shadow-md">
                    🚀 Publier maintenant
                </button>
                <a href="{{ route('home') }}" class="text-stone-500 hover:text-stone-800 text-xs font-bold uppercase tracking-widest">
                    Annuler
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
