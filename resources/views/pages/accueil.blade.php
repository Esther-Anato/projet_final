@extends('layouts.public')

@section('title', 'Blac Joyaux — L\'avenir en main')

@section('content')

    {{-- ══════════ HERO ══════════ --}}
    <section class="relative min-h-[85vh] flex items-center bg-cover bg-center"
             style="background-image: url('{{ asset('images/hero-sacs.jpg') }}')">

        {{-- voile pour garantir la lisibilité du texte à gauche --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/20 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-6 w-full">
            <div class="max-w-lg">
                <h1 class="font-script text-white text-6xl md:text-7xl leading-none drop-shadow-lg">
                    L'avenir en main
                </h1>
                <a href="{{ route('produits.index') }}"
                   class="mt-8 inline-flex items-center gap-2 border border-white/80 text-white font-semibold
                          px-8 py-4 rounded-full hover:bg-white hover:text-bj-violet transition">
                    Découvrir la boutique
                    <x-heroicon-s-arrow-right class="w-4 h-4" />
                </a>
            </div>
        </div>
    </section>
    {{-- ══════════ NOTRE HISTOIRE ══════════ --}}
    <section class="bg-bj-creme py-20">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

            {{-- logo + titre --}}
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('images/logo-poupee.png') }}" alt="Poupée Joyau de Bla" class="h-40 w-auto mb-4">
                <h2 class="font-script font-bold text-4xl md:text-5xl text-bj-noir leading-tight">
                    Notre<br>Histoire
                </h2>
            </div>

            {{-- bloc texte --}}
            <div class="bg-bj-or/40 rounded-3xl p-10 md:p-12 text-center">
                <p class="text-bj-noir/80 leading-relaxed text-lg">
                    Née à Abidjan en 2024, Blac Joyaux valorise le savoir-faire des artisans
                    ivoiriens à travers des sacs qui allient héritage et élégance. De la rencontre
                    entre sa fondatrice, Manuela Kouadio, et un artisan d'Adjamé est né le Joyau de Bla,
                    inspiré de la poupée de fécondité ashanti — aujourd'hui pièce emblématique de la maison.
                </p>
                <a href="#"
                   class="mt-8 inline-flex items-center gap-2 border border-bj-noir/40 text-bj-noir font-semibold
                          px-7 py-3 rounded-full hover:bg-bj-noir hover:text-white transition">
                    Découvrir notre histoire
                    <x-heroicon-s-arrow-right class="w-4 h-4" />
                </a>
            </div>
        </div>
    </section>
{{-- ══════════ NOS COLLECTIONS ══════════ --}}
    <section class="bg-bj-violet py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="font-script text-white text-5xl md:text-6xl mb-5">Nos Collections</h2>
            <p class="text-white/80 leading-relaxed">
                Trois collections, une même exigence : des sacs façonnés à Abidjan qui allient
                héritage ivoirien et élégance contemporaine. Du Joyau de Bla emblématique aux
                lignes DO et Wawa Aba, chaque pièce raconte une histoire à porter au quotidien.
            </p>
            <a href="{{ route('produits.index') }}"
               class="mt-8 inline-flex items-center gap-2 border border-white/70 text-white font-semibold
                      px-7 py-3 rounded-full hover:bg-white hover:text-bj-violet transition">
                Découvrir nos collections
                <x-heroicon-s-arrow-right class="w-4 h-4" />
            </a>
        </div>

        {{-- 3 cartes-collections --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-1 mt-12">
            {{-- Joyau de Bla --}}
            <a href="{{ route('produits.index') }}" class="group relative block aspect-[3/4] overflow-hidden">
                <img src="{{ asset('images/collection-joyau.jpg') }}" alt="Collection Joyau de Bla"
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <span class="absolute bottom-5 left-5 text-white font-display font-semibold text-lg tracking-wide">JOYAU DE BLA</span>
            </a>

            {{-- DO --}}
            <a href="{{ route('produits.index') }}" class="group relative block aspect-[3/4] overflow-hidden">
                <img src="{{ asset('images/collection-do.jpg') }}" alt="Collection DO"
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <span class="absolute bottom-5 left-5 text-white font-display font-semibold text-lg tracking-wide">DO</span>
            </a>

            {{-- Wawa Aba --}}
            <a href="{{ route('produits.index') }}" class="group relative block aspect-[3/4] overflow-hidden">
                <img src="{{ asset('images/collection-wawa.jpg') }}" alt="Collection Wawa Aba"
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <span class="absolute bottom-5 left-5 text-white font-display font-semibold text-lg tracking-wide">WAWA ABA</span>
            </a>
        </div>
    </section>
    {{-- ══════════ NOS BEST-SELLERS ══════════ --}}
    <section class="bg-bj-creme py-24">
        <div class="max-w-7xl mx-auto px-6">

            {{-- en-tête, même style que "Nos Collections" --}}
            <div class="text-center mb-16">
                <h2 class="font-script text-bj-violet-dk text-5xl md:text-6xl mb-4">Nos Best-sellers</h2>
                <p class="text-bj-noir/70 max-w-xl mx-auto leading-relaxed">
                    Les pièces préférées de nos clientes, choisies pour leurs finitions
                    et leur élégance au quotidien.
                </p>
            </div>

            @if($produitsVedette->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
                    @foreach($produitsVedette->take(3) as $i => $produit)
                        @php $center = $i === 1; @endphp

                        <div class="group relative flex flex-col rounded-[28px] overflow-hidden
                                    transition-all duration-300 hover:-translate-y-2
                                    {{ $center
                                        ? 'bg-bj-violet-dk shadow-2xl shadow-bj-violet/30 md:scale-105 md:z-10'
                                        : 'bg-white shadow-xl shadow-bj-violet/10' }}">

                            @if($center)
                                <span class="absolute top-5 left-5 z-10 text-[11px] font-semibold uppercase tracking-wider
                                             bg-bj-or text-bj-noir px-4 py-1.5 rounded-full">
                                    N°1 des ventes
                                </span>
                            @endif

                            {{-- image grande --}}
                            <div class="p-5 {{ $center ? 'pt-14' : '' }}">
                                <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-[#ece6dc]">
                                    @if($produit->imagePrincipale())
                                        <img src="{{ $produit->imagePrincipale()->url }}"
                                             alt="{{ $produit->imagePrincipale()->texte_alternatif ?? $produit->nom }}"
                                             class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full grid place-items-center text-bj-violet/30">
                                            <x-heroicon-o-photo class="w-14 h-14" />
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- infos --}}
                            <div class="px-7 pb-8 flex flex-col flex-1 text-center">
                                <span class="text-xs tracking-wide {{ $center ? 'text-bj-or' : 'text-bj-or-dk' }}">
                                    {{ $produit->collection->nom ?? '' }}
                                </span>
                                <h3 class="mt-1.5 font-display font-semibold text-xl leading-snug
                                           {{ $center ? 'text-white' : 'text-bj-noir' }}">
                                    {{ $produit->nom }}
                                </h3>
                                <p class="mt-2 font-semibold text-2xl {{ $center ? 'text-bj-or' : 'text-bj-violet-dk' }}">
                                    {{ $produit->prix_formatte }}
                                </p>

                                <a href="{{ route('produits.afficher', $produit) }}"
                                   class="mt-6 inline-flex items-center justify-center gap-2 text-sm font-semibold
                                          py-3.5 px-6 rounded-full transition
                                          {{ $center
                                              ? 'bg-bj-or text-bj-noir hover:brightness-105'
                                              : 'bg-bj-violet text-white hover:bg-bj-violet-dk' }}">
                                    Voir le produit
                                    <x-heroicon-s-arrow-right class="w-4 h-4" />
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-16">
                    <a href="{{ route('produits.index') }}"
                       class="inline-flex items-center gap-2 border border-bj-violet/40 text-bj-violet font-semibold
                              px-8 py-3.5 rounded-full hover:bg-bj-violet hover:text-white transition">
                        Voir toute la boutique
                        <x-heroicon-s-arrow-right class="w-4 h-4" />
                    </a>
                </div>
            @else
                <p class="text-center text-bj-noir/60">Aucun produit vedette pour le moment.</p>
            @endif
        </div>
    </section>
    {{-- ══════════ MADE IN CÔTE D'IVOIRE ══════════ --}}
    <section class="grid md:grid-cols-2 items-stretch">

       {{-- vidéo à gauche, lecture auto en boucle --}}
        <div class="relative min-h-[380px] md:min-h-[560px] bg-black">
            <video class="absolute inset-0 w-full h-full object-cover"
                   autoplay loop muted playsinline
                   poster="{{ asset('images/savoir-faire-poster.jpg') }}">
                <source src="{{ asset('videos/savoir-faire.webm') }}" type="video/mp4">
                Votre navigateur ne prend pas en charge la lecture vidéo.
            </video>
        </div>
        {{-- texte à droite --}}
        <div class="bg-white flex flex-col items-center justify-center text-center px-8 py-16 md:py-0">
            <div class="max-w-md">
                {{-- carte de la Côte d'Ivoire --}}
                <img src="{{ asset('images/carte-ci.png') }}" alt="Côte d'Ivoire — Abidjan"
                     class="w-56 mx-auto mb-6">

                <h2 class="font-script text-bj-violet-dk text-5xl md:text-6xl mb-5">Côte d'Ivoire</h2>

                <p class="text-bj-noir/70 leading-relaxed">
                    Chaque sac Blac Joyaux est façonné à Abidjan par nos artisans, dans le
                    respect d'un savoir-faire local et de finitions soignées. Un héritage
                    ivoirien que vous portez avec vous.
                </p>

                <a href="{{ route('histoire') }}"
                   class="mt-8 inline-flex items-center gap-2 border border-bj-violet/40 text-bj-violet font-semibold
                          px-8 py-3.5 rounded-full hover:bg-bj-violet hover:text-white transition">
                    En apprendre plus
                    <x-heroicon-s-arrow-right class="w-4 h-4" />
                </a>
            </div>
        </div>
    </section>
    {{-- ══════════ NOS ENGAGEMENTS ══════════ --}}
    <section class="bg-bj-creme py-24">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-script font-bold text-4xl md:text-5xl text-bj-violet-dk text-center mb-16">
                Nos engagements
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- WhatsApp --}}
                <div class="flex flex-col items-center text-center">
                    <div class="text-bj-violet-dk mb-5">
                        <svg class="w-11 h-11" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15l-1.3 4.8 4.9-1.3A10 10 0 1 0 12 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1-.4-.1-1-.3-1.7-.6-3-1.3-4.9-4.3-5-4.5-.2-.2-1.2-1.6-1.2-3s.7-2.1 1-2.4c.2-.3.5-.4.7-.4h.5c.2 0 .4 0 .6.5l.8 2c.1.1.1.3 0 .5l-.4.5-.3.3c-.1.1-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.3.1.5.1.6-.1l.7-.9c.2-.3.4-.2.6-.1l2 .9c.2.1.4.2.4.3.1.2.1.9-.1 1.6z"/></svg>
                    </div>
                    <h3 class="font-display font-semibold text-bj-noir mb-2">Commandez sur WhatsApp</h3>
                    <p class="text-sm text-bj-noir/70 leading-relaxed mb-5">
                        Échangez avec nous et finalisez votre commande en quelques messages.
                    </p>
                    <a href="#" class="mt-auto inline-flex items-center gap-2 border border-bj-violet/40 text-bj-violet font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-bj-violet hover:text-white transition">
                        Nous écrire <x-heroicon-s-arrow-right class="w-4 h-4" />
                    </a>
                </div>

                {{-- Paiement --}}
                <div class="flex flex-col items-center text-center">
                    <div class="text-bj-violet-dk mb-5">
                        <x-heroicon-s-wallet class="w-11 h-11" />
                    </div>
                    <h3 class="font-display font-semibold text-bj-noir mb-2">Espèces ou Mobile Money</h3>
                    <p class="text-sm text-bj-noir/70 leading-relaxed mb-5">
                        Réglez en espèces ou par Mobile Money, simplement et en toute confiance.
                    </p>
                    <a href="#" class="mt-auto inline-flex items-center gap-2 border border-bj-violet/40 text-bj-violet font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-bj-violet hover:text-white transition">
                        En savoir plus <x-heroicon-s-arrow-right class="w-4 h-4" />
                    </a>
                </div>

                {{-- Livraison --}}
                <div class="flex flex-col items-center text-center">
                    <div class="text-bj-violet-dk mb-5">
                        <x-heroicon-s-truck class="w-11 h-11" />
                    </div>
                    <h3 class="font-display font-semibold text-bj-noir mb-2">Livraison à Abidjan</h3>
                    <p class="text-sm text-bj-noir/70 leading-relaxed mb-5">
                        Recevez votre commande sous 1 à 3 jours dans tout Abidjan.
                    </p>
                    <a href="#" class="mt-auto inline-flex items-center gap-2 border border-bj-violet/40 text-bj-violet font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-bj-violet hover:text-white transition">
                        La livraison <x-heroicon-s-arrow-right class="w-4 h-4" />
                    </a>
                </div>

                {{-- Made in CI --}}
                <div class="flex flex-col items-center text-center">
                    <div class="text-bj-violet-dk mb-5">
                        <x-heroicon-s-sparkles class="w-11 h-11" />
                    </div>
                    <h3 class="font-display font-semibold text-bj-noir mb-2">Made in Côte d'Ivoire</h3>
                    <p class="text-sm text-bj-noir/70 leading-relaxed mb-5">
                        Chaque sac est façonné par nos artisans à Abidjan, avec des finitions soignées.
                    </p>
                    <a href="{{ route('histoire') }}" class="mt-auto inline-flex items-center gap-2 border border-bj-violet/40 text-bj-violet font-semibold text-sm px-5 py-2.5 rounded-full hover:bg-bj-violet hover:text-white transition">
                        Notre savoir-faire <x-heroicon-s-arrow-right class="w-4 h-4" />
                    </a>
                </div>

            </div>
        </div>
    </section>
    {{-- ══════════ NOTRE FAQ ══════════ --}}
    <section class="bg-bj-violet-dk py-20">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="font-script text-bj-or text-5xl md:text-6xl text-center mb-12">Notre Faq</h2>

            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q' => 'Où acheter un sac Blac Joyaux ?',
                         'r' => "En ligne sur ce site, ou à notre showroom de Cocody Palmeraie à Abidjan. Vous pouvez aussi finaliser votre commande avec nous sur WhatsApp."],
                        ['q' => 'Quels sont les délais de livraison ?',
                         'r' => "Votre commande est livrée sous 1 à 3 jours dans tout Abidjan."],
                        ['q' => 'Quels moyens de paiement acceptez-vous ?',
                         'r' => "Vous pouvez régler en espèces ou par Mobile Money (Orange Money, Wave)."],
                        ['q' => 'Quel sac offrir à une jeune cadre ?',
                         'r' => "Le sac de bureau de la collection Wawa Aba est idéal : élégant, pratique et parfait à offrir. Le Joyau de Bla reste aussi une valeur sûre."],
                        ['q' => 'Vos sacs sont-ils fabriqués localement ?',
                         'r' => "Oui, chaque sac est façonné en Côte d'Ivoire par nos artisans à Abidjan."],
                    ];
                @endphp

                @foreach($faqs as $item)
                    <details class="group bg-bj-violet/60 rounded-2xl px-6 py-4 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex items-center justify-between cursor-pointer text-white font-medium list-none">
                            {{ $item['q'] }}
                            <x-heroicon-o-chevron-down class="w-5 h-5 text-bj-or transition group-open:rotate-180" />
                        </summary>
                        <p class="mt-3 text-white/80 leading-relaxed">{{ $item['r'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
    {{-- ══════════ SHOWROOM ══════════ --}}
    <section class="relative min-h-[520px] flex items-end">
        {{-- image/vidéo de fond --}}
        <img src="{{ asset('images/showroom.jpg') }}" alt="Showroom Blac Joyaux à Cocody Palmeraie"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>

        {{-- titre en haut à gauche --}}
        <div class="absolute top-10 left-6 md:left-12 z-10">
            <p class="text-white/80 text-sm">Blac Joyaux · Abidjan</p>
            <h2 class="font-script text-bj-or text-4xl md:text-5xl">Cocody Palmeraie</h2>
        </div>

        {{-- contenu en bas --}}
        <div class="relative z-10 w-full px-6 md:px-12 pb-12 grid md:grid-cols-2 gap-8 items-end">
            <p class="text-white/85 leading-relaxed max-w-md">
                Situé au cœur de Cocody Palmeraie, l'un des quartiers les plus élégants d'Abidjan,
                notre showroom vous accueille comme dans un écrin : venez découvrir et toucher nos
                modèles, et laissez-vous conseiller.
            </p>

            <div class="md:text-right">
                <p class="text-white/70 text-sm">Horaires d'ouverture</p>
                <p class="text-white font-medium mb-4">Lundi au samedi, de 09h00 à 18h00</p>
                <div class="flex flex-wrap gap-3 md:justify-end">
                    <a href="#" class="inline-flex items-center gap-2 bg-bj-or text-bj-noir font-semibold px-5 py-2.5 rounded-full hover:brightness-105 transition">
                        <x-heroicon-s-map-pin class="w-4 h-4" /> Nous trouver
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 border border-white/60 text-white font-semibold px-5 py-2.5 rounded-full hover:bg-white hover:text-bj-noir transition">
                        Prendre rendez-vous
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
