@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">

    <div class="text-center space-y-2 mb-10">
        <span class="text-[#d97706] text-xs font-bold uppercase tracking-widest">Admin</span>
        <h1 class="text-3xl font-black text-stone-900 uppercase">Messages reçus</h1>
        <div class="h-1 w-16 bg-[#b91c1c] mx-auto rounded-full"></div>
    </div>

    <div class="space-y-4">
        @forelse($message as $message)
            <div class="bg-white rounded-xl border border-stone-100 p-6 shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <p class="font-bold text-stone-900">{{ $message->name }}</p>
                        <p class="text-xs text-[#b91c1c]">{{ $message->email }}</p>
                    </div>
                    <span class="text-xs text-stone-400">{{ $message->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-[#d97706] mb-2">{{ $message->subject }}</p>
                <p class="text-sm text-stone-700 leading-relaxed">{{ $message->message }}</p>
            </div>
        @empty
            <p class="text-center text-stone-400 italic py-8">Aucun message reçu pour le moment.</p>
        @endforelse
    </div>

</div>
@endsection