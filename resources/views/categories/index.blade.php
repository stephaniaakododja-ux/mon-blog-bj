@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-stone-900 mb-2">Explorer par Catégories</h1>
        <p class="text-stone-600">Découvrez nos articles classés par thématiques culturelles.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->id) }}" 
               class="block bg-white p-6 rounded-2xl border border-stone-100 shadow-sm hover:shadow-md hover:border-red-200 transition-all duration-200 group">
                
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-50 text-red-600 rounded-xl group-hover:bg-red-600 group-hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                        </svg>
                    </div>
                    
                    <span class="text-xs font-semibold px-2.5 py-1 bg-stone-100 text-stone-600 rounded-full">
                        {{ $category->posts_count }} {{ Str::plural('article', $category->posts_count) }}
                    </span>
                </div>

                <h2 class="text-xl font-bold text-stone-900 group-hover:text-red-600 transition-colors uppercase tracking-wide">
                    {{ $category->name }}
                </h2>
                
                <p class="text-stone-500 text-xs mt-1">
                    Voir les articles &rarr;
                </p>
            </a>
        @empty
            <div class="col-span-full text-center py-12 bg-stone-50 rounded-xl">
                <p class="text-stone-500 text-sm">Aucune catégorie disponible pour le moment.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection