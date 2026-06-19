<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users (Updated with business manager & customer info)
        User::firstOrCreate(
            ['email' => 'meripurnamasari4@gmail.com'],
            [
                'name' => 'Meri Purnama Sari',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'phone' => '0822-6848-0864',
                'address' => 'Jalan Padang Laweh, No.34, Kel. Sungai Nanam, Kec. Lembah Gumanti',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@hijabpin.com'],
            [
                'name' => 'Hafizul Hanif',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'phone' => '089876543210',
                'address' => 'Jl. Anggrek No. 12, Bandung, Indonesia',
            ]
        );

        // 2. Create Categories
        $categories = [
            [
                'name' => 'Premium Pins',
                'slug' => 'premium-pins',
                'description' => 'Elegant safety pins and chain tassel pins for formal and daily wear.',
                'image_url' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Magnetic Pins',
                'slug' => 'magnetic-pins',
                'description' => 'Zero-damage strong magnetic clasps that keep your hijab secure all day.',
                'image_url' => 'https://images.unsplash.com/photo-1601121141461-9d6647bca1ed?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Brooches & Rings',
                'slug' => 'brooches-rings',
                'description' => 'Luxury crystal brooches and scarf rings to elevate your hijab styling.',
                'image_url' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'name' => 'Accessories Box',
                'slug' => 'accessories-box',
                'description' => 'Velvet boxes and organizers to store your premium pins and brooches safely.',
                'image_url' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?q=80&w=600&auto=format&fit=crop',
            ],
        ];

        $createdCategories = [];
        foreach ($categories as $cat) {
            $createdCategories[$cat['slug']] = Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Clear existing products to avoid duplicates and mismatch with images
        Product::query()->delete();

        // 3. Create Products matching actual images in public/images
        $products = [
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Biunga Daisy Pink Kristal Gold',
                'description' => 'Bros hijab cantik berbentuk bunga daisy pink dengan hiasan kristal berkilau dan aksen emas premium.',
                'price' => 20000,
                'stock' => 30,
                'image_url' => '/images/Bros Biunga Daisy Pink Kristal Gold.jpeg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Bulan Sabit Kristal Mutiara Gold',
                'description' => 'Desain bros berbentuk bulan sabit yang elegan berhiaskan mutiara anggun dan kristal mewah.',
                'price' => 20000,
                'stock' => 25,
                'image_url' => '/images/Bros Bulan Sabit Kristal Mutiara Gold .jpeg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Bunga Gold Mutiara Premium',
                'description' => 'Bros bentuk bunga bernuansa emas mewah berpadu dengan mutiara premium kualitas terbaik.',
                'price' => 20000,
                'stock' => 20,
                'image_url' => '/images/Bros Bunga Gold Mutiara Premium.jpeg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Daun Gold Mutiara Elegan',
                'description' => 'Bros dengan desain daun emas yang detail dan mutiara putih yang menambah kesan berkelas.',
                'price' => 20000,
                'stock' => 35,
                'image_url' => '/images/Bros Daun Gold Mutiara Elegan.jpeg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Daun Maple Orange Gold',
                'description' => 'Bros bermotif daun maple berwarna orange hangat yang unik dengan tepi emas berkilau.',
                'price' => 20000,
                'stock' => 15,
                'image_url' => '/images/Bros Daun Maple Orange Gold.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Daun Ranting Gold Kristal Elegan',
                'description' => 'Bros bertema ranting daun emas yang dinamis dilengkapi kristal-kristal kecil berkilau.',
                'price' => 20000,
                'stock' => 40,
                'image_url' => '/images/Bros Daun Ranting Gold Kristal Elegan.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Hijab Kristal Mini Gold',
                'description' => 'Bros hijab berukuran kecil dan simpel namun tetap anggun dengan ornamen kristal mini berwarna emas.',
                'price' => 20000,
                'stock' => 50,
                'image_url' => '/images/Bros Hijab Kristal Mini Gold.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Hijab Kupu-Kupu Kristal Gold Elegan',
                'description' => 'Bros berbentuk kupu-kupu yang detail berhias butiran kristal berkilau untuk mempercantik hijab Anda.',
                'price' => 20000,
                'stock' => 30,
                'image_url' => '/images/Bros Hijab Kupu-Kupu Kristal Gold Elegan.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Kelinci Pita Kristal Gold',
                'description' => 'Bros imut berbentuk kelinci manis menggunakan pita bertaburkan kristal berkilau yang elegan.',
                'price' => 20000,
                'stock' => 25,
                'image_url' => '/images/Bros Kelinci Pita Kristal Gold.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Lingkar Kupu Kupu Kristal Gold',
                'description' => 'Bros model lingkaran berornamen kupu-kupu emas berbalut kristal yang memberi kesan modern dan mewah.',
                'price' => 20000,
                'stock' => 20,
                'image_url' => '/images/Bros Lingkar Kupu Kupu Kristal Gold.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros Rantai Bunga Silver Double Pin Mutiara',
                'description' => 'Bros premium dengan rantai juntaian perak yang indah, dilengkapi double pin pengaman dan mutiara nan anggun.',
                'price' => 35000,
                'stock' => 15,
                'image_url' => '/images/Bros Rantai Bunga Silver Double Pin Mutiara.jpeg',
                'is_featured' => true,
            ],
            [
                'category_slug' => 'brooches-rings',
                'name' => 'Bros lingkar Pita Mutiara Kristal Gold',
                'description' => 'Bros bentuk lingkaran berpita yang glamor dengan mutiara serta kristal premium berlapis warna emas.',
                'price' => 20000,
                'stock' => 30,
                'image_url' => '/images/Bros lingkar Pita Mutiara Kristal Gold.jpeg',
                'is_featured' => false,
            ],
            [
                'category_slug' => 'premium-pins',
                'name' => 'Pin Hijab Kucing Bunga Pink Gold',
                'description' => 'Pin hijab yang lucu dengan karakter kucing memegang bunga berwarna pink pastel dan bingkai emas hangat.',
                'price' => 20000,
                'stock' => 40,
                'image_url' => '/images/Pin Hijab Kucing Bunga Pink Gold.jpeg',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $prod) {
            $catSlug = $prod['category_slug'];
            unset($prod['category_slug']);
            $prod['category_id'] = $createdCategories[$catSlug]->id;
            $prod['slug'] = Str::slug($prod['name']);
            Product::create($prod);
        }
    }
}
