<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\SocialMedia;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['site_main_logo', Null],
            ['site_footer_logo', Null],
            ['site_information', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Accusantium delectus voluptates nobis iste voluptatem illum hic,'],
            ['site_map', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14128.043850126332!2d85.311589!3d27.7169478!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x90398cc153754317!2sParadise%20InfoTech!5e0!3m2!1sen!2snp!4v1672208763582!5m2!1sen!2snp'],
            ['site_contact', '+977-9800000000'],
            ['site_email', 'info@leideu.com'],
            ['site_location', 'Chakkubakku Park, New Baneshwor, Kathmandu,Nepal'],
            ['site_location_url', 'https://leideu.com/'],
            ['site_copyright', 'Copyright 2022 all rights reserved leideu'],
            ['fav_icon', null],
            ['about_page_description', 'We’re truely dedicated to make your travel experience as much simple and fun as possible!'],


            ['homepage_seo_title', 'Leideu'],
            ['homepage_seo_description', 'Leideu'],
            ['homepage_seo_keywords', 'Leideu'],

            ['top_notification_banner', null],
            ['top_notification', 'Lorem ipsum dolor sit amet.'],

            ['about_page_banner', null],
            ['team_page_banner', null],
            ['blog_page_banner', null],
            ['single_page_banner', null],
            ['package_page_banner', null],
            ['feature_banner', null],

            ['contact_section_description', 'We love to hear from you. Our friendly team is always here to chat'],
            ['contact_seo_title', 'leideu-Contact'],
            ['contact_seo_keywords', 'leideu'],
            ['contact_seo_description', 'leideu leideu'],


            ['products_seo_title', 'leideu - products'],
            ['products_seo_keywords', 'products'],
            ['products_seo_description', 'products leideu'],

            ['categories_seo_title', 'leideu - categories'],
            ['categories_seo_keywords', 'categories'],
            ['categories_seo_description', 'categories leideu'],

            ['blogs_seo_title', 'leideu - blogs'],
            ['blogs_seo_keywords', 'blogs'],
            ['blogs_seo_description', 'blogs leideu'],

            ['shipping_charge', 100],
            ['delivery_time', '2 - 4 days(s)'],
            ['delivery_location', 'Bagmati, Kathmandu Metro 22 - Newroad Area, Newroad'],

            ['header_script', null],
            ['footer_script', null],
        ];

        if (count($items)) {
            foreach ($items as $item) {
                \App\Models\Setting::create([
                    'key' => $item[0],
                    'value' => $item[1],
                ]);
            }
        }

        User::create([
            'first_name' => 'Super Admin',
            'last_name' => '',
            'email' => 'admin@leideu.com',
            'password' => 'password',
            'user_type' => 'Administrator'
        ]);

        User::factory(15)->create();
        $pages = [
            ['title' => 'Privacy Policy', 'description' => 'Lorem ipsum dolor sit amet consectetur. Enim nulla at ultrices mus porttitor. Cursus sed eu neque fringilla sed maecenas lorem vulputate tristique. Mollis massa nulla vulputate eget imperdiet nc fringilla fermentum hendrerit sagittis praesent nulla nulla. Erat nascetur ut tortor nam faucibus amet tincidunt luctus nibh. Elementum massa parturient pellentesque egestas potenti et. Diam vulputate convallis sed purus eros ac amet erat risus. Lectus quisque elementum a velit urna nulla. Sit augue vestibulum gravida ante duis vitae. Rhoncus donec mi sed metus sed cursus sed. Cursus molestie vel nisi cursus amet. A viverra magnis mattis ultrices diam dapibus. Quam amet purus lacus vitae sapien viverra sit sapien. Aenean tincidunt orci diam at amet commodo eget.', 'short_description' => null, 'slug' => 'privacy-policy', 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')],
            ['title' => 'Terms and Conditions', 'description' => 'Lorem ipsum dolor sit amet consectetur. Enim nulla at ultrices mus porttitor. Cursus sed eu neque fringilla sed maecenas lorem vulputate tristique. Mollis massa nulla vulputate eget imperdiet nc fringilla fermentum hendrerit sagittis praesent nulla nulla. Erat nascetur ut tortor nam faucibus amet tincidunt luctus nibh. Elementum massa parturient pellentesque egestas potenti et. Diam vulputate convallis sed purus eros ac amet erat risus. Lectus quisque elementum a velit urna nulla. Sit augue vestibulum gravida ante duis vitae. Rhoncus donec mi sed metus sed cursus sed. Cursus molestie vel nisi cursus amet. A viverra magnis mattis ultrices diam dapibus. Quam amet purus lacus vitae sapien viverra sit sapien. Aenean tincidunt orci diam at amet commodo eget.', 'short_description' => null, 'slug' => 'terms-and-conditions', 'created_at' => date('Y-m-d h:i:s'), 'updated_at' => date('Y-m-d h:i:s')],
        ];

        Page::insert($pages);


        $socialmedias = [
            ['title' => 'Facebook', 'link' => '#',   'icon' => 'fa-facebook', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Twitter', 'link' => '#',    'icon' => 'fa-twitter', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Instagram', 'link' => '#',  'icon' => 'fa-instagram', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Linkedin', 'link' => '#',  'icon' => 'fa-linkedin', 'created_at' => now(), 'updated_at' => now()],
        ];

        SocialMedia::insert($socialmedias);

        $products = [
            ['name' => 'Electric Hot Water Bag With Fur Hand Pocket Fur Hand Pocket', 'status' => '1', 'slug' => 'electric-hot-water-bag-with-fur-hand-pocket-fur-hand-pocket', 'description' => 'abcdef',   'price' => 9000, 'mrp' => 10000, 'discount' => 10, 'rating' => '3', 'featured_image' => 'product1.png', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple iPhone 11', 'status' => '1', 'slug' => 'apple-iPhone-11', 'description' => 'abcdef',    'price' => 48000,  'mrp' => 60000, 'discount' => 20, 'rating' => '4', 'featured_image' => 'product2.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple iPhone 13 Plus', 'status' => '1', 'slug' => 'apple-iPhone-13-Plus', 'description' => 'abcdef',  'price' => 50000, 'mrp' => 100000, 'discount' => 50, 'rating' => '4', 'featured_image' => 'iphone_13.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lava Benco V80', 'status' => '1', 'slug' => 'lava-Benco-v80', 'description' => 'abcdef',  'price' => 40000,  'mrp' => 40000, 'discount' => NULL, 'rating' => '5', 'featured_image' => 'product4.png', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nokia G21 A04e', 'status' => '1', 'slug' => 'nokia-g21-a04e', 'description' => 'abcdef',  'price' => 13499,  'mrp' => 13499, 'discount' => NULL, 'rating' => '2', 'featured_image' => 'product5.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Poco M3 Pro', 'status' => '1', 'slug' => 'poco-m3-pro', 'description' => 'abcdef',  'price' => 12500,  'mrp' => 25000, 'discount' => 50, 'rating' => '4', 'featured_image' => 'product6.jpg', 'created_at' => now(), 'updated_at' => now()],
        ];

        Product::insert($products);

        $categories = [
            ['name' => 'Daily Needs', 'status' => '1', 'slug' => 'daily-needs', 'description' => 'abcdef',   'parent_id' => 0, 'is_featured' => 1, 'order' => 1, 'image' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mens Fashion', 'status' => '1', 'slug' => 'mens-fashion', 'description' => 'abcdef',    'parent_id' => 0,  'is_featured' => 1,  'order' => 2, 'image' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kids', 'status' => '1', 'slug' => 'kids', 'description' => 'abcdef',  'parent_id' => 0, 'is_featured' => 1,  'order' => 3, 'image' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Womens Fashion', 'status' => '1', 'slug' => 'womens-fashion', 'description' => 'abcdef',  'parent_id' => 0,  'is_featured' => 1, 'order' => 4, 'image' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Electronics', 'status' => '1', 'slug' => 'electronics', 'description' => 'abcdef',  'parent_id' => 0,  'is_featured' => 1,  'order' => 5, 'image' => NULL, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lifestyle', 'status' => '1', 'slug' => 'lifestyle', 'description' => 'abcdef',  'parent_id' => 0,  'is_featured' => 1,  'order' => 6, 'image' => NULL, 'created_at' => now(), 'updated_at' => now()],
        ];

        Category::insert($categories);
    }
}
