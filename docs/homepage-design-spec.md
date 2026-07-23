# Jane Manson Homepage Design Specification

## Goal

Rebuild the supplied Jane Manson landing page in Laravel 13 with Bootstrap, responsive behavior, reusable Blade components, and deliberate visual-regression checks.

The supplied reference is a compressed `239 × 1024` full-page image. It is enough to define structure, hierarchy, and approximate proportions, but not exact fonts, source-image crops, or production pixel values. True pixel parity requires the Figma URL/export plus original logos, book covers, portraits, illustrations, video thumbnails, and font files.

## Current Project State

- Fresh Laravel 13 application on PHP 8.3.
- Vite 8 is configured.
- The default welcome view is the only page.
- Bootstrap 5 is installed via npm/Vite (Tailwind removed).
- Homepage images: `public/frontend/assets/images/` via direct `asset('frontend/assets/images/...')` calls.
- Local fonts: `public/frontend/assets/fonts/` (Comic Sans family).
- Master layout: `resources/views/layouts/app.blade.php`.

## Page Structure

### 1. Header and hero

- Full-width warm ochre textured background.
- Compact header aligned to the same centered content container as the page.
- Left: Jane Manson wordmark.
- Center/right: anchor navigation for About, Books, Book Standards, Trailers, and Contact.
- Far right: small dark rounded purchase/action button.
- Hero content uses a two-column layout.
- Left: large white headline, then a smaller white subtitle: connection, friendship, and the power of love.
- Right: three overlapping/upright book covers, visually extending toward the section edge.
- Preserve generous top/bottom breathing room; the books are the dominant visual.

### 2. Author introduction

- White background with a centered two-column container.
- Left: eyebrow text, large “Jane Manson” heading, biography copy, and dark pill button.
- Right: rounded author portrait.
- Small character/book decoration overlaps the lower-left edge of the portrait.
- Keep text measure narrow; do not stretch biography copy across the column.

### 3. Books showcase

- Ochre textured background and three alternating book rows.
- Row 1: “Benny & the Red Ear”; cover left, copy right.
- Row 2: “Benny Helps Mia See”; copy left, cover right.
- Row 3: “Benny and the Nighttime Brave”; cover left, copy right.
- Each description includes a small dark purchase/details button.
- Use one reusable `book-feature` Blade component with an `imageSide` option.
- Align headings and body text consistently despite alternating layouts.
- Decorative white dotted/line details are background accents, not content images.

### 4. Book standards

- White background with centered heading “The Book Standards”.
- Four compact information cards in a two-by-two desktop grid.
- Cards have thin dark outlines, small headings, body copy, and modest rounded corners.
- Large child illustrations sit at the far left and right as decorative edge art.
- A centered dark pill button closes the section.
- Decorative art must not overlap readable content at tablet/mobile widths.

### 5. Retail purchase banner

- Short ochre strip.
- Left: grouped book covers.
- Right: large white “Available on Amazon and Barnes & Noble” heading.
- Retailer logos/buttons sit below the heading.
- Entire banner should remain visually compact compared with content sections.

### 6. Video trailers

- White section with centered “Video Trailers” heading and small decorative subtitle.
- One wide media card split into two thumbnails.
- Left thumbnail label: “Benny Helps”; right: “Mia See”.
- A circular ochre play button is centered over the split.
- Use an accessible button, poster images, and a modal/embed loaded only after interaction.
- Card has rounded corners, clipped imagery, dark overlay, and white labels.

### 7. Testimonials

- White background with centered “Testimonials / What People Say” heading.
- Large centered video/poster image directly under the heading.
- Decorative dog illustrations sit near both outer heading edges.
- Three testimonial columns follow, each with a small circular avatar, name/meta, and short quote.
- Keep quotes equal-height where practical and stack them on narrow screens.

### 8. Contact and footer

- Ochre textured background.
- Left: grouped books and a small action button.
- Right: “Contact Form” heading and compact form.
- First row has two equal inputs; message textarea spans the full form width.
- Submit action is a dark pill button.
- Footer content is integrated at the section bottom with copyright/legal text and a thin visual divider.
- Laravel must validate and escape all submitted values; visual implementation should not fake a working form.

## Visual System

### Color direction

- Primary ochre: sample from the source asset/Figma; initial estimate `#C97E16` to `#D18A22`.
- Deep brown text/button: initial estimate `#4A260C`.
- Warm white: `#FFFDF8`.
- White: `#FFFFFF`.
- Muted copy: warm gray/brown rather than neutral blue-gray.
- Video overlay: translucent deep plum/brown.

Treat these as temporary values until Figma tokens or sampled source colors are available.

### Typography

- Display headings use a playful hand-drawn/rounded face.
- Body copy uses a clean, highly readable sans serif.
- Use locally hosted or licensed webfonts; do not approximate the logo with plain text.
- Define font families, sizes, line heights, tracking, and weights as CSS custom properties.
- Maintain short heading line lengths and avoid artificial `<br>` elements except where the composition requires a controlled desktop break.

### Shape and texture

- Buttons are small dark pills with light text.
- Media and portrait corners are visibly rounded but not fully pill-shaped.
- Ochre sections use a subtle paper/grain texture.
- Texture should be a lightweight optimized asset or pseudo-element and must not reduce text contrast.

## Spacing Baseline

The screenshot proportions suggest alternating section heights of roughly:

- Hero: 11% of page height.
- Author: 9%.
- Books: 19%.
- Standards: 14%.
- Retail banner: 7%.
- Trailers: 14%.
- Testimonials: 16%.
- Contact/footer: 10%.

Use these only as visual ratios. Establish spacing tokens before styling:

- `--space-1: 0.25rem`
- `--space-2: 0.5rem`
- `--space-3: 0.75rem`
- `--space-4: 1rem`
- `--space-6: 1.5rem`
- `--space-8: 2rem`
- `--space-12: 3rem`
- `--space-16: 4rem`
- `--space-24: 6rem`

Desktop content should use one shared max-width container, approximately `1140–1200px`, with `24–32px` gutters. Start major sections near `80–96px` vertical padding, compact banners near `40–56px`, and reduce progressively at Bootstrap breakpoints. Final values must come from screenshot comparison, not arbitrary one-off margins.

## Responsive Behavior

- Desktop (`≥ 992px`): preserve the reference’s two-column and alternating layouts.
- Tablet (`768–991px`): reduce decorative art, tighten gaps, retain two columns only where text remains comfortable.
- Mobile (`< 768px`): stack content, center primary headings/actions, and use a collapsed accessible navbar.
- On mobile, keep each book cover adjacent to its own text; alternating desktop direction must not produce a confusing reading order.
- Make videos fluid with `aspect-ratio: 16 / 9`.
- Prevent decorative images from causing horizontal overflow.
- Respect `prefers-reduced-motion`.

## Laravel and Bootstrap Architecture

Recommended structure:

- `resources/views/layouts/app.blade.php`
- `resources/views/home.blade.php`
- `resources/views/components/site/header.blade.php`
- `resources/views/components/site/section-heading.blade.php`
- `resources/views/components/site/book-feature.blade.php`
- `resources/views/components/site/testimonial.blade.php`
- `resources/views/components/site/contact-form.blade.php`
- `resources/css/app.css`
- `resources/js/app.js`
- `public/images/home/...`

Keep page content in structured configuration/data rather than duplicating markup for three books or testimonials. Keep components presentational and move contact submission to a dedicated controller plus form request when backend behavior is added.

## Implementation Sequence

1. Obtain and inventory the original assets and exact fonts.
2. Install Bootstrap through npm and remove Tailwind-specific setup.
3. Create global design tokens and the shared Blade layout.
4. Build semantic section markup without fine styling.
5. Implement header/hero and shared responsive container.
6. Build reusable book and testimonial components.
7. Implement remaining sections in page order.
8. Add interactions: navbar, trailer modal, and validated contact form.
9. Compare screenshots at `1440`, `1024`, `768`, `390`, and `360` widths.
10. Tune tokens and component rules; avoid viewport-specific one-off patches.

## Pixel-Perfect Acceptance Checklist

- Content and section order match the reference.
- Shared left/right alignment lines remain consistent across sections.
- Section padding, inter-column gaps, and text measure are verified at all target widths.
- Book covers, portrait, illustrations, and posters use correct source crops and aspect ratios.
- Fonts, heading wrapping, colors, texture, radii, and buttons match approved design tokens.
- No cumulative layout shift from images or fonts.
- Keyboard navigation, visible focus, labels, alt text, and contrast are present.
- No horizontal overflow from decorative assets.
- Production build succeeds and browser console has no errors.
- Visual differences are documented when the low-resolution reference does not provide enough evidence.

## Inputs Still Required for Exact Parity

- Figma file/link or full-resolution desktop and mobile exports.
- Original logo and all image assets.
- Font family names/files and licensing details.
- Exact destination URLs for navigation and retailer buttons.
- Trailer video URLs and preferred playback behavior.
- Final author, book, standards, testimonial, and footer copy.
- Contact recipient and submission behavior.
