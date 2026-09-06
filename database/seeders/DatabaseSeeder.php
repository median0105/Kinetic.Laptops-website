<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Users
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Categories
        $categories = [
            ['name' => 'Laptop Gaming', 'slug' => 'laptop-gaming', 'description' => 'Laptop untuk gaming berperforma tinggi dengan GPU dedicated.'],
            ['name' => 'Laptop Ultrabook', 'slug' => 'laptop-ultrabook', 'description' => 'Laptop tipis dan ringan untuk produktivitas.'],
            ['name' => 'Laptop Bisnis', 'slug' => 'laptop-bisnis', 'description' => 'Laptop hand profesional dengan fitur keamanan.'],
            ['name' => 'Laptop Pemula', 'slug' => 'laptop-pemula', 'description' => 'Laptop terjangkau untuk belajar dan kebutuhan ringan.'],
            ['name' => 'Laptop Kreator', 'slug' => 'laptop-kreator', 'description' => 'Laptop untuk desain, editing video, dan konten kreator.'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris', 'description' => 'Aksesoris laptop seperti mouse, keyboard, tas, dll.'],
        ];

        foreach ($categories as $cat) {
            Category::create(array_merge($cat, ['is_active' => true]));
        }

        // Products
        $gaming = Category::where('slug', 'laptop-gaming')->first();
        $ultra = Category::where('slug', 'laptop-ultrabook')->first();
        $bisnis = Category::where('slug', 'laptop-bisnis')->first();
        $pemula = Category::where('slug', 'laptop-pemula')->first();
        $kreator = Category::where('slug', 'laptop-kreator')->first();
        $aksesoris = Category::where('slug', 'aksesoris')->first();

        $products = [
            [
                'category_id' => $gaming->id,
                'name' => 'ASUS ROG Strix G16',
                'description' => 'Laptop gaming dengan performa maksimal untuk gamer hardcore.',
                'price' => 18999000,
                'stock' => 8,
                'is_featured' => true,
                'spec' => ['brand' => 'ASUS', 'processor' => 'Intel Core i7-13650HX', 'ram' => '16 GB DDR5', 'storage' => '512 GB NVMe SSD', 'gpu' => 'NVIDIA RTX 4060 8GB', 'display' => '16" IPS 165Hz', 'operating_system' => 'Windows 11 Home', 'weight' => '2.5 kg'],
            ],
            [
                'category_id' => $gaming->id,
                'name' => 'Lenovo Legion Pro 5',
                'description' => 'Laptop gaming performa tinggi dengan pendinginan canggih.',
                'price' => 21500000,
                'stock' => 5,
                'is_featured' => true,
                'spec' => ['brand' => 'Lenovo', 'processor' => 'Intel Core i9-13900HX', 'ram' => '32 GB DDR5', 'storage' => '1 TB NVMe SSD', 'gpu' => 'NVIDIA RTX 4070 8GB', 'display' => '16" IPS 240Hz', 'operating_system' => 'Windows 11 Home', 'weight' => '2.6 kg'],
            ],
            [
                'category_id' => $gaming->id,
                'name' => 'MSI Katana 15',
                'description' => 'Laptop gaming entry-level dengan harga terjangkau.',
                'price' => 12999000,
                'stock' => 12,
                'is_featured' => false,
                'spec' => ['brand' => 'MSI', 'processor' => 'Intel Core i5-13420H', 'ram' => '8 GB DDR4', 'storage' => '512 GB NVMe SSD', 'gpu' => 'NVIDIA RTX 4050 6GB', 'display' => '15.6" IPS 144Hz', 'operating_system' => 'Windows 11 Home', 'weight' => '2.3 kg'],
            ],
            [
                'category_id' => $ultra->id,
                'name' => 'MacBook Air M3',
                'description' => 'Ultrabook Apple paling ringan dengan chip M3 yang powerful.',
                'price' => 16999000,
                'stock' => 15,
                'is_featured' => true,
                'spec' => ['brand' => 'Apple', 'processor' => 'Apple M3 8-core', 'ram' => '8 GB Unified', 'storage' => '256 GB SSD', 'gpu' => 'Integrated GPU', 'display' => '13.6" Liquid Retina', 'operating_system' => 'macOS Sonoma', 'weight' => '1.24 kg'],
            ],
            [
                'category_id' => $ultra->id,
                'name' => 'ASUS Zenbook 14 OLED',
                'description' => 'Ultrabook premium dengan layar OLED dan performa cepat.',
                'price' => 14500000,
                'stock' => 10,
                'is_featured' => false,
                'spec' => ['brand' => 'ASUS', 'processor' => 'Intel Core Ultra 7 155H', 'ram' => '16 GB LPDDR5', 'storage' => '512 GB NVMe SSD', 'gpu' => 'Intel Arc Graphics', 'display' => '14" OLED 2.8K', 'operating_system' => 'Windows 11 Home', 'weight' => '1.28 kg'],
            ],
            [
                'category_id' => $ultra->id,
                'name' => 'Dell XPS 13 Plus',
                'description' => 'Ultrabook elegan dengan desain minimalis dan performa tinggi.',
                'price' => 17500000,
                'stock' => 7,
                'is_featured' => false,
                'spec' => ['brand' => 'Dell', 'processor' => 'Intel Core i7-1360P', 'ram' => '16 GB LPDDR5', 'storage' => '512 GB NVMe SSD', 'gpu' => 'Intel Iris Xe', 'display' => '13.4" FHD+ OLED', 'operating_system' => 'Windows 11 Home', 'weight' => '1.23 kg'],
            ],
            [
                'category_id' => $bisnis->id,
                'name' => 'Lenovo ThinkPad X1 Carbon',
                'description' => 'Laptop bisnis legendaris dengan keyboard terbaik di kelasnya.',
                'price' => 19999000,
                'stock' => 6,
                'is_featured' => true,
                'spec' => ['brand' => 'Lenovo', 'processor' => 'Intel Core i7-1365U', 'ram' => '16 GB LPDDR5', 'storage' => '512 GB NVMe SSD', 'gpu' => 'Intel Iris Xe', 'display' => '14" IPS 2.8K', 'operating_system' => 'Windows 11 Pro', 'weight' => '1.12 kg'],
            ],
            [
                'category_id' => $bisnis->id,
                'name' => 'HP EliteBook 840 G10',
                'description' => 'Laptop enterprise dengan fitur keamanan lengkap.',
                'price' => 16500000,
                'stock' => 9,
                'is_featured' => false,
                'spec' => ['brand' => 'HP', 'processor' => 'Intel Core i7-1355U', 'ram' => '16 GB DDR5', 'storage' => '512 GB NVMe SSD', 'gpu' => 'Intel Iris Xe', 'display' => '14" IPS FHD', 'operating_system' => 'Windows 11 Pro', 'weight' => '1.36 kg'],
            ],
            [
                'category_id' => $pemula->id,
                'name' => 'Acer Aspire 5',
                'description' => 'Laptop terjangkau untuk pelajar dan mahasiswa.',
                'price' => 5999000,
                'stock' => 20,
                'is_featured' => false,
                'spec' => ['brand' => 'Acer', 'processor' => 'AMD Ryzen 5 7520U', 'ram' => '8 GB DDR4', 'storage' => '512 GB NVMe SSD', 'gpu' => 'AMD Radeon Graphics', 'display' => '15.6" IPS FHD', 'operating_system' => 'Windows 11 Home', 'weight' => '1.78 kg'],
            ],
            [
                'category_id' => $pemula->id,
                'name' => 'Lenovo IdeaPad Slim 3',
                'description' => 'Laptop entry-level dengan harga paling terjangkau.',
                'price' => 4999000,
                'stock' => 25,
                'is_featured' => false,
                'spec' => ['brand' => 'Lenovo', 'processor' => 'AMD Ryzen 3 7320U', 'ram' => '4 GB DDR4', 'storage' => '256 GB NVMe SSD', 'gpu' => 'AMD Radeon Graphics', 'display' => '14" HD', 'operating_system' => 'Windows 11 Home', 'weight' => '1.63 kg'],
            ],
            [
                'category_id' => $pemula->id,
                'name' => 'ASUS Vivobook 14',
                'description' => 'Laptop serbaguna untuk belajar dan kerja ringan.',
                'price' => 6499000,
                'stock' => 18,
                'is_featured' => false,
                'spec' => ['brand' => 'ASUS', 'processor' => 'Intel Core i3-1315U', 'ram' => '8 GB DDR4', 'storage' => '512 GB NVMe SSD', 'gpu' => 'Intel UHD Graphics', 'display' => '14" IPS FHD', 'operating_system' => 'Windows 11 Home', 'weight' => '1.50 kg'],
            ],
            [
                'category_id' => $kreator->id,
                'name' => 'MacBook Pro 14 M3 Pro',
                'description' => 'Laptop terbaik untuk video editing dan desain grafis.',
                'price' => 28999000,
                'stock' => 4,
                'is_featured' => true,
                'spec' => ['brand' => 'Apple', 'processor' => 'Apple M3 Pro 11-core', 'ram' => '18 GB Unified', 'storage' => '512 GB SSD', 'gpu' => 'Integrated GPU 14-core', 'display' => '14.2" Liquid Retina XDR', 'operating_system' => 'macOS Sonoma', 'weight' => '1.55 kg'],
            ],
            [
                'category_id' => $kreator->id,
                'name' => 'ASUS ProArt Studiobook 16',
                'description' => 'Laptop workstation untuk profesional kreatif.',
                'price' => 25000000,
                'stock' => 3,
                'is_featured' => false,
                'spec' => ['brand' => 'ASUS', 'processor' => 'Intel Core i9-13980HX', 'ram' => '32 GB DDR5', 'storage' => '1 TB NVMe SSD', 'gpu' => 'NVIDIA RTX 4060 8GB', 'display' => '16" OLED 3.2K', 'operating_system' => 'Windows 11 Pro', 'weight' => '2.4 kg'],
            ],
            [
                'category_id' => $aksesoris->id,
                'name' => 'Logitech MX Master 3S',
                'description' => 'Mouse wireless premium untuk produktivitas.',
                'price' => 1299000,
                'stock' => 30,
                'is_featured' => false,
                'spec' => ['brand' => 'Logitech', 'processor' => null, 'ram' => null, 'storage' => null, 'gpu' => null, 'display' => null, 'operating_system' => null, 'weight' => '141 gram'],
            ],
            [
                'category_id' => $aksesoris->id,
                'name' => 'Targus CityGear 15.6"',
                'description' => 'Tas laptop premium dengan perlindungan ekstra.',
                'price' => 549000,
                'stock' => 40,
                'is_featured' => false,
                'spec' => ['brand' => 'Targus', 'processor' => null, 'ram' => null, 'storage' => null, 'gpu' => null, 'display' => null, 'operating_system' => null, 'weight' => '0.8 kg'],
            ],
            [
                'category_id' => $aksesoris->id,
                'name' => 'Keychron K3 V2',
                'description' => 'Keyboard mekanik wireless tipis untuk semua OS.',
                'price' => 899000,
                'stock' => 20,
                'is_featured' => false,
                'spec' => ['brand' => 'Keychron', 'processor' => null, 'ram' => null, 'storage' => null, 'gpu' => null, 'display' => null, 'operating_system' => null, 'weight' => '0.48 kg'],
            ],
        ];

        $imageMap = [
            'ASUS ROG Strix G16' => 'images/products/asus-rog-strix-g16.png',
            'Lenovo Legion Pro 5' => 'images/products/lenovo-legion-pro-5.webp',
            'MSI Katana 15' => 'images/products/msi-katana-15.jpg',
            'MacBook Air M3' => 'images/products/macbook-air-m3.jpg',
            'ASUS Zenbook 14 OLED' => 'images/products/asus-zenbook-14-oled.jpg',
            'Dell XPS 13 Plus' => 'images/products/dell-xps-13-plus.jpg',
            'Lenovo ThinkPad X1 Carbon' => 'images/products/lenovo-thinkpad-x1-carbon.webp',
            'HP EliteBook 840 G10' => 'images/products/hp-elitebook-840-g10.png',
            'Acer Aspire 5' => 'images/products/acer-aspire-5.webp',
            'Lenovo IdeaPad Slim 3' => 'images/products/lenovo-ideapad-slim-3.webp',
            'ASUS Vivobook 14' => 'images/products/asus-vivobook-14.webp',
            'MacBook Pro 14 M3 Pro' => 'images/products/macbook-pro-14-m3-pro.jpg',
            'ASUS ProArt Studiobook 16' => 'images/products/asus-proart-studiobook-16.jpg',
            'Logitech MX Master 3S' => 'images/products/logitech-mx-master-3s.webp',
            'Targus CityGear 15.6"' => 'images/products/targus-citygear-156.webp',
            'Keychron K3 V2' => 'images/products/keychron-k3-v2.webp',
        ];

        foreach ($products as $i => $p) {
            $thumbnail = $imageMap[$p['name']] ?? null;

            $product = Product::create([
                'category_id' => $p['category_id'],
                'name' => $p['name'],
                'slug' => Str::slug($p['name']).'-'.strtolower(Str::random(5)),
                'sku' => 'SKU-'.str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'description' => $p['description'],
                'price' => $p['price'],
                'stock' => $p['stock'],
                'thumbnail' => $thumbnail,
                'is_active' => true,
                'is_featured' => $p['is_featured'],
            ]);

            if ($thumbnail) {
                $product->images()->create([
                    'path' => $thumbnail,
                    'is_primary' => true,
                    'sort_order' => 0,
                ]);
            }

            if ($p['spec']) {
                $product->specification()->create($p['spec']);
            }
        }
    }
}
