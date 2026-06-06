@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">

    <div class="text-center space-y-3 mb-16">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Une question ? Une idée ?</span>
        <h1 class="text-3xl md:text-4xl font-black text-stone-900 tracking-tight uppercase">
            Contactez-<span class="text-[#b91c1c]">moi</span>
        </h1>
        <div class="h-1 w-20 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        
        <div class="space-y-8">
            <div class="bg-[#451a03] text-white p-8 rounded-2xl shadow-lg border-b-4 border-[#d97706]">
                <h3 class="text-xl font-bold mb-4">Parlons du Bénin !</h3>
                <p class="text-stone-300 text-sm leading-relaxed mb-6">
                    Je suis toujours ravie d'échanger avec vous. Que ce soit pour une suggestion d'article ou juste pour un petit mot d'encouragement.
                </p>
                
                <div class="space-y-4 text-sm">
                    <div class="flex items-center space-x-3">
                        <span class="text-[#d97706]">@</span>
                        <span>stephaniaakododja@gmail.com</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-[#d97706] opacity-70">📍</span>
                        <span>Cotonou, Bénin</span>
                    </div>
                </div>
            </div>

            <div class="p-6 border border-stone-300/50 rounded-2xl italic text-stone-500 text-sm bg-white/50">
                "Le contact est le premier pas vers la connaissance. J'ai hâte de vous lire !"
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-stone-200/60 p-8 md:p-10">
            @if(session('success'))
    <div class="max-w-xl mx-auto mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center space-x-3 shadow-sm">
        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Votre Prénom</label>
                        <input type="text" name="name" class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] transition-colors" placeholder="Ex: Stéphania">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Votre Email</label>
                        <input type="email" name="email" class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] transition-colors" placeholder="email@exemple.com">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Objet</label>
                    <input type="text" name="subject" class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] transition-colors" placeholder="De quoi souhaitez-vous parler ?">
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase text-stone-500 tracking-wider">Votre Message</label>
                    <textarea name="message" rows="5" class="w-full bg-[#f2ebdf]/30 border border-stone-200 rounded-xl px-4 py-3 focus:outline-none focus:border-[#b91c1c] transition-colors" placeholder="Écrivez votre message ici..."></textarea>
                </div>

                <button type="submit" class="w-full md:w-auto bg-[#b91c1c] text-white px-10 py-4 rounded-xl font-bold uppercase tracking-widest hover:bg-[#451a03] transition-all shadow-md active:scale-95">
                    Envoyer mon message
                </button>
            </form>
        </div>

    </div>

</div>
@endsection