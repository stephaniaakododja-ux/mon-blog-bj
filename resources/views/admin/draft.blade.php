@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">

    <div class="text-center space-y-2 mb-10">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Admin</span>
        <h1 class="text-3xl font-black text-stone-900 uppercase">Brouillons</h1>
        <div class="h-1 w-16 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    <div class="space-y-4">
        @forelse($draft as $post)
            <div class="bg-white rounded-xl border border-stone-100 p-5 flex items-center justify-between shadow-sm">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#d97706]">
                        {{ $post->category->name }}
                    </span>
                    <h2 class="font-bold text-stone-900 mt-0.5">{{ $post->title }}</h2>
                    <span class="text-xs text-stone-400">{{ $post->created_at->format('d M Y') }}</span>
                </div>
                <a href="{{ route('posts.edit', $post->slug) }}"
                   class="text-xs font-bold text-white bg-[#b91c1c] px-4 py-2 rounded-lg hover:bg-[#451a03] transition-colors shrink-0">
                    Modifier / Republier
                </a>
            </div>
        @empty
            <p class="text-center text-stone-400 italic py-8">Aucun brouillon pour le moment.</p>
        @endforelse
    </div>

</div>
@endsection