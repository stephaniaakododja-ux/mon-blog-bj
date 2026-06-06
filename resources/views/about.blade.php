@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-12">

    <div class="text-center space-y-3 mb-12">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Bienvenue chez moi</span>
        <h1 class="text-3xl md:text-4xl font-black text-stone-900 tracking-tight uppercase">
            À propos de l'auteur
        </h1>
        <div class="h-1 w-20 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    {{-- Photo + intro --}}
    <div class="flex flex-col sm:flex-row items-center gap-8 mb-10">
        <div class="shrink-0">
            <div class="w-32 h-32 rounded-full bg-[#451a03] flex items-center justify-center text-white text-5xl font-black shadow-md">
                S
            </div>
        </div>
        <div>
            <p class="text-lg text-stone-900 font-bold mb-1">Stéphania AKODODJA</p>
            <p class="text-xs text-[#d97706] font-bold uppercase tracking-widest mb-3">Auteure & Créatrice du blog</p>
            <p class="text-stone-600 leading-relaxed">
                Passionnée par le patrimoine béninois, j'ai créé ce blog pour partager la richesse et la beauté de la culture de mon pays, le <strong>Bénin</strong>.
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12 border border-stone-200/60 space-y-6 leading-relaxed text-stone-700">

        <p>
            Bonjour et bienvenue ! Je m'appelle <strong>Stéphania</strong> et j'ai créé ce blog pour vous faire découvrir toute la richesse et la beauté de la culture de mon pays, le <strong>Bénin</strong>.
        </p>

        <p>
            Passionnée par notre patrimoine, j'ai voulu créer un espace chaleureux et accessible pour partager l'histoire de nos ancêtres, les saveurs uniques de notre cuisine, la profondeur de nos traditions et la magie de nos sites touristiques.
        </p>

        <p>
            À travers quatre rubriques principales, nous voyagerons ensemble au cœur de notre identité :
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-6">
            <div class="bg-[#f2ebdf]/40 p-4 rounded-xl border-l-4 border-[#b91c1c]">
                <strong class="text-stone-900 block mb-1">✨ Traditions</strong>
                <span class="text-sm text-stone-600">Immersion dans nos rites, nos valeurs ancestrales et notre sagesse collective.</span>
            </div>
            <div class="bg-[#f2ebdf]/40 p-4 rounded-xl border-l-4 border-[#d97706]">
                <strong class="text-stone-900 block mb-1">🍲 Gastronomie</strong>
                <span class="text-sm text-stone-600">Découverte des secrets et saveurs de nos délicieux plats locaux.</span>
            </div>
            <div class="bg-[#f2ebdf]/40 p-4 rounded-xl border-l-4 border-[#451a03]">
                <strong class="text-stone-900 block mb-1">📜 Histoire</strong>
                <span class="text-sm text-stone-600">Retour sur les grands récits de nos anciens royaumes et de nos héros.</span>
            </div>
            <div class="bg-[#f2ebdf]/40 p-4 rounded-xl border-l-4 border-stone-400">
                <strong class="text-stone-900 block mb-1">🌴 Tourisme</strong>
                <span class="text-sm text-stone-600">Évasion vers les plus beaux paysages et sites historiques du Bénin.</span>
            </div>
        </div>

        <p>
            J'espère de tout cœur que mes articles vous plairont ! Ce blog est aussi un espace d'échange, alors si vous avez des questions, des suggestions ou si vous souhaitez simplement discuter, n'hésitez surtout pas à me contacter.
        </p>

        {{-- Bouton contact --}}
        <div class="pt-4 border-t border-stone-100 flex flex-col sm:flex-row items-center gap-4">
            <a href="{{ route('contact') }}"
               class="w-full sm:w-auto text-center bg-[#b91c1c] text-white px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors shadow-md">
                ✉️ Me contacter
            </a>
            <a href="{{ route('home') }}"
               class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-stone-700 transition-colors">
                ← Lire les articles
            </a>
        </div>

    </div>

</div>
@endsection