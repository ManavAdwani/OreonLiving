# Project Decisions

## 1. Product & Brand Direction

### Decision
Brand name: **Oreon Living**
Tagline: *Crafted from Earth. Designed for Modern Living.*
Brand positioning: A contemporary, minimalist, premium earthen and terracotta lifestyle brand inspired by the serenity, warm tactile beauty, and timeless craft of natural clay.
The visual identity embraces warm ivory/sand surfaces, terracotta and clay accents, restrained typography, and generous editorial whitespace. It completely avoids rustic or cluttered marketplace aesthetics, positioning the company as an upscale contemporary lifestyle destination.

### Reason
Natural clay and terracotta are often presented in traditional, crowded handicraft templates that diminish perceived value. Modern consumers seeking mindful living, clean kitchenware, and architectural pottery respond to tranquil, gallery-like digital experiences with editorial product presentation, clear craft transparency, and uncompromising minimalism.

### Alternatives Considered
- *Traditional Handicraft Marketplace*: Rejected because it dilutes brand premiumness and creates visual chaos.
- *Generic High-Volume Shopify Look*: Rejected as it lacks bespoke craftsmanship, warmth, and brand distinction.

---

## 2. Technology Stack

### Decision
- **Backend Framework**: Laravel 11.x (PHP 8.3)
- **Database**: MySQL 8.x (running on WAMP port 3306)
- **Frontend Architecture**: Laravel Blade + Vanilla CSS3 Design System + Lightweight Vanilla JavaScript (ES6+).
- **Asset Pipeline**: Vite (standard in Laravel) for compiling bespoke modern CSS and Vanilla JS modules.
- **Dependencies Philosophy**: Minimal external packages. Avoid heavy frontend frameworks (no React, no Vue, no Next.js). Use native Laravel capabilities (Eloquent, Blade components, Sessions, Auth, Form Requests, Policies, Database Transactions).

### Reason
- Eliminates frontend framework overhead, hydration delays, and SPA complexity.
- Laravel Blade provides lightning-fast server-side rendering, instant SEO indexing, and seamless authentication integration.
- Vanilla CSS with CSS custom properties gives total control over micro-animations, typography, and responsive layouts without CSS bloat.

### Alternatives Considered
- *Inertia.js + Vue/React*: Considered, but the prompt strictly specifies: "Do NOT introduce React, Vue, Next.js, Node.js frameworks... Prefer Blade + HTML + CSS + vanilla JavaScript."
- *TailwindCSS*: Vanilla CSS custom properties were chosen to deliver a genuinely unique, handcrafted design system tailored strictly to the Oreon Living palette and luxury layout proportions.

---

## 3. Architecture

### Decision
- **Modular Monolith**: Organized into clean domains:
  - `App\Models`: Eloquent entities with relationships, scopes, and casts.
  - `App\Http\Controllers\Web`: Public storefront controllers (Home, Catalog, Product, Cart, Checkout, Account, Pages).
  - `App\Http\Controllers\Admin`: Protected administrative controllers for catalogue, operations, content, audit logs, and analytics.
  - `App\Services`: Dedicated service layer for business workflows:
    - `CartService`: Guest & user cart lifecycle, stock checks, pricing validation.
    - `OrderService`: Database transaction order processing, inventory decrement, invoice generation.
    - `Payment\PaymentGatewayInterface`: Extensible payment provider abstraction (implementing Mock/UPI Gateway, ready for Stripe/Razorpay).
    - `ShippingService`: Pin code serviceability, delivery cost calculations, tracking integration.
    - `AuditLogService`: Audit trail logger recording staff mutations (old vs new values).
    - `PincodeService`: Indian pincode verification, estimated delivery days, and courier partner routing.
- **Form Requests**: Strict server-side validation for every mutable action (CheckoutRequest, ProductRequest, CouponRequest, etc.).
- **Blade Component System**: Comprehensive library of atomic and composite Blade components in `resources/views/components/`.

### Reason
Keeps controllers thin, encapsulates complex order and cart math within testable services, isolates database transactions, and strictly adheres to SOLID principles.

### Alternatives Considered
- *Fat Controllers*: Rejected because cart, coupon, checkout, and inventory operations quickly create fragile, untestable code.
- *Repository Pattern for everything*: Rejected to avoid needless boilerplate. Eloquent ORM is used directly within dedicated Services.

---

## 4. Database

### Decision
A fully normalized relational schema designed for MySQL:
1. `users`: Authentication, personal info, role enum/string (`super_admin`, `content_manager`, `product_manager`, `order_manager`, `customer_support`, `marketing_manager`, `viewer`, `customer`), status, phone.
2. `categories`: Hierarchical structure (parent_id nullable for subcategories), name, slug, description, image, is_active, sort_order.
3. `products`: category_id, name, slug, sku, short_description, description, price, compare_price, cost_price, stock, low_stock_threshold, weight_grams, dimensions, material, care_instructions, status (`draft`, `published`, `archived`), is_featured, is_bestseller, seo_title, seo_description.
4. `product_images`: product_id, image_path, alt_text, sort_order, is_primary.
5. `product_variants`: product_id, title (e.g. "500ml", "1 Liter"), sku, price, stock, is_active.
6. `addresses`: user_id, type (`shipping`, `billing`), full_name, phone, address_line_1, address_line_2, landmark, city, state, postal_code, country, is_default.
7. `carts`: user_id (nullable), session_id (nullable), coupon_id (nullable), timestamps.
8. `cart_items`: cart_id, product_id, variant_id (nullable), quantity, price.
9. `orders`: user_id (nullable for guest), order_number (unique, e.g., `OL-20261018-4821`), customer_name, customer_email, customer_phone, shipping_address, billing_address, subtotal, discount_amount, shipping_fee, tax_amount, total_amount, payment_method (`upi`, `card`, `netbanking`, `cod`), payment_status (`pending`, `paid`, `failed`, `refunded`), order_status (`pending`, `confirmed`, `processing`, `shipped`, `delivered`, `cancelled`, `return_requested`, `refunded`), tracking_number, tracking_url, carrier_name, notes, utm_source, utm_medium, utm_campaign.
10. `order_items`: order_id, product_id, variant_id (nullable), product_name, sku, quantity, unit_price, total_price.
11. `wishlists`: user_id, product_id.
12. `reviews`: user_id, product_id, rating (1-5), title, comment, status (`pending`, `approved`, `rejected`).
13. `coupons`: code, discount_type (`percentage`, `fixed`), value, min_spend, max_discount, max_uses, used_count, starts_at, expires_at, is_active.
14. `contact_submissions`: name, email, phone, subject, message, status (`new`, `in_progress`, `resolved`), admin_notes.
15. `homepage_banners`: title, subtitle, button_text, button_url, image_path, mobile_image_path, sort_order, is_active.
16. `faqs`: category, question, answer, sort_order, is_active.
17. `activity_logs`: user_id, action, entity_type, entity_id, old_values (json), new_values (json), ip_address, user_agent.
18. `pincodes`: pincode, city, state, is_serviceable, estimated_days, cod_available.
19. `website_settings`: key-value store for sitewide settings (announcement bar, WhatsApp number, Meta Pixel ID, Google Analytics ID, brand contact details).

### Reason
Meets all 174 PDF items and the core prompt requirements. Supports guest checkout, subcategories, variants, audit trails, Indian pin code logistics, rich coupons, order fulfillment cycles, and multi-staff role permissions.

### Alternatives Considered
- *JSON columns for addresses/images*: We use relational `product_images` and `addresses` tables for indexing and integrity, keeping JSON only for immutable point-in-time order address snapshots and audit diffs.

---

## 5. Authentication & Authorization

### Decision
- Standard Laravel Session-based Auth with multi-role authorization.
- Two distinct guard areas:
  - Customer space: Login, Register, Forgot Password, Reset Password, Profile, Addresses, Orders.
  - Staff / Admin space: Protected by `auth` and `AdminRoleMiddleware`.
- Granular Role-Based Access Control (RBAC):
  1. **Super Admin**: Unrestricted system-wide access including staff management, backups, and settings.
  2. **Content Manager**: Homepage, banners, blog/articles, FAQs, static copy, images.
  3. **Product Manager**: Add, edit, remove products, inventory, prices, images, descriptions.
  4. **Order Manager**: View orders, update order status, input tracking numbers, process cancellations/returns.
  5. **Customer Support**: View customer profiles, order history, review WhatsApp inquiries & contact messages.
  6. **Marketing Manager**: Coupons, tracking scripts (Meta Pixel, GA), campaigns, sales analytics.
  7. **Viewer**: Read-only oversight of catalogues, orders, and reports without write capability.
- Deletion safety: Confirmation dialogs and permission guards on destructive product/category deletes.

### Reason
Matches Section 7, 22, and items 51-57 of the specification accurately. Prevents unauthorized staff mutations and guarantees customer data segregation.

---

## 6. Cart & Checkout

### Decision
- **Cart Storage**: Session cart for guest shoppers; automatically migrated to database cart upon login/registration.
- **Stock Validation**: Re-validated server-side on cart addition, quantity mutation, and final checkout submission inside an atomic DB transaction with `lockForUpdate()`.
- **Pricing Integrity**: Frontend prices are ignored; prices are always fetched fresh from the database during calculation.
- **Payment Layer**: Interface-driven payment service. Initial implementation includes a realistic **UPI Instant QR & VPA simulation** (matching Indian e-commerce standards with dynamic UPI payment links `upi://pay?pa=...&pn=OreonLiving&am=...&cu=INR`) alongside Card / Netbanking / COD options, fully decoupled from controllers to allow single-line swap for Razorpay or Stripe.
- **WhatsApp Integration**:
  - Direct product inquiry WhatsApp links with pre-filled message: `"Hello Oreon Living, I would like to inquire about the [Product Name] (SKU: [SKU])."`.
  - Post-checkout WhatsApp order confirmation generator (`"Hello Oreon Living, I have placed Order #[OrderNumber] for ₹[Total]. Please confirm my order."`).

### Reason
Provides seamless frictionless purchasing for Indian shoppers who favor UPI and WhatsApp, while maintaining bulletproof financial and inventory integrity.

---

## 7. UI/UX & Design System

### Decision
- **Color Palette**:
  - `surface-base`: `#FBF9F5` (warm ivory)
  - `surface-card`: `#FFFFFF`
  - `surface-elevated`: `#F5F0EB` (gentle sand/bone)
  - `text-main`: `#1C1917` (rich charcoal)
  - `text-muted`: `#78716C` (warm stone)
  - `clay-primary`: `#B85D3B` (burnt terracotta clay)
  - `clay-hover`: `#9E472A` (deep fired clay)
  - `accent-sand`: `#E6DFD5`
  - `accent-olive`: `#636652` (subtle botanical accent)
  - `border-subtle`: `#ECE5DC`
- **Typography**:
  - Display / Headings: `Cormorant Garamond` & `Playfair Display` (classic editorial luxury serif).
  - Body / UI / Controls: `Plus Jakarta Sans` (crisp, modern, legible geometric sans).
- **Aesthetic Principles**:
  - Generous negative space (padding, line-heights, balanced grids).
  - Tactile micro-interactions (150ms-250ms smooth transitions).
  - High-resolution editorial photography of earthen pottery, glazed terracotta, and water carafes.
  - Zero clutter, zero loud promotional banners.

---

## 8. Performance & Asset Strategy

### Decision
- Native lazy loading (`loading="lazy"`) and explicit aspect-ratio containers to prevent Cumulative Layout Shift (CLS).
- Responsive image sizing with SVG placeholders.
- Eloquent eager loading (`with(['images', 'category'])`) across all listing views to eliminate N+1 queries.
- Database indexing on `slug`, `sku`, `category_id`, `status`, `is_featured`, `is_bestseller`, `order_number`, `user_id`.
- Minified CSS/JS via Vite build.

---

## 9. Security & Compliance

### Decision
- Full CSRF token validation on all POST/PUT/DELETE forms.
- Eloquent parameterized PDO queries (100% SQL injection prevention).
- Strict HTML escaping via Blade `{{ $variable }}` (XSS prevention).
- Rate limiting on authentication routes (ThrottleRequests).
- Password hashing with Bcrypt / Argon2id.
- Audit trail logging staff actions for accountability.

---

## 10. Open Questions & Assumptions

- **Assumption 1**: WAMP MySQL runs on port 3306 with user `root` and password `root`. We will create the database `oreon_living` automatically.
- **Assumption 2**: UPI payment flow will render an authentic interactive UPI modal with QR code generation, VPA input, and copyable UPI ID, completing orders smoothly with realistic transaction references until live Razorpay keys are provided in production.
- **Assumption 3**: Products will be seeded with rich handcrafted Indian earthen clay items (Handmade Terracotta Water Pitchers, Curd Handis, Unglazed Clay Planters, Festive Clay Diyas, Stoneware Vases, Earthen Cookware) with realistic INR prices (₹499 to ₹3,499).
