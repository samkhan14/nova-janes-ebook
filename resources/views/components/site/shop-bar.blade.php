@props([
    'cartCount' => 0,
])

<div class="shop-bar">
    <div class="site-container shop-bar__inner">
        <a href="{{ route('books.index') }}" class="shop-bar__link">My Books</a>
        <a href="{{ route('cart.index') }}" class="shop-bar__cart">
            Cart
            <span class="shop-bar__badge">{{ (int) $cartCount }}</span>
        </a>
    </div>
</div>
