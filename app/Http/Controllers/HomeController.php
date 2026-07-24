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
                    'label' => 'Book 1',
                    'title' => 'Benny & The Red Ear',
                    'copy' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's Body Type sheets.",
                    'image' => 'frontend/assets/images/Book Cover Mockup on Isolated White Background (3) 1_result.webp',
                    'imageAlt' => 'Benny & The Red Ear book cover',
                    'imageWidth' => 391,
                    'imageHeight' => 607,
                    'imageSide' => 'left',
                ],
                [
                    'label' => 'Book 2',
                    'title' => 'Benny Helps Mia See',
                    'copy' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's Body Type sheets.",
                    'image' => 'frontend/assets/images/Book Cover Mockup on Isolated White Background (2) 1_result.webp',
                    'imageAlt' => 'Benny Helps Mia See book cover',
                    'imageWidth' => 373,
                    'imageHeight' => 581,
                    'imageSide' => 'right',
                ],
                [
                    'label' => 'Book 3',
                    'title' => 'Benny and the Nighttime Brave',
                    'copy' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset's Body Type sheets.",
                    'image' => 'frontend/assets/images/Group 1171276105_result.webp',
                    'imageAlt' => 'Benny and the Nighttime Brave book cover',
                    'imageWidth' => 499,
                    'imageHeight' => 622,
                    'imageSide' => 'left',
                ],
            ],
            'standards' => [
                [
                    'title' => 'BOOK 01 Lorem Ipsum is simply dummy',
                    'copy' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.',
                    'page' => '05',
                ],
                [
                    'title' => 'BOOK 01 Lorem Ipsum is simply dummy',
                    'copy' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.',
                    'page' => '05',
                ],
                [
                    'title' => 'BOOK 01 Lorem Ipsum is simply dummy',
                    'copy' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.',
                    'page' => '05',
                ],
                [
                    'title' => 'BOOK 01 Lorem Ipsum is simply dummy',
                    'copy' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.',
                    'page' => '05',
                ],
            ],
            'testimonials' => [
                [
                    'name' => 'Lorem Ipsum',
                    'headline' => 'I Realy Appreciate!!',
                    'quote' => 'These books helped my child talk about feelings with so much confidence and joy.',
                    'avatar' => 'frontend/assets/images/Mask group (1)_result.webp',
                ],
                [
                    'name' => 'Lorem Ipsum',
                    'headline' => 'Very Impressive',
                    'quote' => 'Perfect classroom read-alouds. The illustrations and messages land beautifully every time.',
                    'avatar' => 'frontend/assets/images/Mask group (2)_result.webp',
                ],
                [
                    'name' => 'Lorem Ipsum',
                    'headline' => 'Amazing!!',
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
