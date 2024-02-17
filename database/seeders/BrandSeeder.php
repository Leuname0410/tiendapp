<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $brandNames = [
            'Nike',
            'Adidas',
            'Puma',
            'Reebok',
            'Under Armour',
            'New Balance',
            'Converse',
            'Vans',
            'Fila',
            'Asics',
        ];


        foreach ($brandNames as $name) {
            Brand::create([
                'name' => $name,
            ]);
        }
    }
}
