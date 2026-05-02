<button
    type="button"
    id="back-to-top"
    class="fixed bottom-6 right-6 z-[55] flex h-12 w-12 translate-y-1 items-center justify-center rounded-full bg-night-850 text-white opacity-0 shadow-lg shadow-night-900/25 transition-all duration-300 hover:bg-night-700 hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-400 focus-visible:ring-offset-2 pointer-events-none"
    aria-label="{{ __('site.nav.back_to_top') }}"
>
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
</button>
<script>
    (function () {
        var btn = document.getElementById('back-to-top');
        if (!btn) return;
        function toggle() {
            var show = window.scrollY > 220;
            btn.classList.toggle('opacity-0', !show);
            btn.classList.toggle('pointer-events-none', !show);
            btn.classList.toggle('translate-y-1', !show);
            btn.classList.toggle('opacity-100', show);
            btn.classList.toggle('translate-y-0', show);
        }
        toggle();
        window.addEventListener('scroll', toggle, { passive: true });
        btn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
</script>
