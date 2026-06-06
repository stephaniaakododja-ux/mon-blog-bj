@extends('layouts.app')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4">
    <div class="text-center space-y-6 max-w-md">

        {{-- Numéro 404 --}}
        <div class="relative">
            <p class="text-[10rem] font-black text-stone-100 leading-none select-none">404</p>
            <div class="absolute inset-0 flex items-center justify-center">
                <span class="text-5xl">🌍</span>
            </div>
        </div>

        {{-- Message --}}
        <div class="space-y-3">
            <h1 class="text-2xl font-black text-stone-900 uppercase tracking-wide">
                Page introuvable
            </h1>
            <div class="h-1 w-12 bg-[#b91c1c] mx-auto rounded-full"></div>
            <p class="text-stone-500 text-sm leading-relaxed">
                Cette page n'existe pas ou a été déplacée. <br>
                Peut-être cherchez-vous un article sur le Bénin ?
            </p>
        </div>

        {{-- Boutons --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-4">
            <a href="{{ route('home') }}"
               class="w-full sm:w-auto text-center bg-[#b91c1c] text-white px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors shadow-md">
                ← Retour à l'accueil
            </a>
            <a href="{{ route('categories.index') }}"
               class="w-full sm:w-auto text-center bg-white border border-stone-200 text-stone-700 px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:border-stone-400 transition-colors">
                Voir les catégories
            </a>
        </div>

    </div>
</div>
@endsection