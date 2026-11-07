# Design System & Reference Analysis: Klayvi (`klayvi.com`)
**Project**: Oreon Living — Production Modern Earthenware & Terracotta Lifestyle Platform  
**Role**: Senior UI/UX Designer & Lead Frontend Developer  
**Status**: Implementation Complete & Verified against Klayvi Reference (16/16 PHPUnit Tests Passed)

---

## 1. Executive Summary & Brand Translation

### Reference Analysis: Klayvi (`klayvi.com`)
Klayvi is an upscale direct-to-consumer lifestyle brand based in Gurgaon, India, creating handcrafted, lab-certified "bio-active" clayware, unglazed cookware, and biophilic home decor. Its digital experience rejects the cluttered, rustic, "bazaar-style" handicraft aesthetic in favor of a **contemporary, high-contrast, mindful architectural sanctuary**. 

### Translation to Oreon Living
We will translate Klayvi's visual language into **Oreon Living** (*"Crafted from Earth. Designed for Modern Living"*), capturing the tactile beauty, unglazed clay textures, and serene editorial cadence while delivering a seamless, high-performance Laravel/Blade e-commerce experience.

```
+---------------------------------------------------------------------------------------+
|  KLAYVI CORE ESSENCE                                                                  |
|  - "Soil to Soul" wellness movement                                                   |
|  - High-end editorial typography (classical Spanish serif + geometric sans)           |
|  - High contrast: warm ivory / bone surfaces alternating with deep obsidian black     |
|  - Terracotta umber (#8D725B) as a signature warm grounding accent                   |
|  - Uncluttered, generous breathing whitespace with purposeful asymmetrical grids      |
+---------------------------------------------------------------------------------------+
```

---

## 2. Visual Language & Emotional Resonance

1. **Mindful Minimalism over Promotional Clutter**:
   - Zero aggressive popups, countdown timers, or saturated gradient badges.
   - Spacious margins and generous leading that allow individual earthen pieces to be appreciated as sculptural objects.
2. **Tactile Earthiness Meets Modern Architecture**:
   - The interface acts like a calm art gallery or modern Scandinavian kitchen. Warm bone backgrounds (`#FBF6F1`, `#F8F5F2`) echo natural riverbed silt and limestone plaster, while deep rich blacks (`#000000`, `#1C1917`) provide dramatic framing.
3. **Typography as Art Direction**:
   - Distinctive typography using **Ibarra Real Nova** for display titles with intentional casing shifts (e.g., `BRINGING NATURE to your HOME`, `Our COLLECTIONS`, `THE ZERO-TOXIN STANDARD`), paired with the precision of **Manrope** for legible UI controls, specs, and body narrative.
4. **Authentic Imagery & Zero Artificiality**:
   - Studio product photography showcasing real unglazed porosity, wheel-thrown turning marks, steam from slow-simmering handis, and botanical interiors.

---

## 3. Color Palette & Design Tokens

Klayvi uses a strictly disciplined palette rooted in earth minerals, charcoal, and warm plaster:

### Core Palette

| Token Name | Hex Code | Purpose & Application |
| :--- | :--- | :--- |
| `--color-clay-primary` | `#8D725B` | **Signature Raw Clay / Terracotta**: Primary buttons, interactive accents, overline kickers, active badges. |
| `--color-clay-hover` | `#6E5643` | **Deep Fired Clay**: Active and hover states for primary buttons. |
| `--color-umber-dark` | `#493F38` | **Deep Earth Umber**: Secondary dark accent, quote borders, subtle emphasis. |
| `--color-surface-base` | `#FFFFFF` | **Pure Canvas**: Product detail card containers, clean backdrops. |
| `--color-surface-warm` | `#FBF6F1` | **Raw Ceramic Ivory**: Primary section backgrounds, alternating content modules. |
| `--color-surface-subtle` | `#F8F5F2` | **Soft Silt Plaster**: Submenus, page headers, notification ribbons. |
| `--color-surface-dark` | `#000000` | **Obsidian Grounding**: Site header, philosophy quote banners, site footer. |
| `--color-text-main` | `#1C1917` | **Rich Charcoal**: Primary headings, product titles, high-contrast body text. |
| `--color-text-body` | `#373737` | **Muted Iron**: Editorial paragraphs, specifications, descriptions. |
| `--color-text-muted` | `#78716C` | **Weathered Stone**: Breadcrumbs, SKU codes, secondary captions. |
| `--color-border-subtle` | `#ECE4DC` | **Fine Sand Separation**: 1px structural borders, dividers, subtle outlines. |
| `--color-border-dark` | `#2D2926` | **Dark Frame Dividers**: Subtle borders inside dark footer and statement sections. |

---

## 4. Typography Hierarchy & System

Klayvi’s exact font pairing has been extracted directly from the live reference:
- **Display & Headings**: `Ibarra Real Nova` (Google Font: weights 400, 500, 600, 700)
- **Body, Navigation, Buttons & UI**: `Manrope` (Google Font: weights 300, 400, 500, 600, 700)

```
========================================================================================
TYPOGRAPHIC SCALE & STYLES
========================================================================================
Element          Font Family        Weight  Size (Desktop / Mobile)    Line-Height  Letter-Spacing
----------------------------------------------------------------------------------------
Hero H1          Ibarra Real Nova   400     4.0rem (64px) / 2.75rem    1.2em        -0.02em
Section H2       Ibarra Real Nova   400     3.0rem (48px) / 2.15rem    1.25em       -0.01em
Subtitle H3      Ibarra Real Nova   400     2.25rem (36px) / 1.75rem   1.3em        0px
Card Title H4    Ibarra Real Nova   500     1.5rem (24px) / 1.25rem    1.35em       0px
Editorial H5     Ibarra Real Nova   500     1.25rem (20px) / 1.1rem    1.4em        0px
Overline H6      Manrope            600     0.875rem (14px)            1.3em        3px (0.2em) uppercase
Body Regular     Manrope            400     1.0rem (16px) / 0.9375rem  1.8em        0px
Body Lead        Manrope            400     1.125rem (18px)            1.75em       0px
Button Text      Manrope            500     0.9375rem (15px)           1.0em        0.5px
UI Microcopy     Manrope            500     0.75rem (12px)             1.4em        0.05em uppercase
```

### Editorial Heading Casing Rule
Following Klayvi's signature style:
- Section headings use a rhythm of uppercase emphasis with subtle lowercase words:
  `BRINGING NATURE to your HOME`, `Our COLLECTIONS`, `DESIGNED for the Modern SOUL`, `THE ZERO-TOXIN STANDARD`.
- Category kickers (h6) are always tracked uppercase (`letter-spacing: 3px`) in clay accent (`#8D725B`).

---

## 5. Spacing, Layout & Alignment Architecture

- **Max Container Width**: `1300px` (with `24px` gutter on mobile, `48px` on desktop).
- **Spatial Rhythm**: Multiples of 8px (8, 16, 24, 32, 48, 64, 96, 128px).
- **Section Padding**: `clamp(4rem, 8vw, 7.5rem) 0` for generous, museum-like cadence.
- **Alternating Cadence**:
  1. *Header / Hero*: Luminous warm ivory backdrop with asymmetric imagery.
  2. *Collections Showcase*: Warm silt (`#FBF6F1`) with tactile card cutouts.
  3. *Featured Pieces Grid*: Crisp white canvas (`#FFFFFF`) with 4:5 vertical proportion photography.
  4. *Philosophical Quote*: Deep grounding black (`#000000`) with dramatic serif typography.
  5. *Zero-Toxin Standard (Trust Matrix)*: Clean 4-pillar grid with fine sand borders.
  6. *Artisan Craft & Science*: Two-column editorial storytelling split.
  7. *Footer Sanctuary*: Grounded black (`#000000`) with warm stone typography and discrete newsletter field.

---

## 6. Component Specifications & Interactive Patterns

### 6.1 Sticky Announcement Ribbon
- Height: ~42px
- Background: `#000000` or `#8D725B`
- Typography: Manrope 12px, weight 500, letter-spacing 0.5px
- Features: Pan-India complimentary shipping notice + direct link with subtle arrow.

### 6.2 Architectural Header
- Background: Solid ivory (`#F8F5F2`) transitioning to blurred translucent elevation on scroll (`rgba(248, 245, 242, 0.95)` with backdrop-filter).
- Logo: Editorial serif logotype `OREON LIVING` with tracked sub-kicker `EARTH · CRAFT · FORM`.
- Navigation: Centered uppercase/sentence links with 18px line height, smooth clay color shift on hover.
- Action Icons: Minimalist 1.8px stroke SVG icons (Search, Wishlist, Account, Cart badge).

### 6.3 Hero Section (Asymmetrical Composition)
- Layout: 55% narrative left, 45% visual right with slight overlapping focal card.
- Left column:
  - Overline: `RECONNECT WITH EARTH` (Manrope 12px, uppercase, 3px spacing, `#8D725B`).
  - H1: `BRINGING NATURE to your HOME` (Ibarra Real Nova 64px, line-height 1.15).
  - Narrative: 2-3 sentences celebrating porous alluvial clay and toxin-free mindful living.
  - CTA Cluster: 
    - Primary Pill: `Explore Collections` (`#8D725B`, 30px border-radius, `#FFF` text, hover `#000000`).
    - Secondary Link: `Our Craft Philosophy →` (Manrope 14px with animated underline).
- Right column:
  - Hero image of handcrafted cookware / water carafes in natural morning light.
  - Subtle floating terracotta badge: `100% Bio-Active Earth · Zero Lead & Cadmium`.

### 6.4 Collection Showcase Cards
- Aspect ratio: `4:5` (vertical editorial card proportion).
- Image treatment: Soft background, high-resolution clayware on neutral pedestal.
- Content overlay/underlay: Category title in Ibarra Real Nova (24px), subtitle count, and subtle arrow interaction on hover.

### 6.5 Product Cards (Grid of 3 or 4)
- Container: Borderless or very subtle 1px sand border (`#ECE4DC`), 4px subtle radius.
- Imagery: Multi-angle preview on hover (smooth 300ms fade transition).
- Badges: Minimalist pill badges in top left (`Bio-Active`, `Low Stock`, `New Kiln Drop`).
- Quick Actions: Discrete floating wishlist heart and quick-add button.
- Metadata:
  - Category kicker (Manrope 11px uppercase).
  - Product Name (Ibarra Real Nova 18px, weight 500).
  - Pricing (₹ INR formatted, bold price with crossed-out compare price if on sale).

### 6.6 The "Designed for the Modern Soul" Quote Banner
- Full-width immersion section in deep charcoal/black (`#000000`).
- Text in luminous warm ivory (`#F8F5F2`).
- Kicker: `DESIGNED FOR THE MODERN SOUL` (13px, letter-spacing 3px, `#8D725B`).
- Blockquote: Large editorial serif (28px - 38px, font-style: normal/italic emphasis).
- Attribution: `FOUNDER, OREON LIVING` in subtle stone typography.

### 6.7 "The Zero-Toxin Standard" (Value Matrix)
- 4-column balanced grid highlighting laboratory safety and earth benefits:
  1. **100% Nutrient Retention**: Porous steam circulation seals moisture and minerals.
  2. **Lab-Certified Zero Toxins**: 0% lead, cadmium, arsenic, or chemical PTFE/PFOA coatings.
  3. **Natural Alkaline Balance**: Indigenous clay neutralizes acidic foods for digestive calm.
  4. **Wood-Fired Durability**: Kiln-fired at 900°C for exceptional thermal shock resistance.
- Iconography: Refined, delicate line icons (not generic chunky emoji/stock vectors).

### 6.8 The Soul-to-Soil Storytelling Split
- Asymmetrical 50/50 split section with rich documentary-style photo of potter's hands shaping clay.
- Narrative text detailing traditional wheel craftsmanship, natural seasoning protocols, and biophilic indoor wellness.

### 6.9 Footer Sanctuary
- Deep black canvas (`#000000`) with structured editorial columns:
  - Column 1: Brand statement, studio physical address (Gurgaon/Bengaluru), operating hours.
  - Column 2: Navigation Collections (Cookware, Planters, Carafes, Serveware, Vases).
  - Column 3: The Studio (Philosophy, Clay Care Passport, 100% Breakage Guarantee).
  - Column 4: Newsletter signup with clean dark-input pill and "Join" button.
- Bottom bar: Copyright, GST registration, payment security icons (UPI, RuPay, Visa, Mastercard), and legal links.

---

## 7. Interaction Design & Micro-Interactions

1. **Button Hover Physics**:
   - Signature pill button (`border-radius: 30px`).
   - Smooth 250ms transition from `#8D725B` to `#000000`.
   - Subtle translateY(-2px) elevation with soft shadow `rgba(141, 114, 91, 0.2)`.
2. **Card Image Hover**:
   - Secondary lifestyle image cross-fades on desktop mouseenter.
   - Scale transform: `1.03` with cubic-bezier easing (`cubic-bezier(0.25, 1, 0.5, 1)`).
3. **Interactive Clay Care & FAQ Accordion**:
   - Custom `<details>` component with smooth SVG arrow rotation and zero layout jumping.
4. **Mobile Navigation Drawer**:
   - Smooth off-canvas slide from left with 40% backdrop blur, categorized collection links, and direct WhatsApp Concierge CTA.

---

## 8. Anti-Generic-AI Design Checklist

| Generic AI Pattern (STRICTLY AVOIDED) | Oreon Living Design Solution (HUMAN DESIGNED) |
| :--- | :--- |
| Random purple/indigo gradients | Natural earth palette: terracotta clay (`#8D725B`), silt (`#FBF6F1`), obsidian (`#000000`). |
| Chunky 24px rounded card bubbles everywhere | Disciplined, architectural radius: `2px` to `6px` on cards, elegant `30px` on pill buttons. |
| Repetitive 3-column card layouts on every section | Dynamic asymmetrical rhythms: 55/45 split hero, 2-column large editorial collections, 4-column product grid, full-width dark quote banner. |
| Overused Inter / Roboto system fonts | Sophisticated literary pairing: **Ibarra Real Nova** + **Manrope**. |
| Generic floating blob illustrations | Authentic photography of earthen pottery, terracotta planters, water carafes, and artisan hands. |
| Unnecessary frosted glassmorphism | Solid, tactile surfaces with warm limestone / clay undertones. |
| Senseless animations bouncing around | Restrained, purposeful micro-transitions (150ms-250ms smooth eases). |

---

## 9. Implementation Summary & Verification

The Klayvi design system has been fully implemented across the application:

1. **Typography & Theme Tokens (`public/css/oreon.css`)**:
   - Google Fonts: `Ibarra Real Nova` (display serif) + `Manrope` (modern geometric sans).
   - Earth & Mineral color palette tokens: Raw Clay `#8D725B`, Deep Umber `#493F38`, Charcoal `#373737`, Bone/Ivory `#FBF6F1`, Obsidian Black `#000000`, Sand Borders `#ECE4DC`.
   - Signature `30px` pill buttons with smooth hover transformations.

2. **Master Layout (`resources/views/layouts/app.blade.php`)**:
   - Obsidian announcement bar (`#000000`) with clean tracking.
   - Architectural sticky navbar with `Ibarra Real Nova` brand mark and `SOIL · CRAFT · FORM` overline.
   - Deep Obsidian Black footer (`#000000`) with editorial narrative, curated collection links, and pill newsletter input.

3. **Homepage Editorial Sections (`resources/views/web/home.blade.php`)**:
   - **Asymmetric Editorial Hero**: 55/45 split with `BRINGING NATURE to your HOME`, lead text, primary 30px pill CTA, and floating `100% Bio-Active Earth` certification badge.
   - **The Earth Standard (Value Bar)**: 4-pillar trust system (Alkaline Balance, Zero Synthetic Toxins, Multi-Generational Wheels, Zero-Breakage Guarantee).
   - **Curated Collections Mosaic**: 4 vertical 4:5 tiles (Water Carafes, Botanical Planters, Clay Cookware, Tableware) with dark gradient overlay and smooth hover scale.
   - **Featured Pieces Grid**: 4:5 vertical product cards with badge labels, pricing, wishlist actions, and quick-add pills.
   - **Quote Immersion Banner**: Full-width `#000000` section with Master Potter Ramachandran K. statement.
   - **The Zero-Toxin Standard Matrix**: 4-card laboratory certification grid.
   - **Soil to Soul Heritage Split**: 50/50 storytelling layout with craftsman wheel photography.
   - **Everyday Bestsellers**: 4-column curated product showcase.
   - **Patrons' Reflections**: 3-column verified review cards with terracotta star ratings.
   - **Community Dispatch**: Minimalist newsletter dispatch box.

4. **Automated Verification**:
   - Automated Feature Test Suite `HomepageDesignTest` and `AdminSettingsTest`: 16 tests, 77 assertions passing (`php artisan test`).


