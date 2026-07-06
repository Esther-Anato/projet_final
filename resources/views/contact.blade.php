@extends('layouts.public')

@section('title', 'Contact — Blac Joyaux')

@section('content')

    <div class="max-w-5xl mx-auto px-6 pt-28 pb-20">

        <h1 class="font-script text-bj-violet-dk text-5xl mb-2">Contactez-nous</h1>
        <p class="text-bj-noir/60 mb-10 max-w-xl">
            Une question sur une pièce, une commande ou une livraison ? Notre équipe vous répond rapidement.
        </p>

        @if(session('succes'))
            <p class="text-green-700 bg-green-50 border border-green-200 rounded-lg px-4 py-2 mb-6 text-sm">
                {{ session('succes') }}
            </p>
        @endif

        <div class="grid lg:grid-cols-3 gap-8 items-start">

            {{-- formulaire --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-6">
                <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-6">Écrivez-nous</h2>

                <form method="POST" action="{{ route('contact.envoyer') }}" class="space-y-5">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="nom" class="block text-sm text-bj-noir/70 mb-1">Nom complet</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom') }}" required
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet text-sm">
                            @error('nom')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="telephone" class="block text-sm text-bj-noir/70 mb-1">Téléphone</label>
                            <input type="tel" id="telephone" name="telephone" value="{{ old('telephone') }}"
                                   placeholder="+225 07 00 00 00 00"
                                   class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet text-sm">
                            @error('telephone')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm text-bj-noir/70 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet text-sm">
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="sujet" class="block text-sm text-bj-noir/70 mb-1">Sujet</label>
                        <select id="sujet" name="sujet" required
                                class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet text-sm">
                            <option value="">Choisir un sujet</option>
                            <option value="commande" @selected(old('sujet') === 'commande')>Suivi de commande</option>
                            <option value="produit" @selected(old('sujet') === 'produit')>Question sur un produit</option>
                            <option value="livraison" @selected(old('sujet') === 'livraison')>Livraison / retour</option>
                            <option value="autre" @selected(old('sujet') === 'autre')>Autre</option>
                        </select>
                        @error('sujet')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm text-bj-noir/70 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full rounded-lg border-gray-300 focus:border-bj-violet focus:ring-bj-violet text-sm">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full sm:w-auto bg-bj-violet text-white font-semibold px-8 py-3.5 rounded-full hover:bg-bj-violet-dk transition">
                        Envoyer le message
                    </button>
                </form>
            </div>

            {{-- coordonnées --}}
            <aside class="bg-white rounded-2xl p-6 lg:sticky lg:top-24">
                <h2 class="font-display font-semibold text-lg text-bj-violet-dk mb-4">Nous joindre directement</h2>

                <div class="space-y-4">
                    <a href="tel:+2250708771557" class="flex items-center gap-3 text-sm text-bj-noir hover:text-bj-violet transition">
                        <span class="w-9 h-9 rounded-full bg-bj-creme flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-bj-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 001.5-1.5v-1.372a1.5 1.5 0 00-1.06-1.436l-3.32-1.107a1.5 1.5 0 00-1.596.44l-.85.918a11.25 11.25 0 01-5.876-5.876l.918-.85a1.5 1.5 0 00.44-1.596l-1.107-3.32A1.5 1.5 0 007.622 2.25H6.25a1.5 1.5 0 00-1.5 1.5v1.5z" />
                            </svg>
                        </span>
                        <span>
                            <span class="block text-bj-noir/50 text-xs">Nous appeler</span>
                            +225 07 08 77 15 57
                        </span>
                    </a>

                    <a href="https://wa.me/2250708771557" target="_blank" rel="noopener"
                       class="flex items-center gap-3 text-sm text-bj-noir hover:text-bj-violet transition">
                        <span class="w-9 h-9 rounded-full bg-bj-creme flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-bj-violet" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.288.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                <path d="M12.004 2.003c-5.514 0-9.997 4.483-9.997 9.997 0 1.762.462 3.485 1.34 5.003L2 22l5.116-1.342a9.958 9.958 0 004.888 1.246h.004c5.514 0 9.997-4.483 9.997-9.998 0-2.67-1.04-5.18-2.928-7.07a9.935 9.935 0 00-7.073-2.929zm0 18.184h-.003a8.263 8.263 0 01-4.211-1.153l-.302-.18-3.036.797.81-2.96-.197-.304a8.235 8.235 0 01-1.262-4.39c0-4.552 3.706-8.257 8.264-8.257 2.207 0 4.281.86 5.842 2.422a8.196 8.196 0 012.417 5.84c0 4.553-3.706 8.258-8.322 8.185z"/>
                            </svg>
                        </span>
                        <span>
                            <span class="block text-bj-noir/50 text-xs">Nous laisser un message</span>
                            WhatsApp
                        </span>
                    </a>

                    <a href="mailto:contact@blacjoyaux.com" class="flex items-center gap-3 text-sm text-bj-noir hover:text-bj-violet transition">
                        <span class="w-9 h-9 rounded-full bg-bj-creme flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-bj-violet" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <span>
                            <span class="block text-bj-noir/50 text-xs">Email</span>
                            contact@blacjoyaux.com
                        </span>
                    </a>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-100 space-y-2 text-xs text-bj-noir/60">
                    <p>· Livraison à Abidjan sous 1 à 3 jours</p>
                    <p>· Paiement à la livraison : Espèces, Orange Money, Wave</p>
                </div>
            </aside>
        </div>
    </div>

@endsection
