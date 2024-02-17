<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $productNames = [

            'Zapatillas Deportivas',
            'Camiseta de algodón',
            'Pantalones Vaqueros',
            'Chaqueta de Cuero',

        ];

        for ($i = 0; $i < 4; $i++) {
            $brandId = rand(1, 10);

            Product::create([

                'brand_id' => $brandId,
                'product_name' => $productNames[$i],
                'size' => $this->getRandomSize(),
                'inventory_quantity' => rand(1, 100),
                'shipment_date' => now(),
                'observations' => 'Sin observaciones',

            ]);
        }
    }

    /**
     * Obtener tamaño aleatorio entre 's', 'm' y 'l'
     *
     * @return string
     */
    private function getRandomSize()
    {
        $sizes = ['s', 'm', 'l'];
        return $sizes[array_rand($sizes)];
    }
}
