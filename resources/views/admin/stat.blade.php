@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">

    <div class="text-center space-y-2 mb-10">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Tableau de bord</span>
        <h1 class="text-3xl font-black text-stone-900 uppercase">Statistiques du blog</h1>
        <div class="h-1 w-16 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    {{-- Cartes stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <div class="bg-white rounded-2xl border border-stone-100 p-6 text-center shadow-sm">
            <div class="text-4xl mb-2">📝</div>
            <div class="text-3xl font-black text-stone-900">{{ $totalArticles }}</div>
            <div class="text-xs font-bold uppercase tracking-widest text-stone-400 mt-1">Articles publiés</div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-100 p-6 text-center shadow-sm">
            <div class="text-4xl mb-2">❤️</div>
            <div class="text-3xl font-black text-stone-900">{{ $totalLikes }}</div>
            <div class="text-xs font-bold uppercase tracking-widest text-stone-400 mt-1">Total likes</div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-100 p-6 text-center shadow-sm">
            <div class="text-4xl mb-2">💬</div>
            <div class="text-3xl font-black text-stone-900">{{ $totalComments }}</div>
            <div class="text-xs font-bold uppercase tracking-widest text-stone-400 mt-1">Total commentaires</div>
        </div>

    </div>

    {{-- Articles vedettes --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">

        <div class="bg-white rounded-2xl border border-stone-100 p-6 shadow-sm">
            <div class="text-xs font-bold uppercase tracking-widest text-[#d97706] mb-3">🏆 Article le plus aimé</div>
            @if($mostLiked)
                <a href="{{ route('posts.show', $mostLiked->slug) }}"
                   class="font-bold text-stone-900 hover:text-[#b91c1c] transition-colors">
                    {{ $mostLiked->title }}
                </a>
                <p class="text-sm text-stone-400 mt-1">{{ $mostLiked->likes_count }} ❤️</p>
            @else
                <p class="text-sm text-stone-400 italic">Aucun article pour le moment.</p>
            @endif
        </div>

        <div class="bg-white rounded-2xl border border-stone-100 p-6 shadow-sm">
            <div class="text-xs font-bold uppercase tracking-widest text-[#d97706] mb-3">💬 Article le plus commenté</div>
            @if($mostCommented)
                <a href="{{ route('posts.show', $mostCommented->slug) }}"
                   class="font-bold text-stone-900 hover:text-[#b91c1c] transition-colors">
                    {{ $mostCommented->title }}
                </a>
                <p class="text-sm text-stone-400 mt-1">{{ $mostCommented->comments_count }} commentaires</p>
            @else
                <p class="text-sm text-stone-400 italic">Aucun commentaire pour le moment.</p>
            @endif
        </div>

    </div>

    {{-- Derniers commentaires --}}
    <div class="bg-white rounded-2xl border border-stone-100 p-6 shadow-sm">
        <div class="text-xs font-bold uppercase tracking-widest text-[#d97706] mb-4">🕐 Derniers commentaires</div>

        <div class="space-y-4">
            @forelse($latestComments as $comment)
                <div class="flex gap-3 items-start pb-4 border-b border-stone-50 last:border-0">
                    <div class="w-8 h-8 rounded-full bg-stone-200 text-stone-600 text-xs font-bold flex items-center justify-center shrink-0">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-[#451a03]">{{ $comment->user->name }}</span>
                            <span class="text-[11px] text-stone-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-stone-600 mt-0.5">{{ $comment->content }}</p>
                        <a href="{{ route('posts.show', $comment->post->slug) }}"
                           class="text-[11px] text-[#b91c1c] font-bold hover:underline">
                            → {{ $comment->post->title }}
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-sm text-stone-400 italic text-center py-4">Aucun commentaire pour le moment.</p>
            @endforelse
        </div>
    </div>

    {{-- Lien vers tous les articles --}}
    <div class="text-center mt-8">
        <a href="{{ route('home') }}"
           class="text-xs font-bold uppercase tracking-widest text-stone-500 hover:text-[#b91c1c] transition-colors">
            ← Retour au blog
        </a>
    </div>

</div>
@endsection