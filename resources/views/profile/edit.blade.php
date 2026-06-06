@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">

    <div class="text-center space-y-2 mb-10">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Mon espace</span>
        <h1 class="text-3xl font-black text-stone-900 uppercase">Mon profil</h1>
        <div class="h-1 w-16 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    {{-- Succès --}}
    @if(session('status') === 'profile-updated')
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium">
            ✨ Profil mis à jour avec succès !
        </div>
    @endif

    {{-- Avatar --}}
    <div class="flex justify-center mb-8">
        <div class="w-20 h-20 rounded-full bg-[#451a03] text-amber-100 text-3xl font-black flex items-center justify-center shadow-md">
            {{ substr(Auth::user()->name, 0, 1) }}
        </div>
    </div>

    {{-- Informations du profil --}}
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-8 mb-6">
        <h2 class="text-xs font-bold uppercase tracking-widest text-[#d97706] mb-6">Informations personnelles</h2>

        <form method="POST" action="/profile" class="space-y-5">
            @csrf
            @method('PATCH')

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Nom</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" required
                       class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" required
                       class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
            </div>

            <button type="submit"
                    class="bg-[#b91c1c] text-white px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors">
                Enregistrer
            </button>
        </form>
    </div>

    {{-- Changer mot de passe --}}
    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-8 mb-6">
        <h2 class="text-xs font-bold uppercase tracking-widest text-[#d97706] mb-6">Changer le mot de passe</h2>

        @if(session('status') === 'password-updated')
            <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
                ✨ Mot de passe mis à jour !
            </div>
        @endif

        <form method="POST" action="/password" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Mot de passe actuel</label>
                <input type="password" name="current_password" required
                       class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Nouveau mot de passe</label>
                <input type="password" name="password" required
                       class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required
                       class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 text-sm">
            </div>

            <button type="submit"
                    class="bg-[#b91c1c] text-white px-8 py-3 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors">
                Mettre à jour
            </button>
        </form>
    </div>

    {{-- Retour --}}
    <div class="text-center">
        <a href="{{ route('home') }}" class="text-xs font-bold uppercase tracking-widest text-stone-400 hover:text-stone-700 transition-colors">
            ← Retour au blog
        </a>
    </div>

</div>
@endsection