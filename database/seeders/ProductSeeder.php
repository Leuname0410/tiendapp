<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 100; $i++) {

            $brandId = rand(1, 10);

            Product::create([

                'brand_id' => $brandId,
                'product_name' => $this->getRandomProductName(),
                'size' => $this->getRandomSize(),
                'inventory_quantity' => rand(1, 100),
                'shipment_date' => now(),
                'observations' => 'Sin observaciones',

            ]);
        }
    }

    /**
    * Get random size between 's', 'm' y 'l'
    *
    * @return string
    */
    function getRandomProductName() {

        $productNames = [

            'Zapatillas Deportivas',
            'Camiseta de algodón',
            'Pantalones Vaqueros',
            'Chaqueta de Cuero',
            'Gorra de Béisbol',
            'Bufanda de Lana',
            'Sombrero de Paja',
            'Botas de Montaña',
            'Gafas de Sol',
            'Sudadera con Capucha',
            'Calcetines de Algodón',
            'Pantalones Cortos',
            'Traje de Baño',
            'Vestido de Noche',
            'Blusa de Seda'
        ];

        $randomIndex = array_rand($productNames);

        return $productNames[$randomIndex];
    }

    /**
     * Get random size between 's', 'm' y 'l'
     *
     * @return string
     */
    private function getRandomSize()
    {
        $sizes = ['s', 'm', 'l'];
        return $sizes[array_rand($sizes)];
    }
}
