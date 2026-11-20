<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ContactMessage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@izzara.com'],
            [
                'name' => 'Administrator IZZARA',
                'role' => 'admin',
                'phone' => '081234567890',
                'address' => 'Kantor Pusat PT Istana Oleh-Oleh Indonesia',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Customer User
        $customer = User::updateOrCreate(
            ['email' => 'customer@izzara.com'],
            [
                'name' => 'Budi Santoso',
                'role' => 'customer',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 45, Kebayoran Baru, Jakarta Selatan',
                'password' => Hash::make('customer123'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Categories
        $categories = [
            [
                'name' => 'Makanan Ringan',
                'slug' => 'makanan-ringan',
                'description' => 'Aneka camilan gurih, manis, dan renyah seperti keripik pisang, keripik singkong, dan sale pisang.',
                'icon' => 'bi-cookie',
            ],
            [
                'name' => 'Kue Tradisional',
                'slug' => 'kue-tradisional',
                'description' => 'Kue basah dan kering khas warisan leluhur Nusantara seperti lapis legit, dodol, dan aneka kue legit.',
                'icon' => 'bi-cake2',
            ],
            [
                'name' => 'Makanan dan Minuman',
                'slug' => 'makanan-dan-minuman',
                'description' => 'Kopi lokal pilihan, aneka racikan sambal khas daerah, dan kuliner khas nusantara siap saji.',
                'icon' => 'bi-cup-hot',
            ],
            [
                'name' => 'Souvenir Daerah',
                'slug' => 'souvenir-daerah',
                'description' => 'Kerajinan tangan lokal, dompet batik, gantungan kunci khas, dan cinderamata penuh kenangan.',
                'icon' => 'bi-bag-heart',
            ],
        ];

        $categoryMap = [];
        foreach ($categories as $cat) {
            $createdCat = Category::updateOrCreate(['slug' => $cat['slug']], $cat);
            $categoryMap[$cat['name']] = $createdCat->id;
        }

        // 4. Products
        $products = [
            [
                'category_id' => $categoryMap['Makanan Ringan'],
                'name' => 'Keripik Pisang Lumrah',
                'slug' => 'keripik-pisang-lumrah',
                'product_code' => 'KRP-001',
                'price' => 15000,
                'stock' => 45,
                'weight' => 250,
                'description' => 'Keripik pisang pilihan dengan kerenyahan istimewa dan rasa gurih manis alami khas resep tradisional keluarga. Diproses secara higienis tanpa bahan pengawet kimia.',
                'image' => 'products/keripik-pisang.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryMap['Kue Tradisional'],
                'name' => 'Kue Lapis Legit Spesial',
                'slug' => 'kue-lapis-legit-spesial',
                'product_code' => 'LAP-001',
                'price' => 25000,
                'stock' => 20,
                'weight' => 500,
                'description' => 'Kue lapis legit berlapis aroma rempah dan mentega wijsman pilihan. Lembut di mulut dengan rasa manis pas yang cocok disajikan saat kumpul keluarga.',
                'image' => 'products/lapis-legit.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryMap['Makanan dan Minuman'],
                'name' => 'Kopi Bubuk Lokal Robusta',
                'slug' => 'kopi-bubuk-lokal-robusta',
                'product_code' => 'KOP-001',
                'price' => 30000,
                'stock' => 35,
                'weight' => 200,
                'description' => 'Kopi bubuk murni dari biji kopi robusta lereng pegunungan nusantara. Roasting medium-dark menghasilkan aroma harum pekat dan rasa kopi autentik.',
                'image' => 'products/kopi-lokal.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryMap['Makanan dan Minuman'],
                'name' => 'Sambal Khas Daerah',
                'slug' => 'sambal-khas-daerah',
                'product_code' => 'SMB-001',
                'price' => 20000,
                'stock' => 50,
                'weight' => 180,
                'description' => 'Sambal pedas segar diolah dari cabai pilihan dan bumbu rempah warisan nusantara. Cocok dinikmati bersama nasi hangat dan aneka lauk gorengan.',
                'image' => 'products/sambal-khas.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryMap['Makanan Ringan'],
                'name' => 'Sale Pisang Crispy',
                'slug' => 'sale-pisang-crispy',
                'product_code' => 'SAL-001',
                'price' => 18000,
                'stock' => 30,
                'weight' => 250,
                'description' => 'Sale pisang khas dengan rasa manis karamel alami yang dibalut tepung krispi renyah. Camilan favorit lintas generasi yang awet dan praktis.',
                'image' => 'products/sale-pisang.jpg',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'category_id' => $categoryMap['Makanan Ringan'],
                'name' => 'Keripik Singkong Balado',
                'slug' => 'keripik-singkong-balado',
                'product_code' => 'KRP-002',
                'price' => 16000,
                'stock' => 40,
                'weight' => 250,
                'description' => 'Keripik singkong renyah dengan baluran cabai balado pedas manis yang bikin nagih. Menggunakan singkong mentega pilihan kualitas super.',
                'image' => 'products/keripik-singkong.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryMap['Kue Tradisional'],
                'name' => 'Dodol Tradisional Asli',
                'slug' => 'dodol-tradisional-asli',
                'product_code' => 'DDL-001',
                'price' => 22000,
                'stock' => 25,
                'weight' => 350,
                'description' => 'Dodol legit khas dengan santan kelapa murni dan gula aren asli. Tekstur kenyal lembut yang cocok untuk sajian hajatan atau buah tangan kerabat.',
                'image' => 'products/dodol-garut.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryMap['Souvenir Daerah'],
                'name' => 'Dompet Batik Etnik',
                'slug' => 'dompet-batik-etnik',
                'product_code' => 'SVN-001',
                'price' => 35000,
                'stock' => 15,
                'weight' => 120,
                'description' => 'Dompet motif batik khas nusantara karya pengrajin UMKM binaan lokal. Jahitan rapi, tahan lama, dan sarat akan nilai budaya Indonesia.',
                'image' => 'products/dompet-batik.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'category_id' => $categoryMap['Souvenir Daerah'],
                'name' => 'Gantungan Kunci Kayu Ukir',
                'slug' => 'gantungan-kunci-kayu-ukir',
                'product_code' => 'SVN-002',
                'price' => 12000,
                'stock' => 60,
                'weight' => 50,
                'description' => 'Cinderamata ukiran kayu halus bernuansa ikon daerah nusantara. Sangat cocok sebagai tanda kenangan manis untuk keluarga dan teman terdekat.',
                'image' => 'products/gantungan-kunci.jpg',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        $productMap = [];
        foreach ($products as $prod) {
            $createdProd = Product::updateOrCreate(['product_code' => $prod['product_code']], $prod);
            $productMap[$prod['product_code']] = $createdProd;
        }

        // 5. Sample Orders
        $order1 = Order::updateOrCreate(
            ['order_code' => 'IZR-20261120-001'],
            [
                'user_id' => $customer->id,
                'customer_name' => 'Budi Santoso',
                'customer_phone' => '081234567890',
                'customer_email' => 'customer@izzara.com',
                'shipping_address' => 'Jl. Merdeka No. 45, Kebayoran Baru, Jakarta Selatan',
                'payment_method' => 'transfer_bca',
                'total_amount' => 55000,
                'status' => 'completed',
                'notes' => 'Tolong bungkus bubble wrap tebal ya kak.',
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $productMap['KRP-001']->id],
            [
                'quantity' => 2,
                'unit_price' => 15000,
                'subtotal' => 30000,
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order1->id, 'product_id' => $productMap['LAP-001']->id],
            [
                'quantity' => 1,
                'unit_price' => 25000,
                'subtotal' => 25000,
            ]
        );

        $order2 = Order::updateOrCreate(
            ['order_code' => 'IZR-20261120-002'],
            [
                'user_id' => null,
                'customer_name' => 'Siti Nurhaliza',
                'customer_phone' => '085712345678',
                'customer_email' => 'siti.nur@yahoo.com',
                'shipping_address' => 'Jl. Diponegoro No. 12, Bandung, Jawa Barat',
                'payment_method' => 'qris',
                'total_amount' => 50000,
                'status' => 'processing',
                'notes' => 'Pengiriman lewat kurir instan jika bisa.',
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => $productMap['KOP-001']->id],
            [
                'quantity' => 1,
                'unit_price' => 30000,
                'subtotal' => 30000,
            ]
        );
        OrderItem::updateOrCreate(
            ['order_id' => $order2->id, 'product_id' => $productMap['SMB-001']->id],
            [
                'quantity' => 1,
                'unit_price' => 20000,
                'subtotal' => 20000,
            ]
        );

        $order3 = Order::updateOrCreate(
            ['order_code' => 'IZR-20261120-003'],
            [
                'user_id' => null,
                'customer_name' => 'Ahmad Fauzi',
                'customer_phone' => '087890123456',
                'customer_email' => 'ahmad.fauzi@outlook.com',
                'shipping_address' => 'Perum Graha Asri Blok C2 No. 8, Surabaya',
                'payment_method' => 'cod',
                'total_amount' => 36000,
                'status' => 'pending',
                'notes' => 'Mohon hubungi via WA sebelum kurir mengantar.',
            ]
        );

        OrderItem::updateOrCreate(
            ['order_id' => $order3->id, 'product_id' => $productMap['SAL-001']->id],
            [
                'quantity' => 2,
                'unit_price' => 18000,
                'subtotal' => 36000,
            ]
        );

        // 6. Contact Messages
        ContactMessage::updateOrCreate(
            ['email' => 'ratna.dewi@gmail.com', 'subject' => 'Pertanyaan Pemesanan Grosir untuk Acara Kantor'],
            [
                'name' => 'Ratna Dewi',
                'phone' => '081398765432',
                'message' => 'Halo admin IZZARA, apakah ada potongan harga khusus jika memesan kue lapis legit dan kopi lokal dalam jumlah 50 paket untuk suvenir kantor? Terima kasih.',
                'is_read' => false,
            ]
        );

        ContactMessage::updateOrCreate(
            ['email' => 'hendra.kurniawan@gmail.com', 'subject' => 'Kemitraan UMKM Keripik Tempe'],
            [
                'name' => 'Hendra Kurniawan',
                'phone' => '081287654321',
                'message' => 'Selamat siang, saya produsen keripik tempe khas daerah, ingin mengajukan kerjasama suplai produk oleh-oleh di toko IZZARA. Bagaimana prosedurnya?',
                'is_read' => true,
            ]
        );
    }
}
