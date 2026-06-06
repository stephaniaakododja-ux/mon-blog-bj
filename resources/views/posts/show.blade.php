@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10 pb-16">

    {{-- Retour --}}
    <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-widest text-[#b91c1c] hover:text-[#451a03] transition-colors mb-8">
        <span>&larr;</span> Retour à l'accueil
    </a>

    {{-- Succès --}}
    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-sm font-medium">
            ✨ {{ session('success') }}
        </div>
    @endif

    {{-- Badge catégorie --}}
    <span class="bg-[#d97706] text-white text-[10px] font-bold px-3 py-1 rounded-sm uppercase tracking-widest inline-block mb-4">
        {{ $post->category->name }}
    </span>

    {{-- Titre --}}
    <h1 class="text-4xl md:text-5xl font-black text-stone-900 leading-tight mb-5" style="font-family: Georgia, serif;">
        {{ $post->title }}
    </h1>

    {{-- Meta auteur --}}
    <div class="flex items-center justify-between pb-4 border-b border-stone-200 mb-8">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-[#451a03] text-amber-100 text-xs font-bold flex items-center justify-center shrink-0">
                {{ substr($post->user ? $post->user->name : 'S', 0, 1) }}
            </div>
            <p class="text-xs text-stone-500">
                Publié le <strong class="text-stone-700">{{ $post->created_at->format('d M Y') }}</strong>
                par <strong class="text-[#451a03]">{{ $post->user ? $post->user->name : 'Stéphania' }}</strong>
            </p>
        </div>

       @auth
    @if(auth()->user()->is_admin)
        <div class="flex items-center gap-2">
            <a href="{{ route('posts.edit', $post->slug) }}"
               class="text-[11px] font-bold text-red-600 bg-red-50 border border-red-100 px-3 py-1.5 rounded-md uppercase tracking-wide hover:bg-red-100 transition-colors">
                Modifier
            </a>
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('Supprimer cet article définitivement ?')"
                        class="text-[11px] font-bold text-white bg-red-600 border border-red-700 px-3 py-1.5 rounded-md uppercase tracking-wide hover:bg-red-700 transition-colors">
                    Supprimer
                </button>
            </form>
        </div>
    @endif
@endauth
    </div>

    {{-- Image de couverture --}}
    @if($post->image)
        <div class="mb-10">
            <img src="{{ asset('storage/' . $post->image) }}"
                 alt="{{ $post->title }}"
                 class="w-full h-64 md:h-80 object-cover rounded-2xl">
        </div>
    @endif

    {{-- Contenu --}}
    <div class="text-stone-800 leading-relaxed text-[1.05rem] mb-12" style="font-family: Georgia, serif; line-height: 1.85;">
        {!! nl2br(e($post->content)) !!}
    </div>

    {{-- Séparateur --}}
    <hr class="border-stone-200 mb-8">

    {{-- J'aime --}}
    <div class="mb-8">
        <form action="{{ route('posts.like', $post->id) }}" method="POST">
            @csrf
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-white border border-stone-200 hover:border-red-200 hover:bg-red-50 text-stone-700 hover:text-red-600 transition-all px-4 py-2 rounded-full text-sm font-semibold">
                <span>❤️</span>
                <span>J'aime</span>
                <span class="text-stone-400">·</span>
                <span>{{ $post->likes->count() }}</span>
            </button>
        </form>
    </div>

    {{-- Section commentaires --}}
    <div>
        <div class="flex items-baseline gap-3 mb-6">
            <h2 class="text-base font-bold text-stone-900">Commentaires</h2>
            <span class="text-sm text-stone-400">
                {{ $post->comments->count() }} {{ $post->comments->count() > 1 ? 'commentaires' : 'commentaire' }}
            </span>
        </div>

        {{-- Formulaire si connecté --}}
        @auth
            <form action="{{ route('posts.comment', $post->id) }}" method="POST" class="mb-8">
                @csrf
                <div class="flex items-center gap-3 relative">
                    <div class="w-9 h-9 rounded-full bg-[#451a03] text-amber-100 text-sm font-bold flex items-center justify-center shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>

                    <div class="flex-1 flex items-center gap-2 bg-white border border-stone-200 rounded-full px-4 py-2">
                        <input type="text" name="content" id="comment-input" required
                               placeholder="Ajouter un commentaire…"
                               class="flex-1 text-sm text-stone-800 placeholder-stone-400 focus:outline-none bg-transparent">

                        {{-- Bouton emoji --}}
                        <button type="button" id="emoji-btn" class="text-stone-400 hover:text-[#d97706] transition-colors text-lg shrink-0">
                            🙂
                        </button>
                    </div>

                    <button type="submit"
                            class="px-4 py-2.5 bg-[#b91c1c] hover:bg-[#451a03] text-white text-xs font-bold rounded-full transition-colors shrink-0">
                        Publier
                    </button>
                </div>

                {{-- Picker emojis --}}
                <div id="emoji-picker" class="hidden mt-2 ml-12 bg-white border border-stone-200 rounded-2xl p-3 shadow-lg flex flex-wrap gap-2 max-w-xs">
                    @foreach(['😀','😂','😍','🥰','😎','🤩','👏','🔥','❤️','💯','🙏','😢','😮','🤔','👀','✨','🎉','💪','🌍','🇧🇯'] as $emoji)
                        <button type="button" onclick="addEmoji('{{ $emoji }}')"
                                class="text-xl hover:scale-125 transition-transform">
                            {{ $emoji }}
                        </button>
                    @endforeach
                </div>
            </form>
        @endauth

        {{-- Liste des commentaires --}}
        <div class="space-y-4 mb-6">
            @forelse($post->comments as $comment)
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-full bg-stone-200 text-stone-600 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div class="flex-1 bg-white border border-stone-100 rounded-xl px-4 py-3">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-bold text-[#451a03]">{{ $comment->user->name }}</span>
                            <div class="flex items-center gap-3">
                                <span class="text-[11px] text-stone-400">{{ $comment->created_at->diffForHumans() }}</span>

                                {{-- Bouton supprimer (visible uniquement pour l'auteur) --}}
                                @auth
    @if(auth()->id() === $comment->user_id || auth()->user()->is_admin)
        <form method="POST" action="{{ route('comments.delete', $comment->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Supprimer ce commentaire ?')"
                    class="text-[11px] text-stone-400 hover:text-red-500 transition-colors">
                Supprimer
            </button>
        </form>
    @endif
@endauth
                            </div>
                        </div>
                        <p class="text-sm text-stone-700 leading-relaxed">{{ $comment->content }}</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-stone-400 italic text-center py-8">
                    Aucun commentaire pour le moment. Soyez le premier à commenter !
                </p>
            @endforelse
        </div>

        {{-- Invitation si non connecté --}}
        @guest
            <div class="bg-stone-50 border border-dashed border-stone-200 rounded-xl p-4 text-center">
                <p class="text-sm text-stone-500">
                    Envie de commenter ?
                    <a href="{{ route('login') }}" class="text-[#b91c1c] font-bold hover:text-[#451a03] transition-colors">
                        Connectez-vous
                    </a>
                </p>
            </div>
        @endguest
    </div>

</div>

<script>
    const emojiBtn = document.getElementById('emoji-btn');
    const emojiPicker = document.getElementById('emoji-picker');
    const commentInput = document.getElementById('comment-input');

    if (emojiBtn) {
        emojiBtn.addEventListener('click', () => {
            emojiPicker.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!emojiBtn.contains(e.target) && !emojiPicker.contains(e.target)) {
                emojiPicker.classList.add('hidden');
            }
        });
    }

    function addEmoji(emoji) {
        commentInput.value += emoji;
        commentInput.focus();
        emojiPicker.classList.add('hidden');
    }
</script>
@endsection