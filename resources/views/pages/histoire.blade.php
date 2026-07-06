@extends('layouts.public')

@section('title', 'Notre histoire — Blac Joyaux')

@section('content')

   {{-- ══════════ HERO ══════════ --}}
    <section class="relative h-[70vh] min-h-[450px] flex items-end">
        {{-- image en fond, plein écran --}}
        <img src="{{ asset('images/histoire-hero.png') }}" alt="Manuela Kouadio, fondatrice de Blac Joyaux"
             class="absolute inset-0 w-full h-full object-cover" style="object-position: 50% center;">

        {{-- voile pour lisibilité --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-black/40"></div>

        {{-- texte superposé, en bas à gauche --}}
        <div class="relative z-10 max-w-4xl mx-auto px-6 pb-16 w-full">
            <h1 class="font-script text-white text-5xl md:text-7xl mb-4 drop-shadow-lg">Notre Histoire</h1>
            <p class="text-white/90 italic text-lg md:text-xl max-w-xl leading-relaxed">
                « Porter un Joyaux, c'est avancer dans le monde avec élégance, fierté et confiance en soi. »
            </p>
            <p class="text-bj-or font-semibold mt-3">Manuela Kouadio</p>
        </div>
    </section>

    {{-- ══════════ À PROPOS / MISSION / VISION / VALEURS ══════════ --}}
   {{-- ══════════ NOTRE MAISON ══════════ --}}
    <section class="bg-bj-violet-dk py-20">
        <div class="max-w-3xl mx-auto px-6 text-center">

            <h2 class="font-script text-bj-or text-5xl md:text-6xl mb-10">La maison Blac Joyaux</h2>

            <div class="space-y-6 text-white/80 leading-relaxed md:text-lg">
                <p>
                    Fondée en 2024 à Abidjan, Blac Joyaux est une maison de maroquinerie ivoirienne
                    qui allie héritage, élégance et savoir-faire local. Née de la rencontre entre sa
                    fondatrice, Manuela Kouadio, et un artisan d'Adjamé, la marque révèle le talent de
                    l'artisanat ivoirien à travers des pièces façonnées avec soin — dont le Joyau de Bla,
                    inspiré de la poupée de fécondité ashanti, devenu son modèle emblématique.
                </p>
                <p>
                    Notre mission est de révéler ce savoir-faire à travers des sacs élégants, durables
                    et accessibles, qui accompagnent chaque femme avec fierté. Et notre ambition est
                    d'en faire une maison de référence de la maroquinerie ivoirienne, en Côte d'Ivoire
                    et au-delà.
                </p>
            </div>

            {{-- valeurs en pied de section --}}
            <div class="mt-10 pt-8 border-t border-white/15">
                <p class="text-bj-or/80 text-sm uppercase tracking-[0.2em] mb-4">Nos valeurs</p>
                <p class="text-white/90 md:text-lg">
                    Authenticité · Savoir-faire local · Durabilité · Élégance accessible · Fierté ivoirienne
                </p>
            </div>

        </div>
    </section>

    {{-- ══════════ MOSAÏQUE ══════════ --}}
    <section class="grid grid-cols-2 md:grid-cols-3 gap-1">
        @for($i = 1; $i <= 6; $i++)
            <div class="aspect-square overflow-hidden bg-[#ece6dc]">
                <img src="{{ asset('images/histoire-'.$i.'.jpeg') }}" alt="Créations Blac Joyaux"
                     class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
        @endfor
    </section>

    {{-- ══════════ CTA FINAL ══════════ --}}
    <section class="bg-bj-violet-dk text-center py-20">
        <h2 class="font-script text-bj-or text-5xl md:text-6xl mb-4">L'avenir En Main</h2>
        <p class="text-white/80 mb-8">Découvrez les créations qui portent notre histoire.</p>
        <a href="{{ route('produits.index') }}"
           class="inline-flex items-center gap-2 border border-white/60 text-white font-semibold
                  px-8 py-3.5 rounded-full hover:bg-white hover:text-bj-violet-dk transition">
            Découvrir la boutique
            <x-heroicon-s-arrow-right class="w-4 h-4" />
        </a>
    </section>

@endsection
