<?php

namespace App\Services;

use App\Models\CmsSection;
use App\Support\CmsMedia;

class CmsContentService
{
    public function home(): array
    {
        return [
            'hero' => CmsSection::getContent('home', 'hero', $this->defaultHero()),
            'about' => CmsSection::getContent('home', 'about', $this->defaultAbout()),
            'books' => CmsSection::getContent('home', 'books', $this->defaultBooks()),
            'stanzas' => CmsSection::getContent('home', 'stanzas', $this->defaultStanzas()),
            'retail' => CmsSection::getContent('home', 'retail', $this->defaultRetail()),
            'testimonials' => CmsSection::getContent('home', 'testimonials', $this->defaultTestimonials()),
            'contact' => CmsSection::getContent('home', 'contact', $this->defaultContact()),
        ];
    }

    public function header(): array
    {
        return CmsSection::getContent('header', 'main', $this->defaultHeader());
    }

    public function footer(): array
    {
        return CmsSection::getContent('footer', 'main', $this->defaultFooter());
    }

    public function saveHome(array $input, array $files = []): void
    {
        CmsSection::putContent('home', 'hero', [
            'instagram_url' => $input['hero']['instagram_url'] ?? '',
            'facebook_url' => $input['hero']['facebook_url'] ?? '',
            'threads_url' => $input['hero']['threads_url'] ?? '',
        ]);

        $aboutCurrent = CmsSection::getContent('home', 'about', $this->defaultAbout());
        CmsSection::putContent('home', 'about', [
            'eyebrow' => $input['about']['eyebrow'] ?? '',
            'title' => $input['about']['title'] ?? '',
            'copy' => $input['about']['copy'] ?? '',
            'button_label' => $input['about']['button_label'] ?? '',
            'button_href' => $input['about']['button_href'] ?? '',
            'image' => CmsMedia::storeOrKeep($files['about']['image'] ?? null, $aboutCurrent['image'] ?? null, 'cms/about'),
            'instagram_url' => $input['about']['instagram_url'] ?? '',
            'facebook_url' => $input['about']['facebook_url'] ?? '',
            'threads_url' => $input['about']['threads_url'] ?? '',
        ]);

        $booksCurrent = CmsSection::getContent('home', 'books', $this->defaultBooks());
        $books = [];
        foreach ($input['books']['items'] ?? [] as $index => $item) {
            $current = $booksCurrent['items'][$index] ?? [];
            $books[] = [
                'label' => $item['label'] ?? '',
                'title' => $item['title'] ?? '',
                'copy' => $item['copy'] ?? '',
                'image' => CmsMedia::storeOrKeep(
                    $files['books']['items'][$index]['image'] ?? null,
                    $current['image'] ?? null,
                    'cms/books'
                ),
                'image_alt' => $item['image_alt'] ?? '',
                'image_width' => (int) ($item['image_width'] ?? 499),
                'image_height' => (int) ($item['image_height'] ?? 622),
                'image_side' => $item['image_side'] ?? 'left',
                'button_href' => $item['button_href'] ?? '#',
                'button_label' => $item['button_label'] ?? 'Read More',
            ];
        }
        CmsSection::putContent('home', 'books', ['items' => $books]);

        $stanzasCurrent = CmsSection::getContent('home', 'stanzas', $this->defaultStanzas());
        $cards = [];
        foreach ($input['stanzas']['cards'] ?? [] as $card) {
            $cards[] = [
                'title' => $card['title'] ?? '',
                'body' => $card['body'] ?? '',
                'page' => $card['page'] ?? '',
            ];
        }
        CmsSection::putContent('home', 'stanzas', [
            'eyebrow' => $input['stanzas']['eyebrow'] ?? '',
            'heading' => $input['stanzas']['heading'] ?? '',
            'left_art' => CmsMedia::storeOrKeep($files['stanzas']['left_art'] ?? null, $stanzasCurrent['left_art'] ?? null, 'cms/stanzas'),
            'right_art' => CmsMedia::storeOrKeep($files['stanzas']['right_art'] ?? null, $stanzasCurrent['right_art'] ?? null, 'cms/stanzas'),
            'cards' => $cards,
        ]);

        $retailCurrent = CmsSection::getContent('home', 'retail', $this->defaultRetail());
        CmsSection::putContent('home', 'retail', [
            'title' => $input['retail']['title'] ?? '',
            'copy' => $input['retail']['copy'] ?? '',
            'image' => CmsMedia::storeOrKeep($files['retail']['image'] ?? null, $retailCurrent['image'] ?? null, 'cms/retail'),
            'amazon_url' => $input['retail']['amazon_url'] ?? '',
            'amazon_logo' => CmsMedia::storeOrKeep($files['retail']['amazon_logo'] ?? null, $retailCurrent['amazon_logo'] ?? null, 'cms/retail'),
            'bn_url' => $input['retail']['bn_url'] ?? '',
            'bn_logo' => CmsMedia::storeOrKeep($files['retail']['bn_logo'] ?? null, $retailCurrent['bn_logo'] ?? null, 'cms/retail'),
        ]);

        $testimonialsCurrent = CmsSection::getContent('home', 'testimonials', $this->defaultTestimonials());
        $items = [];
        foreach ($input['testimonials']['items'] ?? [] as $index => $item) {
            $current = $testimonialsCurrent['items'][$index] ?? [];
            $items[] = [
                'name' => $item['name'] ?? '',
                'headline' => $item['headline'] ?? '',
                'quote' => $item['quote'] ?? '',
                'avatar' => CmsMedia::storeOrKeep(
                    $files['testimonials']['items'][$index]['avatar'] ?? null,
                    $current['avatar'] ?? null,
                    'cms/testimonials'
                ),
            ];
        }
        CmsSection::putContent('home', 'testimonials', [
            'title' => $input['testimonials']['title'] ?? '',
            'video' => CmsMedia::storeOrKeep($files['testimonials']['video'] ?? null, $testimonialsCurrent['video'] ?? null, 'cms/testimonials'),
            'poster' => CmsMedia::storeOrKeep($files['testimonials']['poster'] ?? null, $testimonialsCurrent['poster'] ?? null, 'cms/testimonials'),
            'deco_yarn' => CmsMedia::storeOrKeep($files['testimonials']['deco_yarn'] ?? null, $testimonialsCurrent['deco_yarn'] ?? null, 'cms/testimonials'),
            'deco_glasses' => CmsMedia::storeOrKeep($files['testimonials']['deco_glasses'] ?? null, $testimonialsCurrent['deco_glasses'] ?? null, 'cms/testimonials'),
            'items' => $items,
        ]);

        $contactCurrent = CmsSection::getContent('home', 'contact', $this->defaultContact());
        CmsSection::putContent('home', 'contact', [
            'title' => $input['contact']['title'] ?? '',
            'image' => CmsMedia::storeOrKeep($files['contact']['image'] ?? null, $contactCurrent['image'] ?? null, 'cms/contact'),
            'button_label' => $input['contact']['button_label'] ?? '',
            'button_href' => $input['contact']['button_href'] ?? '',
        ]);
    }

    public function saveHeader(array $input, array $files = []): void
    {
        $current = $this->header();
        $links = [];
        foreach ($input['nav_links'] ?? [] as $link) {
            if (blank($link['label'] ?? null) && blank($link['url'] ?? null)) {
                continue;
            }
            $links[] = [
                'label' => $link['label'] ?? '',
                'url' => $link['url'] ?? '',
            ];
        }

        CmsSection::putContent('header', 'main', [
            'logo' => CmsMedia::storeOrKeep($files['logo'] ?? null, $current['logo'] ?? null, 'cms/header'),
            'cta_label' => $input['cta_label'] ?? '',
            'cta_href' => $input['cta_href'] ?? '',
            'nav_links' => $links,
        ]);
    }

    public function saveFooter(array $input): void
    {
        CmsSection::putContent('footer', 'main', [
            'copyright' => $input['copyright'] ?? '',
        ]);
    }

    public function defaultHero(): array
    {
        return [
            'instagram_url' => 'https://www.instagram.com/author_jane_mansons?igsh=MW9qNHd0YzE1cWI4aw==',
            'facebook_url' => 'https://www.facebook.com/share/1D4edKsnNz/',
            'threads_url' => 'https://www.threads.net/@authorjanemansons',
        ];
    }

    public function defaultAbout(): array
    {
        return [
            'eyebrow' => 'About the Author',
            'title' => 'Jane Mansons',
            'copy' => "Jane Mansons is an author, advocate, and storyteller who believes every child deserves to see themselves reflected in the stories they read. Through the Benny series, she creates heartfelt adventures that help children navigate life’s challenges with courage, compassion, and confidence. Inspired by real life experiences and the children who have touched her heart, Jane writes stories that encourage empathy, celebrate differences, and remind young readers that their unique qualities are their greatest strengths. Each story offers meaningful lessons filled with warmth and hope, whether Benny is embracing what makes him different, helping a friend see the world in a new way, or finding the courage to face his fears. Jane is passionate about inspiring young minds and fostering conversations about acceptance, resilience, and emotional wellbeing. She believes stories can build confidence, spark understanding, and empower children to face life’s adventures with a brave heart. When she’s not writing, Jane enjoys spending time with her family, connecting with readers, and finding inspiration in everyday moments. She hopes the adventures of Benny encourage young readers to be kind, be brave, believe in themselves, and remember they are loved, just as they are.",
            'button_label' => 'Follow On',
            'button_href' => '#contact',
            'image' => 'frontend/assets/images/Group 1171276125_result.webp',
            'instagram_url' => 'https://www.instagram.com/author_jane_mansons?igsh=MW9qNHd0YzE1cWI4aw==',
            'facebook_url' => 'https://www.facebook.com/share/1D4edKsnNz/',
            'threads_url' => 'https://www.threads.net/@authorjanemansons',
        ];
    }

    public function defaultBooks(): array
    {
        return [
            'items' => [
                [
                    'label' => 'Book 1',
                    'title' => 'Benny & The Red Ear',
                    'copy' => 'When a summer storm leaves Benny the bear without an ear, Mia and Grandma repair him with the only yarn they have, bright red. In this sweet rhyming tale, Benny learns that what makes him different makes him special, and that love is the best thing to be stitched.',
                    'image' => 'frontend/assets/images/Group 1171276130.png',
                    'image_alt' => 'Benny & The Red Ear book cover',
                    'image_width' => 510,
                    'image_height' => 645,
                    'image_side' => 'left',
                    'button_href' => 'https://www.amazon.com/Benny-Red-Ear-Jane-Mansons-ebook/dp/B0FL13DQN7/ref=sr_1_8?crid=2F085JF3GKWTX&dib=eyJ2IjoiMSJ9.GafRLrtTuX9XUWKGf0_C-NHf6oLhZsispyY0w_vBuRgaelZ6FaieE2AinidZipsb8VHD5tMZaQVGRcL2jOoyFp_mRjRFe2S7bkt1db4ArdlEGg28zWWwdqScy5WZRAXLmc5SdNN4sGIvOaL5hAs5yiZ42tT9lG8LsFLDG9oitveYP4kXFFSsGRBr-breiN0UD-LLUpXfAEBKIh-g6NBkjqod9Q6fuswSA6iTRNfIhmY.-fYPJLNys5VCINpc8PSNKNyKFoILkzigmaKBcj3-xMI&dib_tag=se&keywords=jane+mansons&qid=1785166801&s=books&sprefix=jane+mansons%2Cstripbooks-intl-ship%2C507&sr=1-8#detailBullets_feature_div',
                    'button_label' => 'Read More',
                ],
                [
                    'label' => 'Book 2',
                    'title' => 'Benny Helps Mia See',
                    'copy' => 'When Mia starts having trouble seeing the chalkboard at school, she feels scared to tell anyone, especially after classmates begin to tease her. But her loyal friend, Benny the red-eared bear, is there to help her find her courage. With Benny’s gentle guidance, Mia learns that asking for help isn’t something to hide; it’s something brave. Benny Helps Mia See is a touching story about confidence, kindness, and the power of friendship.',
                    'image' => 'frontend/assets/images/Group 1171276131.png',
                    'image_alt' => 'Benny Helps Mia See book cover',
                    'image_width' => 499,
                    'image_height' => 622,
                    'image_side' => 'right',
                    'button_href' => 'https://www.amazon.com/Benny-Helps-Mia-Jane-Mansons/dp/B0G29JSC41/ref=sr_1_3?crid=2F085JF3GKWTX&dib=eyJ2IjoiMSJ9.GafRLrtTuX9XUWKGf0_C-NHf6oLhZsispyY0w_vBuRgaelZ6FaieE2AinidZipsb8VHD5tMZaQVGRcL2jOoyFp_mRjRFe2S7bkt1db4ArdlEGg28zWWwdqScy5WZRAXLmc5SdNN4sGIvOaL5hAs5yiZ42tT9lG8LsFLDG9oitveYP4kXFFSsGRBr-breiN0UD-LLUpXfAEBKIh-g6NBkjqod9Q6fuswSA6iTRNfIhmY.-fYPJLNys5VCINpc8PSNKNyKFoILkzigmaKBcj3-xMI&dib_tag=se&keywords=jane+mansons&qid=1785166801&s=books&sprefix=jane+mansons%2Cstripbooks-intl-ship%2C507&sr=1-3',
                    'button_label' => 'Read More',
                ],
                [
                    'label' => 'Book 3',
                    'title' => 'Benny and the Nighttime Brave',
                    'copy' => 'Benny and The Night Time Brave is a heartwarming story about courage, confidence, and discovering that being brave doesn\'t mean you\'re never afraid. When nighttime may bring unfamiliar sounds and shadows, Benny\'s encouragement and comfort instill resilience and self-confidence, while making bedtime a comforting and empowering experience.',
                    'image' => 'frontend/assets/images/Group 1171276105_result.webp',
                    'image_alt' => 'Benny and the Nighttime Brave book cover',
                    'image_width' => 499,
                    'image_height' => 622,
                    'image_side' => 'left',
                    'button_href' => 'https://www.amazon.com/BENNY-NIGHTTIME-BRAVE-JANE-MANSONS-ebook/dp/B0H8B5QVHG/ref=sr_1_1?crid=2F085JF3GKWTX&dib=eyJ2IjoiMSJ9.GafRLrtTuX9XUWKGf0_C-NHf6oLhZsispyY0w_vBuRgaelZ6FaieE2AinidZipsb8VHD5tMZaQVGRcL2jOoyFp_mRjRFe2S7bkt1db4ArdlEGg28zWWwdqScy5WZRAXLmc5SdNN4sGIvOaL5hAs5yiZ42tT9lG8LsFLDG9oitveYP4kXFFSsGRBr-breiN0UD-LLUpXfAEBKIh-g6NBkjqod9Q6fuswSA6iTRNfIhmY.-fYPJLNys5VCINpc8PSNKNyKFoILkzigmaKBcj3-xMI&dib_tag=se&keywords=jane+mansons&qid=1785166801&s=books&sprefix=jane+mansons%2Cstripbooks-intl-ship%2C507&sr=1-1',
                    'button_label' => 'Read More',
                ],
            ],
        ];
    }

    public function defaultStanzas(): array
    {
        return [
            'eyebrow' => 'The Book',
            'heading' => 'Stanzas',
            'left_art' => 'frontend/assets/images/Mia 1_result.webp',
            'right_art' => 'frontend/assets/images/Sammy 1_result.webp',
            'cards' => [
                [
                    'title' => 'BOOK 01',
                    'body' => "BUT WHAT MADE HIM DIFFERENT, THE THING YOU'D SOON SPOT, WAS THE EAR ON HIS RIGHT- IT WAS RED, NOT BROWN... NOT! THE TOYS ON THE SHELF WOULD WHISPER AND STARE, \"WHY'S BENNY'S EAR RED? THAT'S JUST NOT QUITE FAIR!",
                    'page' => '- Page no 08',
                ],
                [
                    'title' => 'BOOK 01',
                    'body' => "MIA JUST SMILED, HER EYES BRIGHT AND CLEAR, \"BENNY'S STILL BENNY - NO MATTER THE EAR.\" SO GRANDMA STITCHED GENTLY WITH FINGERS SO KIND, AND GAVE BENNY AN EAR THAT WOULD ALWAYS REMIND...",
                    'page' => '- Page no 21',
                ],
                [
                    'title' => 'BOOK 02',
                    'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard.',
                    'page' => '- Page no 00',
                ],
                [
                    'title' => 'BOOK 03',
                    'body' => "Pebbles was round, with patches so neat, She'd purr and curl at Sammy's feet. Her meow was soft-just a squeaky sound-But her love made Sammy feel safe and sound.",
                    'page' => '- Page no 06',
                ],
            ],
        ];
    }

    public function defaultRetail(): array
    {
        return [
            'title' => 'Available on Amazon and Barnes & Noble',
            'copy' => "Step into Benny’s world of courage, imagination, and heartwarming adventures. These beautifully illustrated books are perfect for young readers and families to enjoy together. Order your copy today and make every storytime extra special.",
            'image' => 'frontend/assets/images/Group 1171276117_result.webp',
            'amazon_url' => 'https://www.amazon.com/stores/author/B0FMZWCXY5/allbooks?_encoding=UTF8&ref_=aufs_ap_ahdr_dsk_ab&pd_rd_w=AjYQU&content-id=amzn1.sym.7e190e19-9f6f-4df8-807a-5a7608594741&pf_rd_p=7e190e19-9f6f-4df8-807a-5a7608594741&pf_rd_r=133-0573497-6442602&pd_rd_wg=hv8v4&pd_rd_r=39ac9449-9fe8-41a8-ac96-1fe14a6050c5',
            'amazon_logo' => 'frontend/assets/images/Group 1171276127_result.webp',
            'bn_url' => 'https://www.barnesandnoble.com/search?attributes.contributorId=32359008&contributorName=Jane%20Mansons',
            'bn_logo' => 'frontend/assets/images/Group 1171276115_result.webp',
        ];
    }

    public function defaultTestimonials(): array
    {
        return [
            'title' => "What Benny's Buddies Say",
            'video' => 'frontend/assets/videos/testimonials.mp4',
            'poster' => 'frontend/assets/images/Mask group_result.webp',
            'deco_yarn' => 'frontend/assets/images/testimonials-yarn.png',
            'deco_glasses' => 'frontend/assets/images/testimonials-glasses.png',
            'items' => [
                [
                    'name' => 'Amazon Customer',
                    'headline' => 'Very Impressive',
                    'quote' => 'My girls (both 5), love this book. Very well done and fun with a great message.',
                    'avatar' => 'frontend/assets/images/Mask group (1)_result.webp',
                ],
                [
                    'name' => 'Amazon Customer',
                    'headline' => 'I Realy Appreciate!!',
                    'quote' => 'Such a sweet story! Our 8-year-old loved reading this book aloud to her 2-month-old baby brother, and it was such a special moment watching them enjoy it together. The story is engaging and reflecting, even for older kids. While the rhythm and flow of the words kept the baby calm and happy. A wonderful book for families with kids of different ages—definitely a new favorite in our home!',
                    'avatar' => 'frontend/assets/images/Mask group (2)_result.webp',
                ],
                [
                    'name' => 'Ashley Fedor',
                    'headline' => 'Benny and The Red Ear',
                    'quote' => 'A sweet, rhyming picture book about Benny the bear, who loses an ear in a summer storm and gets patched up with the only yarn his family has on hand: bright red. What could have been an embarrassing moment turns into something tender instead, as Benny learns that his mismatched ear is what makes him special. My 8 year old really connected with that message, and loved reading it aloud to his little brother, who was completely charmed by the rhymes and the visuals that he could point to on every page. It has quickly become one of our favorite bedtime reads for both kids, and I suspect it will stay in the rotation for a long time.',
                    'avatar' => 'frontend/assets/images/Mask group (1)_result.webp',
                ],
                [
                    'name' => 'Ashley Fedor',
                    'headline' => 'I Realy Appreciate!!',
                    'quote' => 'A heartwarming follow-up to Benny and the Red Ear, this one follows Mia as she struggles to see the chalkboard at school and feels too scared to say anything, especially once classmates start teasing her. Benny, her loyal red-eared bear, gently helps her find the courage to speak up. My 8 year old related to the worry about being teased and loved watching Mia get brave, while my 2 year old just adored seeing Benny again, since he already feels like an old friend from the first book. Such a sweet, reassuring read about how asking for help is actually a brave thing to do, not something to hide. Highly recommend!!',
                    'avatar' => 'frontend/assets/images/Mask group (2)_result.webp',
                ],
                [
                    'name' => 'Alex',
                    'headline' => 'Very Impressive',
                    'quote' => 'My girls (4 and 2) loved it! Looking forward to book 2!',
                    'avatar' => 'frontend/assets/images/Mask group (2)_result.webp',
                ],
                [
                    'name' => 'Dr Laurie Emery ',
                    'headline' => 'Amazing!!',
                    'quote' => 'Benny & The Red Ear gently teaches children that what makes us different is not something to hide, but often the very thing that makes us uniquely lovable. Rather than preaching acceptance, the story allows children to experience it emotionally through Benny’s journey. It opens meaningful conversations about self-worth, resilience, empathy, and belonging, making it a wonderful resource for parents, grandparents, educators, and therapists alike. The warmth of the storytelling reminds children that love isn’t based on perfection—it’s found in being fully ourselves. I highly recommend this beautiful book to every family with young children. ',
                    'avatar' => 'frontend/assets/images/Mask group (2)_result.webp',
                ],
            ],
        ];
    }

    public function defaultContact(): array
    {
        return [
            'title' => "Benny's Buddies",
            'image' => 'frontend/assets/images/Group 1171276117_result.webp',
            'button_label' => 'Order Now',
            'button_href' => '/my-books',
        ];
    }

    public function defaultHeader(): array
    {
        return [
            'logo' => 'frontend/assets/images/Jane-mansons-white-logo.png',
            'cta_label' => 'Contact Me',
            'cta_href' => '#contact',
            'nav_links' => [
                ['label' => 'About the Author', 'url' => '/#about'],
                ['label' => 'Testimonial', 'url' => '/#testimonials'],
                ['label' => "Benny's Buddies", 'url' => '/#standards'],
            ],
        ];
    }

    public function defaultFooter(): array
    {
        return [
            'copyright' => '©Copyrights All Rights Reserved {year} | Jane Mansons',
        ];
    }
}
