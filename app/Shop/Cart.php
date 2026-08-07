<?php

namespace App\Shop;

use App\Models\ProductVariant;
use Illuminate\Support\Facades\Session;

/**
 * Simple session cart for print books.
 * Stored as: [ variant_id => quantity ]
 */
class Cart
{
    public static function items(): array
    {
        $saved = Session::get('cart', []);
        $rows = [];

        foreach ($saved as $variantId => $qty) {
            $variant = ProductVariant::with('product')
                ->where('id', $variantId)
                ->where('is_active', true)
                ->first();

            if (! $variant || ! $variant->product || ! $variant->product->is_active) {
                continue;
            }

            $qty = max(1, (int) $qty);
            $rows[] = [
                'variant' => $variant,
                'qty' => $qty,
                'line_total' => round($variant->price * $qty, 2),
            ];
        }

        return $rows;
    }

    public static function count(): int
    {
        return (int) array_sum(Session::get('cart', []));
    }

    public static function subtotal(): float
    {
        $total = 0;

        foreach (self::items() as $row) {
            $total += $row['line_total'];
        }

        return round($total, 2);
    }

    public static function shipping(): float
    {
        if (self::count() === 0) {
            return 0;
        }

        return round((float) config('shop.shipping_fee', 5.99), 2);
    }

    public static function total(): float
    {
        return round(self::subtotal() + self::shipping(), 2);
    }

    public static function add(int $variantId, int $qty = 1): void
    {
        $cart = Session::get('cart', []);
        $qty = max(1, min(20, $qty));
        $cart[$variantId] = min(20, ($cart[$variantId] ?? 0) + $qty);
        Session::put('cart', $cart);
    }

    public static function setQty(int $variantId, int $qty): void
    {
        $cart = Session::get('cart', []);

        if ($qty < 1) {
            unset($cart[$variantId]);
        } else {
            $cart[$variantId] = min(20, $qty);
        }

        Session::put('cart', $cart);
    }

    public static function remove(int $variantId): void
    {
        $cart = Session::get('cart', []);
        unset($cart[$variantId]);
        Session::put('cart', $cart);
    }

    public static function clear(): void
    {
        Session::forget('cart');
    }

    public static function isEmpty(): bool
    {
        return self::count() === 0;
    }

    /** Handy payload for AJAX responses */
    public static function summary(): array
    {
        $symbol = config('shop.currency_symbol', '$');

        $items = [];
        foreach (self::items() as $row) {
            $variant = $row['variant'];
            $items[] = [
                'variant_id' => $variant->id,
                'title' => $variant->product->title,
                'label' => $variant->label,
                'qty' => $row['qty'],
                'line_total' => $row['line_total'],
                'line_total_text' => $symbol.number_format($row['line_total'], 2),
                'cover' => $variant->product->coverUrl(),
            ];
        }

        return [
            'count' => self::count(),
            'subtotal' => self::subtotal(),
            'shipping' => self::shipping(),
            'total' => self::total(),
            'subtotal_text' => $symbol.number_format(self::subtotal(), 2),
            'shipping_text' => $symbol.number_format(self::shipping(), 2),
            'total_text' => $symbol.number_format(self::total(), 2),
            'items' => $items,
            'empty' => self::isEmpty(),
        ];
    }
}
