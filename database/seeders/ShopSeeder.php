<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Benny & The Red Ear',
                'slug' => 'benny-and-the-red-ear',
                'tag' => 'Book 01',
                'description' => 'A warm story about belonging, kindness, and the power of being uniquely you — starring Benny, the red-eared bear.',
                'cover_image' => 'frontend/assets/images/Group 1171276130.png',
                'amazon_ebook_url' => 'https://www.amazon.com/Benny-Red-Ear-Jane-Mansons-ebook/dp/B0FL13DQN7',
                'sort_order' => 1,
                'paperback' => 12.99,
                'hardcover' => 19.99,
            ],
            [
                'title' => 'Benny Helps Mia See',
                'slug' => 'benny-helps-mia-see',
                'tag' => 'Book 02',
                'description' => 'When Mia struggles to see the chalkboard, Benny helps her find the courage to ask for help — a touching story about confidence, kindness, and friendship.',
                'cover_image' => 'frontend/assets/images/Group 1171276131.png',
                'amazon_ebook_url' => 'https://www.amazon.com/Benny-Helps-Mia-Jane-Mansons/dp/B0G29JSC41',
                'sort_order' => 2,
                'paperback' => 12.99,
                'hardcover' => 19.99,
            ],
            [
                'title' => 'Benny and the Nighttime Brave',
                'slug' => 'benny-and-the-nighttime-brave',
                'tag' => 'Book 03',
                'description' => 'A heartwarming bedtime story about courage and confidence — Benny shows that being brave doesn’t mean never being afraid.',
                'cover_image' => 'frontend/assets/images/Group 1171276105_result.webp',
                'amazon_ebook_url' => 'https://www.amazon.com/BENNY-NIGHTTIME-BRAVE-JANE-MANSONS-ebook/dp/B0H8B5QVHG',
                'sort_order' => 3,
                'paperback' => 12.99,
                'hardcover' => 19.99,
            ],
        ];

        foreach ($books as $book) {
            $product = Product::query()->updateOrCreate(
                ['slug' => $book['slug']],
                [
                    'title' => $book['title'],
                    'tag' => $book['tag'],
                    'description' => $book['description'],
                    'cover_image' => $book['cover_image'],
                    'amazon_ebook_url' => $book['amazon_ebook_url'],
                    'sort_order' => $book['sort_order'],
                    'is_active' => true,
                ]
            );

            $skuBase = Str::upper(Str::substr(Str::replace('-', '', $book['slug']), 0, 12));

            $product->variants()->updateOrCreate(
                ['format' => 'paperback'],
                [
                    'label' => 'Paperback',
                    'price' => $book['paperback'],
                    'sku' => $skuBase.'-PB',
                    'is_active' => true,
                ]
            );

            $product->variants()->updateOrCreate(
                ['format' => 'hardcover'],
                [
                    'label' => 'Hardcover',
                    'price' => $book['hardcover'],
                    'sku' => $skuBase.'-HC',
                    'is_active' => true,
                ]
            );
        }
    }
}
