<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mon.Blog.Bj</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f5efe6]">

    {{-- NAVBAR --}}
    <header class="bg-[#3b0d00] text-white py-4 px-6">
    <div class="w-full flex items-center px-8">

        {{-- Logo - calé à gauche --}}
        <div class="w-1/4">
            <a href="{{ route('home') }}" class="flex flex-col leading-tight">
                <span class="font-black text-xl tracking-wide">
                    Mon.<span class="text-[#d97706]">Blog</span>.Bj
                </span>
                <span class="text-[10px] text-white/50 font-medium tracking-widest uppercase">par Stéphania</span>
            </a>
        </div>

        {{-- Liens - centrés --}}
        <nav class="w-2/4 flex items-center justify-center gap-8 text-xs font-bold uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-[#d97706] transition-colors">Accueil</a>
            <a href="{{ route('categories.index') }}" class="hover:text-[#d97706] transition-colors">Catégories</a>
            <a href="{{ route('about') }}" class="hover:text-[#d97706] transition-colors">À propos</a>
            <a href="{{ route('contact') }}" class="hover:text-[#d97706] transition-colors">Contact</a>
        </nav>

        {{-- Actions - calées à droite --}}
        <div class="w-1/4 flex items-center justify-end gap-4 text-xs font-bold uppercase tracking-widest">
    @auth
    @if(Auth::user()->is_admin)
        {{-- Menu déroulant Admin --}}
        <div class="relative group">
            <button class="hover:text-[#d97706] transition-colors flex items-center gap-1">
                Admin ▾
            </button>
            <div class="absolute right-0 top-full mt-1 bg-[#451a03] rounded-xl shadow-lg py-2 w-44 hidden group-hover:block z-50">
                <a href="{{ route('admin.stat') }}" class="block px-4 py-2 text-xs hover:text-[#d97706] transition-colors">📊 Statistiques</a>
                <a href="{{ route('admin.draft') }}" class="block px-4 py-2 text-xs hover:text-[#d97706] transition-colors">📝 Brouillons</a>
                <a href="{{ route('admin.message') }}" class="block px-4 py-2 text-xs hover:text-[#d97706] transition-colors">✉️ Messages</a>
                <div class="border-t border-white/10 my-1"></div>
                <a href="{{ route('posts.create') }}" class="block px-4 py-2 text-xs hover:text-[#d97706] transition-colors">✍️ Nouvel article</a>
            </div>
        </div>
    @endif

    <a href="/profile" class="hover:text-[#d97706] transition-colors">Mon profil</a>

    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="hover:text-red-400 transition-colors">Déconnexion</button>
    </form>
@else
    <a href="{{ route('register') }}" class="hover:text-[#d97706] transition-colors">Inscription</a>
    <a href="{{ route('login') }}" class="hover:text-[#d97706] transition-colors">Connexion</a>
@endauth
        </div>

    </div>
</header>

    {{-- CONTENU --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-[#3b0d00] text-white text-center py-6 mt-16">
        <p class="font-black tracking-widest text-sm">MON.BLOG.BJ</p>
        <p class="text-xs text-white/50 mt-1">© 2026 — Fierté, Histoire et Culture Béninoise</p>
    </footer>

</body>
</html>