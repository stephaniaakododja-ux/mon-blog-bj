@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    
    <div class="mb-6">
        <a href="{{ route('categories.index') }}" class="text-xs font-semibold text-stone-500 hover:text-red-600 transition-colors">
            &larr; Retour aux catégories
        </a>
    </div>

    <div class="text-center mb-12">
        <span class="text-xs font-bold text-red-600 uppercase tracking-widest block mb-1">Catégorie</span>
        <h1 class="text-4xl font-extrabold text-stone-900 uppercase tracking-wide">{{ $category->name }}</h1>
        <p class="text-stone-500 text-sm mt-2">Tous les articles liés à ce thème.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="bg-white rounded-xl shadow-sm border border-stone-100 overflow-hidden flex flex-col justify-between transition-shadow hover:shadow-md">
                
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-stone-100 flex items-center justify-center text-stone-400">
                        <span class="text-xs">Pas d'image</span>
                    </div>
                @endif

                <div class="p-6 flex-grow">
                    <h2 class="text-xl font-bold text-stone-900 mb-3 hover:text-red-700 transition-colors">
                        <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                    </h2>
                    
                    <p class="text-stone-600 text-sm line-clamp-3">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                </div>

                <div class="px-6 pb-6 pt-4 border-t border-stone-50 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="text-[11px] text-stone-400 font-medium">
                            {{ $post->created_at->format('d M Y') }}
                        </span>
                        <span class="text-xs text-stone-500 flex items-center space-x-1 select-none">
                            <span>❤️</span>
                            <span class="font-bold text-stone-700">{{ $post->likes()->count() }}</span>
                        </span>
                    </div>
                    
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-bold text-red-600 hover:text-stone-900 transition-colors flex items-center space-x-1">
                        <span>Lire l'article</span> <span>&rarr;</span>
                    </a>
                </div>

            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-stone-50 rounded-xl border border-dashed border-stone-200">
                <p class="text-stone-500 text-sm">Aucun article n'a encore été publié dans cette catégorie. 😔</p>
            </div>
        @endforelse
    </div>

</div>
@endsection