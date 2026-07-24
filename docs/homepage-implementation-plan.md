# Homepage Implementation Plan

App status: `http://janesebook.test/` is live (**HTTP 200**) via Laragon Apache + MySQL. Migrations applied. Vite assets built.

## Done

- Laravel 13 + Bootstrap 5 (Tailwind removed)
- Master layout + reusable Blade components
- Local Comic fonts + images from `public/frontend/assets`
- All major section scaffolds (hero → contact)
- Alternating book rows, stanzas grid, retail logos, trailer play shell, testimonials, contact POST validation
- Design docs/rules/skills for future low-token work

## Design vs live (key mismatches)

Compared against `Jane Manson_design.webp` (full page reference):

| Section | Live now | Design expects |
|---------|----------|----------------|
| Header nav | Meet Author / Books / Gallery / Trailers / Contact + Order Now | About the Author / Testimonial / Gallery / Video Trailers / Contact Us + Contact Us CTA |
| Hero CTAs | Shop Now / Watch Video | Order Now / Read More |
| Author | Read More only | Follow Me + Instagram/Facebook icons |
| Books | Structure OK | Add dotted dividers + tighter rhythm |
| Book Stanzas | Static 4 cards | Book 01 / 02 / 03 **tabs** above cards |
| Retail | Present | More compact banner |
| Video Trailers | White bg, single poster | Dark brown bg, book tabs, side blurred thumbs, title overlay |
| Testimonials | What People Say | Dual title “Testimonials / What People Say”; cards need bold headlines |
| Contact form | Name / Email / Phone / Message | Name / First Name / Last Name / Email / Message |
| Overall | Rough spacing | Token-based spacing pass for pixel parity |

## Remaining — next implementation order

### Sprint A (next — highest impact)
1. Align header labels + hero CTA labels to design.
2. Lock color/spacing tokens from ochre sparkle background.
3. Fix logo + retailer badges (black matte backgrounds).
4. Header + hero spacing/typography pass.

### Sprint B (section polish)
5. Author: Follow Me + social icons.
6. Books: dotted accents + vertical rhythm.
7. Stanzas: add Book 01/02/03 tabs (content can swap later).
8. Retail: compact height + white logo pills.
9. Trailers: dark section, tabs, side thumbs, overlay title, modal stub.
10. Testimonials: dual heading + card headlines/stars.
11. Contact: match field grid to design.

### Sprint C (parity)
12. Responsive screenshot check: 1440 / 1024 / 768 / 390 / 360.
13. Overflow/decorative art fixes.
14. Only after this: ecommerce pages.

## Still needed from you for true pixel parity

- Figma link (or desktop + mobile exports)
- Final copy (design uses placeholder text)
- Social icon assets / URLs
- Trailer video URLs
- Extra assets if available (2nd cat, clean logo without black plate)

## Start next

Say **“start Sprint A”** and we implement header/hero + tokens first.
