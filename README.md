# Oreon Living — Modern Earthen Clay E-Commerce

> **Crafted from Earth. Designed for Modern Living.**

Oreon Living is a production-ready, full-stack e-commerce web application for an upscale lifestyle brand specializing in architectural pottery, unglazed terracotta water vessels, curated planters, hand-thrown tableware, and natural earthen home objects.

---

## 1. Architectural Principles & Aesthetics

- **Minimalist & Warm**: Built upon a restrained, nature-inspired palette (Ivory, Sand, Terracotta, Clay, Charcoal) with generous editorial whitespace and balanced typography.
- **Pure Monolith**: Uses **Laravel 11**, MySQL, PHP 8.3, Blade Templates, Vanilla CSS custom properties, and Vanilla ES6 JavaScript. **No React, Vue, or heavy node frameworks.**
- **High Performance & Accessibility**: Fast server-side rendering, semantic HTML5, zero hydration lag, WCAG-compliant contrast ratios, and `prefers-reduced-motion` compliance.
- **Audit-Logged RBAC**: Role-based access control protecting administrative modules with automatic audit logs recording all staff mutations (old vs new prices and stock).

---

## 2. Key Features

### Storefront Experience
1. **Curated Homepage**: Sticky announcement banner, editorial hero showcase, category grids, featured artisan collections, craft & sustainability essays, customer testimonials, and newsletter signup.
2. **Catalog & Filtering**: Multi-criteria filters by category, price range, stock availability, and sorting (price low/high, newest, bestsellers).
3. **Product Detail Page**:
   - Interactive high-res photo gallery with thumbnail switching.
   - Variant selector (sizes, glaze finishes, terracotta tones) with dynamic price adjustment.
   - Live Indian PIN code delivery checker & COD eligibility.
   - Craft specifications (dimensions, weights, clay source, kiln firing technique, seasoning & maintenance guides).
   - Pre-filled WhatsApp direct artisan inquiry button (`https://wa.me/...`).
   - Customer review submission & display.
4. **Server-Side Cart & Dynamic Checkout**:
   - Session-based guest cart seamlessly migrated upon login.
   - Promotional coupon engine (percentage & fixed discount validation).
   - Atomic checkout transaction (`DB::transaction`) with stock locks (`lockForUpdate()`) to prevent overselling.
   - Sequential order numbering (`OL-YYYYMMDD-XXXX`).
   - Integrated Mock / NPCI-compliant UPI QR Code & VPA deep link generator (`upi://pay?pa=...`).
   - Instant downloadable GST tax invoice view with print-ready stylesheet.
5. **Customer Portal**:
   - Order history with live order status progress bar.
   - Self-service cancellation and return request workflows.
   - Multi-address book (default delivery address management).
   - Wishlist management.
6. **Information & Policy Pages**:
   - About Us / Artisan philosophy story.
   - Dynamic searchable FAQ accordion.
   - Contact form storing customer inquiries into the database.
   - Shipping policy, Returns & Refunds, Privacy Policy, Terms & Conditions.
   - Dynamic XML Sitemap (`/sitemap.xml`) and `robots.txt`.

### Administrative Suite (`/admin`)
1. **Interactive Dashboard**: KPI summaries (Total Revenue, Orders, Products, Pending Inquiries) and recent orders.
2. **Product Management**:
   - Full CRUD with multi-image gallery upload.
   - Variant management (sizes, pricing, stock per variant).
   - **Inline Quick Update**: Allows non-technical staff to update price and stock immediately without opening complex forms.
3. **Category Management**: Hierarchical categories with custom slugs, banner images, and sort orders.
4. **Order Management**: Status workflow (`pending`, `confirmed`, `processing`, `shipped`, `delivered`, `cancelled`, `refunded`), courier partner assignment, and real-time tracking URL updates.
5. **Customer Management**: Profile view, address history, and order lifetime value.
6. **Coupon Engine**: Code creation, percentage or fixed discount, minimum order threshold, and usage limits.
7. **Reviews Moderation**: Approve or reject customer reviews before they appear on storefront.
8. **Homepage Banners**: Upload and reorder seasonal promotional banners without a developer.
9. **FAQ Management**: Categorized FAQs editable by staff.
10. **Customer Support / WhatsApp Leads**: Review contact submissions and click to reply directly via pre-filled WhatsApp link or email.
11. **Granular Staff RBAC**:
    - `super_admin`: Full access to everything.
    - `content_manager`: Homepage, banners, FAQs, website copy.
    - `product_manager`: Products, inventory, pricing, categories.
    - `order_manager`: Orders, fulfillment, shipping tracking links.
    - `customer_support`: Customer accounts, inquiries, WhatsApp leads.
    - `marketing_manager`: Coupons, UTM tracking, basic reports.
    - `viewer`: Read-only access.
12. **Activity & Audit Logging**:
    - Automatically records who changed what, the exact timestamp, IP address, and JSON diffs of `old_values` vs `new_values` (e.g., old price: ₹799 &rarr; new price: ₹699).
13. **CSV Data Exports**: One-click streaming exports for Orders, Products, and Customers.

---

## 3. Technology Stack & Requirements

- **PHP**: 8.2 or 8.3 (CLI & Web) with extensions: `pdo_mysql`, `mbstring`, `openssl`, `curl`, `gd` or `exif`.
- **Database**: MySQL 8.0+ or MariaDB 10.4+.
- **Web Server**: Apache / Nginx / WAMP / Laravel Artisan Server.
- **Package Manager**: Composer 2.x.
- **Frontend**: Laravel Blade, Vanilla CSS3, Vanilla JavaScript.

---

## 4. Installation & Setup Guide

### 1. Clone & Dependencies
```bash
git clone <repository-url> "Oreon Living Laravel"
cd "Oreon Living Laravel"
composer install
```

### 2. Environment Configuration
Copy `.env.example` to `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Configure your database credentials in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=oreon_living
DB_USERNAME=root
DB_PASSWORD=root
```

### 3. Database Migration & Realistic Seeding
Run migrations and load realistic earthen clay catalogue, categories, staff accounts, coupons, FAQs, and pincodes:
```bash
php artisan migrate:fresh --seed
```

### 4. Storage Link
Ensure public access to uploaded product assets and banners:
```bash
php artisan storage:link
```

### 5. Start Development Server
```bash
php artisan serve
```
Visit the storefront at `http://127.0.0.1:8000`.

---

## 5. Seeded Accounts & Credentials

### Staff Accounts (All Password: `Password@123`)

| Role | Email | Access Scope |
| :--- | :--- | :--- |
| **Super Admin** | `admin@oreonliving.com` | Full system access, staff creation, audit logs |
| **Content Manager** | `content@oreonliving.com` | Banners, FAQs, editorial pages |
| **Product Manager** | `products@oreonliving.com` | Products, prices, stock, categories |
| **Order Manager** | `orders@oreonliving.com` | Orders, shipping status, tracking links |
| **Customer Support**| `support@oreonliving.com` | Customer inquiries, WhatsApp leads |
| **Marketing Manager**| `marketing@oreonliving.com` | Coupons, UTM campaigns, basic reports |
| **Viewer** | `viewer@oreonliving.com` | Read-only inspection |

### Customer Test Accounts (Password: `Password@123`)
- `ananya@example.com`
- `customer@example.com`

---

## 6. Sample Seeded Coupons
- `WELCOME10`: 10% off entire order.
- `EARTHEN500`: Flat ₹500 discount on orders above ₹2,000.
- `FESTIVE15`: 15% off festive clay collections (orders above ₹1,500).

---

## 7. Testing Suite

Run the automated test suite:
```bash
php artisan test
```

### Test Coverage Highlights
- `CatalogAndCartTest`: Verifies homepage, catalog filtering, product detail loading, server-side cart operations, and coupon calculations.
- `OrderCheckoutTest`: Verifies atomic transactions, sequential order number generation, and automatic inventory decrement.
- `AdminSecurityAndAuditTest`: Verifies customer access restriction to `/admin`, RBAC route guards, and audit log tracking on price/stock updates.

---

## 8. Mandatory Project Documentation
In accordance with project governance requirements, please consult:
- `decision.md`: Comprehensive log of all architectural, UI/UX, database, and security decisions.
- `flow.md`: Mermaid flowcharts detailing customer journeys, authentication, cart lifecycle, UPI checkout, inventory management, and RBAC workflows.
