@props([
    'footer' => [],
])

<footer class="site-footer site-footer--books">
    <div class="site-container">
        <p class="mb-0">
            {{ str_replace('{year}', (string) date('Y'), $footer['copyright'] ?? '©Copyrights All Rights Reserved '.date('Y').' | Jane Mansons') }}
        </p>
    </div>
</footer>
