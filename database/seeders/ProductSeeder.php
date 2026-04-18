<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'RAM DDR4 8GB Kingston',
                'details' => 'Memory RAM DDR4 8GB 2666MHz untuk upgrade performa laptop dan komputer Anda. Compatible dengan berbagai motherboard modern.',
                'price' => 450000,
                'image_01' => 'DDR48KING.png',
            ],
            [
                'name' => 'SSD 256GB WD Blue',
                'details' => 'Solid State Drive 256GB dengan kecepatan baca hingga 560MB/s. Sempurna untuk meningkatkan kecepatan loading sistem operasi dan aplikasi.',
                'price' => 550000,
                'image_01' => 'SSD256WDBLUE.png',
            ],
            [
                'name' => 'Processor Intel Core i5 Gen 10',
                'details' => 'Processor Intel Core i5 generasi ke-10 dengan 6 cores dan 12 threads. Cocok untuk gaming dan produktivitas.',
                'price' => 2500000,
                'image_01' => 'COREI5GEN10.jpg',
            ],
            [
                'name' => 'Motherboard ASUS Prime B460M',
                'details' => 'Motherboard Micro ATX dengan chipset B460 support untuk processor Intel Gen 10 dan Gen 11.',
                'price' => 1200000,
                'image_01' => 'MBASUSB460M.png',
            ],
            [
                'name' => 'VGA Card GTX 1650 4GB',
                'details' => 'Graphics Card NVIDIA GTX 1650 4GB GDDR6 untuk gaming 1080p dengan performa optimal.',
                'price' => 2800000,
                'image_01' => 'gtx16504gb.png',
            ],
            [
                'name' => 'Keyboard Mechanical RGB',
                'details' => 'Keyboard mechanical dengan lampu RGB full color, switch blue yang nyaman untuk gaming dan mengetik.',
                'price' => 650000,
                'image_01' => 'keyboardmechanical.jpg'
            ],
            [
                'name' => 'Mouse Gaming Logitech G102',
                'details' => 'Mouse gaming dengan sensor optical 8000 DPI, 6 programmable buttons, dan RGB lighting.',
                'price' => 250000,
                'image_01' => 'mouselogitech.jpg'
            ],
            [
                'name' => 'Monitor LED 24 inch Full HD',
                'details' => 'Monitor LED 24 inch resolusi 1920x1080 Full HD dengan refresh rate 75Hz, cocok untuk gaming dan multimedia.',
                'price' => 1500000,
                'image_01' => 'monitorled.png'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}