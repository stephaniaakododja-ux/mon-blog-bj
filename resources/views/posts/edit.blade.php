@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">

    <div class="text-center space-y-2 mb-10">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Espace Édition</span>
        <h1 class="font-cultural text-3xl font-black text-stone-900 uppercase">Modifier l'article</h1>
        <div class="h-1 w-16 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-stone-200/60 p-8 md:p-10">
        <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Titre --}}
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Titre de l'article</label>
                <input type="text" name="title" required
                    value="{{ old('title', $post->title) }}"
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 font-bold placeholder-stone-400">
            </div>

            {{-- Image actuelle --}}
            @if($post->image)
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Image actuelle</label>
                    <img src="{{ asset('storage/' . $post->image) }}"
                         alt="{{ $post->title }}"
                         class="w-full h-48 object-cover rounded-xl border border-stone-200">
                </div>
            @endif

            {{-- Nouvelle image --}}
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">
                    {{ $post->image ? 'Changer la photo de couverture' : 'Photo de couverture' }}
                </label>
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-2 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
                @if($post->image)
                    <p class="text-[11px] text-stone-400">Laissez vide pour conserver l'image actuelle.</p>
                @endif
            </div>

            {{-- Catégorie --}}
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Thématique</label>
                <select name="category_id" required
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800">
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Contenu --}}
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Rédaction de l'article</label>
                <textarea name="content" rows="12" required
                    class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 leading-relaxed">{{ old('content', $post->content) }}</textarea>
            </div>

            {{-- Publié / Brouillon --}}
            <div class="flex items-center gap-3">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                       class="w-4 h-4 rounded border-stone-300 text-[#b91c1c] focus:ring-[#b91c1c]">
                <label for="is_published" class="text-xs font-bold uppercase text-stone-500 tracking-wider">
                    Article publié (décochez pour passer en brouillon)
                </label>
            </div>

            {{-- Boutons --}}
            <div class="flex items-center space-x-4 pt-4">
                <button type="submit"
                        class="bg-[#b91c1c] text-white px-8 py-3.5 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors shadow-md">
                    ✅ Enregistrer les modifications
                </button>
                <a href="{{ route('posts.show', $post->slug) }}"
                   class="text-stone-500 hover:text-stone-800 text-xs font-bold uppercase tracking-widest">
                    Annuler
                </a>
            </div>

        </form>
    </div>

</div>
@endsection