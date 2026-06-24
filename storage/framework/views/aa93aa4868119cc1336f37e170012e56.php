
<script>
    function applyTheme(t) {
        document.documentElement.setAttribute('data-theme', t);
        localStorage.setItem('daisy-theme', t);
        document.querySelectorAll('[data-theme-option]').forEach(function (el) {
            var active = el.dataset.themeOption === t;
            el.classList.toggle('bg-base-200', active);
            el.classList.toggle('font-semibold', active);
        });
    }

    // Highlight the active theme when any dropdown opens
    document.addEventListener('DOMContentLoaded', function () {
        var saved = localStorage.getItem('daisy-theme') || 'corporate';
        document.querySelectorAll('[data-theme-option]').forEach(function (el) {
            var active = el.dataset.themeOption === saved;
            el.classList.toggle('bg-base-200', active);
            el.classList.toggle('font-semibold', active);
        });
    });
</script>
<?php /**PATH C:\projo\RealEstate-1\resources\views\partials\theme-customizer.blade.php ENDPATH**/ ?>