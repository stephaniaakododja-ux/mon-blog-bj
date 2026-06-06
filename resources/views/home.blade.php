@extends('layouts.app')
@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    
    <div class="w-full h-64 md:h-80 rounded-2xl overflow-hidden mb-8 relative shadow-sm">
        <img src="{{ asset('images/tradition.jpg') }}" alt="Bannière Au cœur du Bénin" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-stone-900/40 via-transparent to-transparent"></div>
    </div>

    <div class="text-center mb-8">
        <h1 class="text-4xl font-extrabold text-stone-900 mb-2">Au cœur du Bénin</h1>
        <p class="text-stone-600">Découvrez l'histoire, la culture et la gastronomie béninoise.</p>
    </div>

    <div class="max-w-xl mx-auto mb-8">
        <form action="{{ route('home') }}" method="GET" class="relative group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-stone-400 group-focus-within:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Rechercher un article, une tradition..." 
                   class="w-full pl-12 pr-24 py-3.5 bg-white border border-stone-200 rounded-full text-stone-800 placeholder-stone-400 text-sm shadow-sm transition-all duration-300 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 group-hover:border-stone-300">
            
            <button type="submit" 
                    class="absolute inset-y-1.5 right-1.5 px-5 bg-stone-900 text-white font-medium text-xs rounded-full hover:bg-red-700 transition-colors duration-200 flex items-center shadow-sm">
                Chercher
            </button>
        </form>
        
        @if(request('search'))
            <div class="text-center mt-3">
                <p class="text-xs text-stone-500">
                    Résultats pour : <span class="font-semibold text-red-600">"{{ request('search') }}"</span>
                    <a href="{{ route('home', request()->except('search')) }}" class="ml-2 text-stone-400 hover:text-stone-600 underline">Effacer</a>
                </p>
            </div>
        @endif
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
                    @if($post->category)
                        <a href="{{ route('categories.show', $post->category->id) }}" class="text-xs font-bold text-red-600 uppercase tracking-wider block mb-2 hover:underline">
                            {{ $post->category->name }}
                        </a>
                    @endif
                    
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
    
    <span class="text-xs text-stone-500 flex items-center space-x-1">
        <span>❤️</span>
        <span class="font-bold text-stone-700">{{ $post->likes ? $post->likes->count() : 0 }}</span>
    </span>

    {{-- Compteur commentaires --}}
    <span class="text-xs text-stone-500 flex items-center space-x-1">
        <span>💬</span>
        <span class="font-bold text-stone-700">{{ $post->comments ? $post->comments->count() : 0 }}</span>
    </span>
</div>
                    
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-xs font-bold text-red-600 hover:text-stone-900 transition-colors flex items-center space-x-1">
                        <span>Lire l'article</span> <span>&rarr;</span>
                    </a>
                </div>

            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-stone-50 rounded-xl border border-dashed border-stone-200">
                <p class="text-stone-500 text-sm">Aucun article trouvé. 😔</p>
                <a href="{{ route('home') }}" class="mt-2 inline-block text-xs font-semibold text-red-600 underline">Retourner à l'accueil</a>
            </div>
        @endforelse
    </div>

</div>
@endsection