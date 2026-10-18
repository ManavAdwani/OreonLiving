<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\HomepageBanner;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Pincode;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Review;
use App\Models\User;
use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Staff and Customer Users
        $password = Hash::make('Password@123');

        $superAdmin = User::create([
            'name' => 'Aditya Verma (Super Admin)',
            'email' => 'admin@oreonliving.com',
            'phone' => '+91 98765 00001',
            'role' => 'super_admin',
            'is_active' => true,
            'password' => $password,
        ]);

        $contentManager = User::create([
            'name' => 'Meera Nair (Content Manager)',
            'email' => 'content@oreonliving.com',
            'phone' => '+91 98765 00002',
            'role' => 'content_manager',
            'is_active' => true,
            'password' => $password,
        ]);

        $productManager = User::create([
            'name' => 'Rajesh Sharma (Product Manager)',
            'email' => 'products@oreonliving.com',
            'phone' => '+91 98765 00003',
            'role' => 'product_manager',
            'is_active' => true,
            'password' => $password,
        ]);

        $orderManager = User::create([
            'name' => 'Kavita Joshi (Order Manager)',
            'email' => 'orders@oreonliving.com',
            'phone' => '+91 98765 00004',
            'role' => 'order_manager',
            'is_active' => true,
            'password' => $password,
        ]);

        $customerSupport = User::create([
            'name' => 'Arun Patel (Customer Support)',
            'email' => 'support@oreonliving.com',
            'phone' => '+91 98765 00005',
            'role' => 'customer_support',
            'is_active' => true,
            'password' => $password,
        ]);

        $marketingManager = User::create([
            'name' => 'Siddharth Roy (Marketing Manager)',
            'email' => 'marketing@oreonliving.com',
            'phone' => '+91 98765 00006',
            'role' => 'marketing_manager',
            'is_active' => true,
            'password' => $password,
        ]);

        $viewer = User::create([
            'name' => 'Sneha Kulkarni (Viewer)',
            'email' => 'viewer@oreonliving.com',
            'phone' => '+91 98765 00007',
            'role' => 'viewer',
            'is_active' => true,
            'password' => $password,
        ]);

        $customer1 = User::create([
            'name' => 'Ananya Deshmukh',
            'email' => 'ananya@example.com',
            'phone' => '+91 98200 12345',
            'role' => 'customer',
            'is_active' => true,
            'password' => $password,
        ]);

        $customer2 = User::create([
            'name' => 'Vikram Malhotra',
            'email' => 'customer@example.com',
            'phone' => '+91 98111 67890',
            'role' => 'customer',
            'is_active' => true,
            'password' => $password,
        ]);

        // Customer Addresses
        Address::create([
            'user_id' => $customer1->id,
            'type' => 'shipping',
            'name' => 'Ananya Deshmukh',
            'phone' => '+91 98200 12345',
            'address_line_1' => 'Flat 402, Lotus Grandeur',
            'address_line_2' => '14th Cross, Indiranagar',
            'landmark' => 'Near Defence Colony Play Ground',
            'city' => 'Bengaluru',
            'state' => 'Karnataka',
            'postal_code' => '560038',
            'country' => 'India',
            'is_default' => true,
        ]);

        Address::create([
            'user_id' => $customer2->id,
            'type' => 'shipping',
            'name' => 'Vikram Malhotra',
            'phone' => '+91 98111 67890',
            'address_line_1' => 'B-12, Green Park Main',
            'address_line_2' => 'Second Floor',
            'landmark' => 'Opposite Green Park Market',
            'city' => 'New Delhi',
            'state' => 'Delhi',
            'postal_code' => '110016',
            'country' => 'India',
            'is_default' => true,
        ]);

        // 2. Categories
        $categoriesData = [
            [
                'name' => 'Water Pots & Carafes',
                'slug' => 'water-pots-and-carafes',
                'description' => 'Wheel-thrown porous terracotta carafes that naturally cool and mineralize drinking water.',
                'image' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 1,
            ],
            [
                'name' => 'Botanical Planters',
                'slug' => 'botanical-planters',
                'description' => 'Breathable unglazed earthen planters engineered for healthy root aeration and moisture balance.',
                'image' => 'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 2,
            ],
            [
                'name' => 'Earthen Cookware',
                'slug' => 'earthen-cookware',
                'description' => 'Non-toxic, alkaline clay handis and cooking vessels that preserve nutrients and infuse subtle aroma.',
                'image' => 'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 3,
            ],
            [
                'name' => 'Serveware & Tableware',
                'slug' => 'serveware-and-tableware',
                'description' => 'Artisanal clay platters, salad bowls, and curd setting bowls finished with natural wood ash glaze.',
                'image' => 'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 4,
            ],
            [
                'name' => 'Sculptural Vases',
                'slug' => 'sculptural-vases',
                'description' => 'Architectural silhouettes and textured earthen vessels designed as serene interior centerpieces.',
                'image' => 'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 5,
            ],
            [
                'name' => 'Ritual Diyas & Lamps',
                'slug' => 'ritual-diyas-and-lamps',
                'description' => 'Pure unglazed red clay oil lamps handcrafted for slow, steady glow and meditative warmth.',
                'image' => 'https://images.unsplash.com/photo-1605371924599-2d0365da1ae0?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 6,
            ],
            [
                'name' => 'Tea & Drinkware',
                'slug' => 'tea-and-drinkware',
                'description' => 'Hand-formed kulhads, earthen mugs, and chai tumblers that honor the rich fragrance of first rain.',
                'image' => 'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 7,
            ],
            [
                'name' => 'Artisan Limited Editions',
                'slug' => 'artisan-limited-editions',
                'description' => 'Individually numbered master potter creations wood-fired in traditional village kilns.',
                'image' => 'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=800&q=80',
                'sort_order' => 8,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::create($cat);
        }

        // 3. Products Data
        $productsData = [
            [
                'category_slug' => 'water-pots-and-carafes',
                'name' => 'Soham Earthen Water Carafe with Cork Lid',
                'slug' => 'soham-earthen-water-carafe-cork-lid',
                'sku' => 'OL-WTR-001',
                'short_description' => 'A sculptural water vessel handcrafted on slow potter wheels from micro-porous natural clay.',
                'description' => "Crafted from mineral-rich alluvial clay along the Narmada river basin, the Soham Carafe cools water through natural micro-evaporation. Unlike metallic or plastic carafes, natural terracotta gently balances the pH of your drinking water, leaving every sip crisp, refreshing, and subtly sweet.\n\nEach piece is hand-burnished using river stones before firing, producing a soft, tactile silk finish without synthetic lacquers.",
                'price' => 1499.00,
                'compare_price' => 1899.00,
                'cost_price' => 520.00,
                'stock' => 28,
                'low_stock_threshold' => 5,
                'weight_grams' => 1250,
                'dimensions' => '14cm Diameter × 24cm Height',
                'material' => '100% Lead-Free Porous Terracotta Clay, Natural Portuguese Cork',
                'care_instructions' => 'Rinse with warm water and a soft coir brush before first use. Do not use synthetic dishwashing detergents. Air dry completely before storage.',
                'featured' => true,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85',
                ],
                'variants' => [
                    ['title' => 'Standard - 1.2 Liters', 'sku' => 'OL-WTR-001-1L', 'price' => 1499.00, 'stock' => 18],
                    ['title' => 'Family - 2.0 Liters', 'sku' => 'OL-WTR-001-2L', 'price' => 1999.00, 'stock' => 10],
                ]
            ],
            [
                'category_slug' => 'water-pots-and-carafes',
                'name' => 'Prana Terracotta Water Dispenser with Brass Tap',
                'slug' => 'prana-terracotta-water-dispenser-brass-tap',
                'sku' => 'OL-WTR-002',
                'short_description' => 'A 6-litre countertop earthen water reservoir featuring a solid forged brass dispensing spigot.',
                'description' => "Bringing centuries of Indian vernacular wisdom to the contemporary kitchen, the Prana Dispenser holds 6 litres of water, maintaining an ideal 18°C temperature even during midsummer afternoons. Fitted with a food-grade solid brass tap for effortless daily pouring.",
                'price' => 3299.00,
                'compare_price' => 3999.00,
                'cost_price' => 1200.00,
                'stock' => 14,
                'low_stock_threshold' => 4,
                'weight_grams' => 3800,
                'dimensions' => '22cm Diameter × 34cm Height',
                'material' => 'Natural Red Clay, Forged Brass Spigot with Silicone Washers',
                'care_instructions' => 'Clean weekly with baking soda and warm water. Soak overnight in clean water once a month to rejuvenate pore breathing.',
                'featured' => true,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85',
                ],
                'variants' => [
                    ['title' => '5 Litres', 'sku' => 'OL-WTR-002-5L', 'price' => 3299.00, 'stock' => 8],
                    ['title' => '8 Litres', 'sku' => 'OL-WTR-002-8L', 'price' => 3999.00, 'stock' => 6],
                ]
            ],
            [
                'category_slug' => 'botanical-planters',
                'name' => 'Aura Fluted Terracotta Pedestal Planter',
                'slug' => 'aura-fluted-terracotta-pedestal-planter',
                'sku' => 'OL-PLT-001',
                'short_description' => 'Architectural fluted column planter that lets plant roots breathe naturally through unglazed earthen walls.',
                'description' => "Hand-carved with gentle vertical flutes, the Aura Planter elevates indoor foliage into living sculpture. Terracotta's porous matrix wicks away excess moisture, shielding delicate roots against rot while providing natural soil thermal insulation.",
                'price' => 1299.00,
                'compare_price' => 1599.00,
                'cost_price' => 420.00,
                'stock' => 22,
                'low_stock_threshold' => 5,
                'weight_grams' => 1600,
                'dimensions' => '18cm Top Diameter × 20cm Height',
                'material' => 'High-fired Porous Terracotta with Drainage Hole & Matching Saucer',
                'care_instructions' => 'Wipe exterior with a dry cloth. White mineral patina forming naturally over time enhances its vintage aesthetic.',
                'featured' => true,
                'bestseller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85',
                ],
                'variants' => [
                    ['title' => 'Medium (7 inch)', 'sku' => 'OL-PLT-001-M', 'price' => 1299.00, 'stock' => 14],
                    ['title' => 'Large (9 inch)', 'sku' => 'OL-PLT-001-L', 'price' => 1799.00, 'stock' => 8],
                ]
            ],
            [
                'category_slug' => 'botanical-planters',
                'name' => 'Komorebi Wide Low Earthen Bowl Planter',
                'slug' => 'komorebi-wide-low-earthen-bowl-planter',
                'sku' => 'OL-PLT-002',
                'short_description' => 'A shallow, grounding bowl planter ideal for succulent arrangements, bonsai, or water lilies.',
                'description' => "Inspired by Japanese wabi-sabi aesthetics, the Komorebi bowl is wide and centered. Hand-thrown with coarse sand tempered clay to resist cracking, it serves as a serene focal point for entryway consoles or dining tables.",
                'price' => 1699.00,
                'compare_price' => 2199.00,
                'cost_price' => 580.00,
                'stock' => 16,
                'low_stock_threshold' => 4,
                'weight_grams' => 2200,
                'dimensions' => '28cm Diameter × 12cm Height',
                'material' => 'Sand-tempered Red Clay with Matte Earth Finish',
                'care_instructions' => 'Suitable for indoor and protected outdoor spaces. Frost resistant.',
                'featured' => false,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'earthen-cookware',
                'name' => 'Amrit Traditional Clay Curd Handi with Lid',
                'slug' => 'amrit-traditional-clay-curd-handi-with-lid',
                'sku' => 'OL-CKW-001',
                'short_description' => 'The authentic porous clay pot that sets the thickest, creamiest naturally sweet yogurt.',
                'description' => "Clay pots absorb surplus whey through capillary action, concentrating milk solids to yield incomparably dense, velvety curd. The Amrit Handi comes pre-cured with organic rice starch water and pure mustard oil, ready for your kitchen rituals.",
                'price' => 799.00,
                'compare_price' => 999.00,
                'cost_price' => 260.00,
                'stock' => 35,
                'low_stock_threshold' => 6,
                'weight_grams' => 950,
                'dimensions' => '16cm Diameter × 13cm Height',
                'material' => 'Pure Unglazed Natural Alluvial Clay',
                'care_instructions' => 'Season with warm rice water before first setting. Wash gently with warm water; never use chemical detergents.',
                'featured' => true,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85',
                ],
                'variants' => [
                    ['title' => '750 ml', 'sku' => 'OL-CKW-001-750', 'price' => 799.00, 'stock' => 20],
                    ['title' => '1.5 Liters', 'sku' => 'OL-CKW-001-15L', 'price' => 1199.00, 'stock' => 15],
                ]
            ],
            [
                'category_slug' => 'earthen-cookware',
                'name' => 'Veda Slow-Cooking Clay Biryani Pot with Steamer Lid',
                'slug' => 'veda-slow-cooking-clay-biryani-pot-steamer-lid',
                'sku' => 'OL-CKW-002',
                'short_description' => 'Heavy-walled deep clay vessel engineered for low flame dum cooking and aromatic curries.',
                'description' => "The thermal inertia of heavy earthen clay seals in natural moisture and essential volatile oils, breaking down spices smoothly while using 50% less cooking oil. Certified completely free of lead, arsenic, and cadmium.",
                'price' => 2199.00,
                'compare_price' => 2699.00,
                'cost_price' => 750.00,
                'stock' => 19,
                'low_stock_threshold' => 4,
                'weight_grams' => 2600,
                'dimensions' => '24cm Diameter × 18cm Height',
                'material' => 'Heat-Tolerant Micaceous Red Clay',
                'care_instructions' => 'Use on low to medium gas stove flame or oven. Always allow vessel to cool naturally before washing.',
                'featured' => false,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'serveware-and-tableware',
                'name' => 'Maitri Terracotta Serving Platter & Dip Bowl Set',
                'slug' => 'maitri-terracotta-serving-platter-dip-bowl-set',
                'sku' => 'OL-SRV-001',
                'short_description' => 'Hand-pressed oblong serving platter paired with an earthen ramekin for artisanal canapés and breads.',
                'description' => "Celebrate mindful hosting with the Maitri Platter. Crafted with a soft chamfered lip and hand-burnished base, it brings the tactile warmth of the kiln to table gatherings, keeping grilled bites naturally warm for longer.",
                'price' => 1599.00,
                'compare_price' => 1999.00,
                'cost_price' => 510.00,
                'stock' => 17,
                'low_stock_threshold' => 5,
                'weight_grams' => 1400,
                'dimensions' => '32cm Length × 18cm Width × 3cm Height',
                'material' => 'Stoneware Clay blend with Organic Beeswax Polish',
                'care_instructions' => 'Hand wash with mild organic liquid soap and towel dry.',
                'featured' => true,
                'bestseller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'serveware-and-tableware',
                'name' => 'Samata Shallow Pasta & Grain Bowls (Set of 2)',
                'slug' => 'samata-shallow-pasta-grain-bowls-set-of-2',
                'sku' => 'OL-SRV-002',
                'short_description' => 'Earthy wide-lip pasta bowls featuring a natural cream-slip interior glaze and raw terracotta rim.',
                'description' => "A tranquil balance between glazed ease and raw earthen texture. The satin interior slip glaze prevents oil staining while the unglazed outer walls celebrate the natural terracotta grain.",
                'price' => 1899.00,
                'compare_price' => 2299.00,
                'cost_price' => 620.00,
                'stock' => 24,
                'low_stock_threshold' => 5,
                'weight_grams' => 1500,
                'dimensions' => '21cm Diameter × 5.5cm Depth each',
                'material' => 'Food-grade Glazed Ceramic Clay / Terracotta Exterior',
                'care_instructions' => 'Microwave and dishwasher safe on gentle cycle.',
                'featured' => false,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'sculptural-vases',
                'name' => 'Kala Minimalist Loop Handle Earthen Vase',
                'slug' => 'kala-minimalist-loop-handle-earthen-vase',
                'sku' => 'OL-VAS-001',
                'short_description' => 'A sculptural amphora re-imagined with a bold continuous circular loop handle in raw sand tone.',
                'description' => "Designed for minimalist interiors, dry pampas, or wild olive branches. The Kala Vase marries ancient Greek and Indus Valley pottery forms into a single tranquil modern silhouette.",
                'price' => 2499.00,
                'compare_price' => 2999.00,
                'cost_price' => 820.00,
                'stock' => 12,
                'low_stock_threshold' => 3,
                'weight_grams' => 1800,
                'dimensions' => '16cm Width × 28cm Height',
                'material' => 'Coarse Grain Terracotta with Sand Wash Finish',
                'care_instructions' => 'Designed primarily for dry floral arrangements. Use a glass insert if holding fresh water.',
                'featured' => true,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'sculptural-vases',
                'name' => 'Dhara Textured Moon Flask Vessel',
                'slug' => 'dhara-textured-moon-flask-vessel',
                'sku' => 'OL-VAS-002',
                'short_description' => 'Disc-shaped moon flask crafted with intentional fingertip pottery ridges and an earthen matte patina.',
                'description' => "Holding space with quiet confidence, Dhara captures the calm serenity of the full moon. Each piece carries the maker's distinct thumb indentations, celebrating the human rhythm behind each piece.",
                'price' => 2299.00,
                'compare_price' => 2799.00,
                'cost_price' => 740.00,
                'stock' => 15,
                'low_stock_threshold' => 4,
                'weight_grams' => 1750,
                'dimensions' => '22cm Width × 8cm Depth × 25cm Height',
                'material' => 'Stoneware & Red Terracotta Clay blend',
                'care_instructions' => 'Dust lightly with a soft brush.',
                'featured' => false,
                'bestseller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'ritual-diyas-and-lamps',
                'name' => 'Anant Handcrafted Terracotta Akhand Diya with Glass Chimney',
                'slug' => 'anant-handcrafted-terracotta-akhand-diya-glass-chimney',
                'sku' => 'OL-DIA-001',
                'short_description' => 'An enduring deep oil reservoir diya shielded by heat-resistant borosilicate glass for tranquil flame rituals.',
                'description' => "Hand-shaped from pure terracotta, the Anant Diya holds enough sesame or mustard oil to burn steadily for over 18 hours. The removable glass hurricane prevents drafts while amplifying the serene warm glow across living spaces.",
                'price' => 999.00,
                'compare_price' => 1299.00,
                'cost_price' => 310.00,
                'stock' => 40,
                'low_stock_threshold' => 8,
                'weight_grams' => 850,
                'dimensions' => '12cm Diameter × 18cm Height',
                'material' => 'Natural Red Clay, Borosilicate Glass Chimney, Brass Wick Holder',
                'care_instructions' => 'Wipe glass with cotton cloth. Wash clay base gently with warm water after flame is fully extinguished.',
                'featured' => true,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1605371924599-2d0365da1ae0?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'ritual-diyas-and-lamps',
                'name' => 'Surya Petal Terracotta Festive Diyas (Box of 8)',
                'slug' => 'surya-petal-terracotta-festive-diyas-box-of-8',
                'sku' => 'OL-DIA-002',
                'short_description' => 'Set of 8 petal-shaped earthen oil lamps presented in a sustainable handmade paper gift box.',
                'description' => "Crafted by women potters in rural Gujarat using indigenous red clay. Each diya is kiln-baked under slow wood fires, providing a deep rustic hue that enhances festive evenings, Diwali celebrations, or sunset rituals.",
                'price' => 499.00,
                'compare_price' => 649.00,
                'cost_price' => 140.00,
                'stock' => 65,
                'low_stock_threshold' => 10,
                'weight_grams' => 600,
                'dimensions' => '7.5cm Diameter × 3cm Height each',
                'material' => '100% Biodegradable Pure Clay',
                'care_instructions' => 'Soak in water for 15 minutes prior to first lighting to reduce oil absorption.',
                'featured' => false,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1605371924599-2d0365da1ae0?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'tea-and-drinkware',
                'name' => 'Mitti Hand-Thrown Chai Kulhad Tumblers (Set of 4)',
                'slug' => 'mitti-hand-thrown-chai-kulhad-tumblers-set-of-4',
                'sku' => 'OL-TEA-001',
                'short_description' => 'Reusable thick-rim earthen tea cups that infuse masala chai with the unforgettable scent of petrichor.',
                'description' => "Reimagining the timeless railway kulhad for everyday modern living. Fired at higher temperatures for daily durability while maintaining the signature earthen sweetness that elevates morning tea.",
                'price' => 699.00,
                'compare_price' => 899.00,
                'cost_price' => 210.00,
                'stock' => 45,
                'low_stock_threshold' => 8,
                'weight_grams' => 900,
                'dimensions' => '7cm Diameter × 8.5cm Height (180ml each)',
                'material' => 'Food-safe High-Fired Terracotta Clay',
                'care_instructions' => 'Hand wash with warm water and air dry thoroughly.',
                'featured' => true,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'tea-and-drinkware',
                'name' => 'Oasis Terracotta Pour-Over Coffee Dripper Set',
                'slug' => 'oasis-terracotta-pour-over-coffee-dripper-set',
                'sku' => 'OL-TEA-002',
                'short_description' => 'Cone dripper and matching pitcher that delivers velvety, low-acidity filter brews with optimal thermal stability.',
                'description' => "Slow down your morning brew. The Oasis Dripper harnesses clay's natural heat retention to sustain a steady extraction temperature, ensuring consistent, bloom-forward coffee every dawn.",
                'price' => 1799.00,
                'compare_price' => 2299.00,
                'cost_price' => 590.00,
                'stock' => 18,
                'low_stock_threshold' => 4,
                'weight_grams' => 1100,
                'dimensions' => 'Dripper: 11cm Diameter; Server: 500ml Capacity',
                'material' => 'Dense Earthen Stoneware with Food-Grade Clear Glaze Interior',
                'care_instructions' => 'Compatible with standard V60 #02 paper filters.',
                'featured' => false,
                'bestseller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'artisan-limited-editions',
                'name' => 'Nirvana Monolithic Wood-Fired Vessel No. 04',
                'slug' => 'nirvana-monolithic-wood-fired-vessel-no-04',
                'sku' => 'OL-LTD-001',
                'short_description' => 'A singular, hand-coiled collector vessel fired for 72 hours in an open anagama kiln.',
                'description' => "Signed and numbered by Master Potter Ramachandran in Kutch. The accidental wood ash deposits and flame currents create an iridescent bronze-black surface that cannot ever be replicated. An authentic masterwork of Indian ceramic sculpture.",
                'price' => 5499.00,
                'compare_price' => 6499.00,
                'cost_price' => 2200.00,
                'stock' => 4,
                'low_stock_threshold' => 2,
                'weight_grams' => 4200,
                'dimensions' => '26cm Width × 38cm Height',
                'material' => 'Wild Foraged Clay, Wood Ash Deposits, Naturally Reduced Iron Oxide',
                'care_instructions' => 'Collector piece. Display on solid surface away from vibration. Wipe with clean microfibre cloth.',
                'featured' => true,
                'bestseller' => false,
                'images' => [
                    'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&w=1000&q=85',
                    'https://images.unsplash.com/photo-1581783342308-f792dbdd27c5?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
            [
                'category_slug' => 'botanical-planters',
                'name' => 'Zenith Hanging Terracotta Planter with Jute Cord',
                'slug' => 'zenith-hanging-terracotta-planter-jute-cord',
                'sku' => 'OL-PLT-003',
                'short_description' => 'Suspended earthenware bowl with hand-twisted natural jute rope for trailing vines and pothos.',
                'description' => "Float greenery at eye level. The Zenith Planter features three reinforced rope grommets and an internal drainage reservoir that keeps roots aerated while protecting ceilings and hardwood floors from dripping.",
                'price' => 999.00,
                'compare_price' => 1299.00,
                'cost_price' => 310.00,
                'stock' => 25,
                'low_stock_threshold' => 5,
                'weight_grams' => 1100,
                'dimensions' => '16cm Diameter × 10cm Bowl Depth; 75cm Cord Length',
                'material' => 'Terracotta Clay with Natural Golden Jute Cord',
                'care_instructions' => 'Avoid prolonged direct exposure to torrential outdoor rain to preserve jute fibers.',
                'featured' => false,
                'bestseller' => true,
                'images' => [
                    'https://images.unsplash.com/photo-1485955900006-10f4d324d411?auto=format&fit=crop&w=1000&q=85',
                ],
            ],
        ];

        $createdProducts = [];
        foreach ($productsData as $pData) {
            $cat = $categories[$pData['category_slug']];
            $product = Product::create([
                'category_id' => $cat->id,
                'name' => $pData['name'],
                'slug' => $pData['slug'],
                'sku' => $pData['sku'],
                'short_description' => $pData['short_description'],
                'description' => $pData['description'],
                'price' => $pData['price'],
                'compare_price' => $pData['compare_price'],
                'cost_price' => $pData['cost_price'],
                'stock' => $pData['stock'],
                'low_stock_threshold' => $pData['low_stock_threshold'],
                'weight_grams' => $pData['weight_grams'],
                'dimensions' => $pData['dimensions'],
                'material' => $pData['material'],
                'care_instructions' => $pData['care_instructions'],
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'status' => 'published',
                'featured' => $pData['featured'],
                'bestseller' => $pData['bestseller'],
                'seo_title' => $pData['name'] . ' | Oreon Living',
                'seo_description' => $pData['short_description'],
            ]);

            // Add images
            foreach ($pData['images'] as $index => $imgUrl) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imgUrl,
                    'alt_text' => $product->name . ' - Photo ' . ($index + 1),
                    'sort_order' => $index,
                    'is_primary' => $index === 0,
                ]);
            }

            // Add variants if any
            if (!empty($pData['variants'])) {
                foreach ($pData['variants'] as $var) {
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'title' => $var['title'],
                        'sku' => $var['sku'],
                        'price' => $var['price'],
                        'stock' => $var['stock'],
                        'is_active' => true,
                    ]);
                }
            }

            $createdProducts[] = $product;
        }

        // 4. Sample Reviews
        $reviewsData = [
            [
                'customer_name' => 'Pooja Iyer',
                'rating' => 5,
                'title' => 'Water has never tasted this sweet and refreshing',
                'body' => 'I replaced our stainless steel carafe with the Soham Earthen Carafe three months ago. The subtle cooling is remarkable without being teeth-chilling like refrigerator water. The cork lid also keeps dust away cleanly.',
            ],
            [
                'customer_name' => 'Dr. K. S. Sundaram',
                'rating' => 5,
                'title' => 'Sets yogurt just like my grandmother used to make',
                'body' => 'The Amrit Curd Handi is a revelation. In Bangalore weather it sets firm, Greek-yogurt consistency curd in barely 6 hours with zero sourness. Excellent packaging as well—arrived without a single scratch.',
            ],
            [
                'customer_name' => 'Sunaina Kapoor',
                'rating' => 5,
                'title' => 'True wabi-sabi centerpiece in my living room',
                'body' => 'The Kala vase is a work of sculptural art. The tactile matte terracotta texture feels soothing to touch. It commands attention on our entryway credenza.',
            ],
            [
                'customer_name' => 'Rohan Mehta',
                'rating' => 4,
                'title' => 'Great quality, prompt delivery to Mumbai',
                'body' => 'Ordered the kulhads and planter set. Extremely robust packaging with eco-friendly corrugated wrap. Water dispensers tap works smoothly with zero leakage.',
            ],
        ];

        foreach ($createdProducts as $idx => $prod) {
            $rev = $reviewsData[$idx % count($reviewsData)];
            Review::create([
                'user_id' => $customer1->id,
                'product_id' => $prod->id,
                'customer_name' => $rev['customer_name'],
                'rating' => $rev['rating'],
                'title' => $rev['title'],
                'body' => $rev['body'],
                'status' => 'approved',
            ]);
        }

        // 5. Coupons
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percentage',
            'value' => 10.00,
            'minimum_order' => 999.00,
            'max_discount' => 500.00,
            'max_uses' => 1000,
            'used_count' => 38,
            'starts_at' => now()->subMonth(),
            'expires_at' => now()->addYear(),
            'status' => true,
        ]);

        Coupon::create([
            'code' => 'EARTHEN500',
            'type' => 'fixed',
            'value' => 500.00,
            'minimum_order' => 2499.00,
            'max_discount' => 500.00,
            'max_uses' => 250,
            'used_count' => 14,
            'starts_at' => now()->subMonth(),
            'expires_at' => now()->addYear(),
            'status' => true,
        ]);

        Coupon::create([
            'code' => 'FESTIVE15',
            'type' => 'percentage',
            'value' => 15.00,
            'minimum_order' => 1499.00,
            'max_discount' => 750.00,
            'max_uses' => 500,
            'used_count' => 52,
            'starts_at' => now()->subDays(10),
            'expires_at' => now()->addMonths(6),
            'status' => true,
        ]);

        // 6. Sample Orders
        $order1 = Order::create([
            'order_number' => 'OL-' . now()->format('Ymd') . '-4821',
            'user_id' => $customer1->id,
            'customer_name' => 'Ananya Deshmukh',
            'customer_email' => 'ananya@example.com',
            'customer_phone' => '+91 98200 12345',
            'shipping_address' => [
                'name' => 'Ananya Deshmukh',
                'phone' => '+91 98200 12345',
                'address_line_1' => 'Flat 402, Lotus Grandeur, 14th Cross',
                'address_line_2' => 'Indiranagar',
                'city' => 'Bengaluru',
                'state' => 'Karnataka',
                'postal_code' => '560038',
                'country' => 'India',
            ],
            'subtotal' => 2298.00,
            'discount' => 229.80,
            'coupon_code' => 'WELCOME10',
            'shipping_fee' => 0.00,
            'tax' => 103.41,
            'total' => 2171.61,
            'payment_method' => 'upi',
            'payment_status' => 'paid',
            'order_status' => 'shipped',
            'tracking_number' => 'DELHIVERY892182910',
            'carrier_name' => 'Delhivery Express',
            'tracking_url' => 'https://www.delhivery.com/track/package/DELHIVERY892182910',
            'notes' => 'Please leave at reception security if door is locked.',
            'utm_source' => 'instagram',
            'utm_medium' => 'social_post',
            'utm_campaign' => 'spring_clay',
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $createdProducts[0]->id,
            'product_name' => $createdProducts[0]->name,
            'sku' => $createdProducts[0]->sku,
            'quantity' => 1,
            'price' => 1499.00,
            'total' => 1499.00,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'product_id' => $createdProducts[4]->id,
            'product_name' => $createdProducts[4]->name,
            'sku' => $createdProducts[4]->sku,
            'quantity' => 1,
            'price' => 799.00,
            'total' => 799.00,
        ]);

        $order2 = Order::create([
            'order_number' => 'OL-' . now()->format('Ymd') . '-5902',
            'user_id' => $customer2->id,
            'customer_name' => 'Vikram Malhotra',
            'customer_email' => 'customer@example.com',
            'customer_phone' => '+91 98111 67890',
            'shipping_address' => [
                'name' => 'Vikram Malhotra',
                'phone' => '+91 98111 67890',
                'address_line_1' => 'B-12, Green Park Main, Second Floor',
                'city' => 'New Delhi',
                'state' => 'Delhi',
                'postal_code' => '110016',
                'country' => 'India',
            ],
            'subtotal' => 3299.00,
            'discount' => 500.00,
            'coupon_code' => 'EARTHEN500',
            'shipping_fee' => 0.00,
            'tax' => 139.95,
            'total' => 2938.95,
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
            'utm_source' => 'google',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'terracotta_search',
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'product_id' => $createdProducts[1]->id,
            'product_name' => $createdProducts[1]->name,
            'sku' => $createdProducts[1]->sku,
            'quantity' => 1,
            'price' => 3299.00,
            'total' => 3299.00,
        ]);

        // 7. Indian Pincodes
        $pincodes = [
            ['pincode' => '110001', 'city' => 'New Delhi', 'state' => 'Delhi', 'estimated_days' => 2],
            ['pincode' => '110016', 'city' => 'New Delhi', 'state' => 'Delhi', 'estimated_days' => 2],
            ['pincode' => '400001', 'city' => 'Mumbai', 'state' => 'Maharashtra', 'estimated_days' => 3],
            ['pincode' => '400050', 'city' => 'Mumbai', 'state' => 'Maharashtra', 'estimated_days' => 3],
            ['pincode' => '560001', 'city' => 'Bengaluru', 'state' => 'Karnataka', 'estimated_days' => 3],
            ['pincode' => '560038', 'city' => 'Bengaluru', 'state' => 'Karnataka', 'estimated_days' => 3],
            ['pincode' => '600001', 'city' => 'Chennai', 'state' => 'Tamil Nadu', 'estimated_days' => 4],
            ['pincode' => '700001', 'city' => 'Kolkata', 'state' => 'West Bengal', 'estimated_days' => 4],
            ['pincode' => '500001', 'city' => 'Hyderabad', 'state' => 'Telangana', 'estimated_days' => 3],
            ['pincode' => '380001', 'city' => 'Ahmedabad', 'state' => 'Gujarat', 'estimated_days' => 3],
            ['pincode' => '302001', 'city' => 'Jaipur', 'state' => 'Rajasthan', 'estimated_days' => 3],
            ['pincode' => '411001', 'city' => 'Pune', 'state' => 'Maharashtra', 'estimated_days' => 3],
            ['pincode' => '201301', 'city' => 'Noida', 'state' => 'Uttar Pradesh', 'estimated_days' => 2],
            ['pincode' => '122001', 'city' => 'Gurugram', 'state' => 'Haryana', 'estimated_days' => 2],
        ];

        foreach ($pincodes as $pin) {
            Pincode::create(array_merge($pin, [
                'is_serviceable' => true,
                'cod_available' => true,
                'shipping_charge' => 0.00,
            ]));
        }

        // 8. Homepage Banners
        HomepageBanner::create([
            'title' => 'Crafted from Earth. Made for Living.',
            'subtitle' => 'Porous terracotta carafes, sculptural planters, and kitchen handis designed to infuse calm into everyday rituals.',
            'badge_text' => 'New Autumn Collection 2026',
            'button_text' => 'Discover the Collection',
            'button_url' => '/shop',
            'image_path' => 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=1800&q=85',
            'sort_order' => 1,
            'status' => true,
        ]);

        HomepageBanner::create([
            'title' => 'Naturally Cool. Mineral Rich.',
            'subtitle' => 'Hand-burnished alluvial clay water carafes that lower temperature by up to 5°C without electricity.',
            'badge_text' => 'Timeless Hydration',
            'button_text' => 'Explore Water Pots',
            'button_url' => '/shop/water-pots-and-carafes',
            'image_path' => 'https://images.unsplash.com/photo-1590736969955-71cc94801759?auto=format&fit=crop&w=1800&q=85',
            'sort_order' => 2,
            'status' => true,
        ]);

        // 9. FAQs
        $faqs = [
            [
                'category' => 'Care & Seasoning',
                'question' => 'How do I season my clay pot before first use?',
                'answer' => 'Submerge the earthenware in clean water for 8 to 12 hours. Allow it to air dry naturally, then gently rub pure mustard or coconut oil over the surface. For cookware, boil starch water (cooked rice water) on low flame once before your first recipe.',
                'sort_order' => 1,
            ],
            [
                'category' => 'Care & Seasoning',
                'question' => 'Can I use synthetic dish soap to clean terracotta?',
                'answer' => 'Never use chemical detergents or dish soaps on unglazed porous clay, as the microscopic pores will absorb soapy fragrance. Use warm water, lemon rind, and baking soda or a soft coir scrub.',
                'sort_order' => 2,
            ],
            [
                'category' => 'Shipping & Packaging',
                'question' => 'What if my clay products arrive broken during transit?',
                'answer' => 'We provide a 100% Free Replacement Breakage Guarantee. Every order is encased in triple-ply custom corrugated cushioning. In the rare event of transit damage, simply share an unboxing photo within 48 hours on WhatsApp and a fresh piece will be dispatched immediately.',
                'sort_order' => 3,
            ],
            [
                'category' => 'Materials & Safety',
                'question' => 'Are your clay products certified lead-free?',
                'answer' => 'Yes. All our clays are mined from clean alluvial river beds and laboratory tested to ensure zero lead, zero arsenic, and zero toxic heavy metals. 100% food safe and alkaline.',
                'sort_order' => 4,
            ],
            [
                'category' => 'Orders & Payment',
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept all instant UPI apps (Google Pay, PhonePe, Paytm, BHIM), Credit/Debit cards, Netbanking, and Cash on Delivery across eligible Indian pin codes.',
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }

        // 10. Website Settings
        $settings = [
            'site_name' => 'Oreon Living',
            'site_tagline' => 'Crafted from Earth. Designed for Modern Living.',
            'announcement_bar_text' => 'Complimentary pan-India delivery on orders above ₹1,999 • 100% Breakage-Free Guarantee',
            'announcement_bar_link' => '/shop',
            'announcement_bar_enabled' => '1',
            'whatsapp_number' => '919876543210',
            'support_email' => 'concierge@oreonliving.com',
            'support_phone' => '+91 98765 43210',
            'address' => 'Oreon Living Studio, 42 Pottery Lane, Heritage Crafts District, Bengaluru 560001, Karnataka',
            'meta_pixel_id' => '123456789012345',
            'google_analytics_id' => 'G-OREON12345',
            'instagram_url' => 'https://instagram.com/oreonliving',
            'facebook_url' => 'https://facebook.com/oreonliving',
            'free_shipping_threshold' => '1999',
            'standard_shipping_fee' => '149',
        ];

        foreach ($settings as $key => $val) {
            WebsiteSetting::set($key, $val);
        }
    }
}
