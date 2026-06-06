@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center">
                <span class="font-black text-3xl tracking-wide text-stone-900">
                    Mon.<span class="text-[#d97706]">Blog</span>.Bj
                </span>
                <span class="text-[10px] text-stone-400 font-medium tracking-widest uppercase mt-1">par Stéphania</span>
            </a>
            <h2 class="mt-6 text-xl font-black text-stone-900 uppercase tracking-wide">Connexion</h2>
            <div class="h-1 w-12 bg-[#b91c1c] mx-auto rounded-full mt-2"></div>
        </div>

        {{-- Carte --}}
        <div class="bg-white rounded-2xl shadow-sm border border-stone-200 p-8">

            {{-- Status --}}
            @if(session('status'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Erreurs --}}
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Adresse email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 placeholder-stone-400 text-sm"
                           placeholder="votre@email.com">
                </div>

                {{-- Mot de passe --}}
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] text-stone-800 placeholder-stone-400 text-sm"
                           placeholder="••••••••">
                </div>

                {{-- Se souvenir --}}
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember"
                               class="rounded border-stone-300 text-[#b91c1c] focus:ring-[#b91c1c]">
                        <span class="text-xs text-stone-500">Se souvenir de moi</span>
                    </label>

                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-xs text-[#b91c1c] font-bold hover:text-[#451a03] transition-colors">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                {{-- Bouton --}}
                <button type="submit"
                        class="w-full bg-[#b91c1c] text-white py-3.5 rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-[#451a03] transition-colors shadow-md">
                    Se connecter
                </button>

                {{-- Lien inscription --}}
                <p class="text-center text-xs text-stone-500 mt-2">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-[#b91c1c] font-bold hover:text-[#451a03] transition-colors">
                        S'inscrire
                    </a>
                </p>

            </form>
        </div>

    </div>
</div>
@endsection