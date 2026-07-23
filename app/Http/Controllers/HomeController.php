<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'books' => [
                [
                    'label' => 'Book 01',
                    'title' => 'Benny & The Red Ear',
                    'copy' => 'A warm story about kindness, belonging, and the courage it takes to be yourself.',
                    'image' => 'frontend/assets/images/Book Cover Mockup on Isolated White Background (3) 1_result.webp',
                    'imageAlt' => 'Benny & The Red Ear book cover',
                    'imageWidth' => 391,
                    'imageHeight' => 607,
                    'imageSide' => 'left',
                ],
                [
                    'label' => 'Book 02',
                    'title' => 'Benny Helps Mia See',
                    'copy' => 'Friendship blooms as Benny helps Mia find confidence, connection, and a brighter day.',
                    'image' => 'frontend/assets/images/Book Cover Mockup on Isolated White Background (2) 1_result.webp',
                    'imageAlt' => 'Benny Helps Mia See book cover',
                    'imageWidth' => 373,
                    'imageHeight' => 581,
                    'imageSide' => 'right',
                ],
                [
                    'label' => 'Book 03',
                    'title' => 'Benny and the Nighttime Brave',
                    'copy' => 'When night feels big and scary, Benny reminds little hearts that bravery can start soft and small.',
                    'image' => 'frontend/assets/images/Group 1171276105_result.webp',
                    'imageAlt' => 'Benny and the Nighttime Brave book cover',
                    'imageWidth' => 499,
                    'imageHeight' => 622,
                    'imageSide' => 'left',
                ],
            ],
            'standards' => [
                [
                    'title' => 'Stanza I: Love learns to fly',
                    'copy' => 'Gentle pages that help children notice feelings, friendship, and everyday courage.',
                ],
                [
                    'title' => 'Stanza II: Differences shine',
                    'copy' => 'Stories that celebrate uniqueness and teach empathy through playful adventure.',
                ],
                [
                    'title' => 'Stanza III: Brave little nights',
                    'copy' => 'Comforting moments for bedtime fears, soft reassurance, and hopeful endings.',
                ],
                [
                    'title' => 'Stanza IV: Friends forever',
                    'copy' => 'Warm characters that invite families to read together and talk about kindness.',
                ],
            ],
            'testimonials' => [
                [
                    'name' => 'Sarah Mitchell',
                    'role' => 'Happy Parent',
                    'quote' => 'These books helped my child talk about feelings with so much confidence and joy.',
                    'avatar' => 'frontend/assets/images/Mask group (1)_result.webp',
                ],
                [
                    'name' => 'Daniel Cole',
                    'role' => 'Teacher',
                    'quote' => 'Perfect classroom read-alouds. The illustrations and messages land beautifully every time.',
                    'avatar' => 'frontend/assets/images/Mask group (2)_result.webp',
                ],
                [
                    'name' => 'Priya Nair',
                    'role' => 'Book Lover',
                    'quote' => 'Benny feels like a friend. We return to these stories again and again at bedtime.',
                    'avatar' => 'frontend/assets/images/Mask group (1)_result.webp',
                ],
            ],
        ]);
    }

    public function contact(ContactRequest $request): RedirectResponse
    {
        return back()->with('contact_status', 'Thank you. Your message has been received.');
    }
}
