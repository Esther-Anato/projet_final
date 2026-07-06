{{-- resources/views/partials/whatsapp-widget.blade.php --}}
{{-- Widget WhatsApp flottant, inclus depuis le layout public → présent sur toutes les pages --}}
{{-- Remplace le numéro par le vrai (format international sans +). Idéalement via config/services. --}}
@php($waNumber = '2250545452215')

<div id="wa-widget" class="fixed right-5 bottom-20 lg:bottom-5 z-50">
    {{-- bulle d'accueil --}}
    <div id="wa-panel"
         class="absolute right-0 bottom-[74px] w-[300px] max-w-[calc(100vw-2.5rem)] bg-white rounded-2xl shadow-2xl overflow-hidden origin-bottom-right scale-95 opacity-0 invisible transition-all duration-200"
         role="dialog" aria-label="Discuter sur WhatsApp">
        <div class="bg-[#128C7E] text-white px-4 py-4 flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-bj-violet-dk text-bj-or grid place-items-center font-display font-bold text-sm shrink-0">BJ</div>
            <div>
                <div class="font-semibold text-sm">Blac Joyaux</div>
                <div class="text-xs opacity-85 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-300"></span> En ligne
                </div>
            </div>
        </div>
        <div class="p-4">
            <div class="bg-gray-100 rounded-[4px_14px_14px_14px] px-3.5 py-3 text-sm leading-relaxed">
                <strong class="block mb-1">Bonjour</strong>
                Une question sur un sac, une commande ou la livraison ? Écrivez-nous, nous répondons vite.
                <div class="text-[11px] text-gray-400 mt-1.5">Blac Joyaux</div>
            </div>
            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Bonjour Blac Joyaux, j\'ai une question.') }}"
               target="_blank" rel="noopener"
               class="mt-4 w-full flex items-center justify-center gap-2 bg-bj-wa text-[#0a3d1c] font-semibold text-sm py-3 rounded-full min-h-[46px] hover:brightness-105 transition">
                {{-- WhatsApp n'est pas dans heroicons → SVG dédié conservé --}}
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15l-1.3 4.8 4.9-1.3A10 10 0 1 0 12 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1-.4-.1-1-.3-1.7-.6-3-1.3-4.9-4.3-5-4.5-.2-.2-1.2-1.6-1.2-3s.7-2.1 1-2.4c.2-.3.5-.4.7-.4h.5c.2 0 .4 0 .6.5l.8 2c.1.1.1.3 0 .5l-.4.5-.3.3c-.1.1-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.3.1.5.1.6-.1l.7-.9c.2-.3.4-.2.6-.1l2 .9c.2.1.4.2.4.3.1.2.1.9-.1 1.6z"/></svg>
                Démarrer la discussion
            </a>
        </div>
    </div>

    {{-- bouton rond --}}
    <button id="wa-fab" aria-label="Ouvrir le chat WhatsApp" aria-expanded="false"
            class="relative w-15 h-15 w-[60px] h-[60px] rounded-full bg-bj-wa text-white grid place-items-center shadow-lg hover:scale-105 transition">
        <span id="wa-dot" class="absolute -top-0.5 -right-0.5 w-[18px] h-[18px] rounded-full bg-red-500 text-white text-[11px] font-bold grid place-items-center border-2 border-bj-creme">1</span>
        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.6 15l-1.3 4.8 4.9-1.3A10 10 0 1 0 12 2zm5.8 14.2c-.2.7-1.4 1.3-2 1.4-.5.1-1.2.1-1.9-.1-.4-.1-1-.3-1.7-.6-3-1.3-4.9-4.3-5-4.5-.2-.2-1.2-1.6-1.2-3s.7-2.1 1-2.4c.2-.3.5-.4.7-.4h.5c.2 0 .4 0 .6.5l.8 2c.1.1.1.3 0 .5l-.4.5-.3.3c-.1.1-.3.3-.1.6.2.3.8 1.3 1.7 2.1 1.2 1 2.1 1.4 2.4 1.5.3.1.5.1.6-.1l.7-.9c.2-.3.4-.2.6-.1l2 .9c.2.1.4.2.4.3.1.2.1.9-.1 1.6z"/></svg>
    </button>
</div>

@push('scripts')
<script>
    (function(){
        const fab   = document.getElementById('wa-fab');
        const panel = document.getElementById('wa-panel');
        const dot   = document.getElementById('wa-dot');
        const openCls = ['scale-100','opacity-100','visible'];
        const closeCls = ['scale-95','opacity-0','invisible'];

        function toggle(){
            const isOpen = panel.classList.contains('visible');
            if(isOpen){ panel.classList.remove(...openCls); panel.classList.add(...closeCls); }
            else { panel.classList.remove(...closeCls); panel.classList.add(...openCls); dot?.remove(); }
            fab.setAttribute('aria-expanded', !isOpen);
        }
        fab.addEventListener('click', toggle);
        document.addEventListener('click', e => {
            if(!e.target.closest('#wa-widget') && panel.classList.contains('visible')){
                panel.classList.remove(...openCls); panel.classList.add(...closeCls);
                fab.setAttribute('aria-expanded', false);
            }
        });
        document.addEventListener('keydown', e => {
            if(e.key === 'Escape' && panel.classList.contains('visible')){
                panel.classList.remove(...openCls); panel.classList.add(...closeCls);
            }
        });
    })();
</script>
@endpush
