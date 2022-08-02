<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'name'=>'USB Cord',
                'price'=> 300,
                'icon'=> null,
                'qty'=> 40,
            ],
            [
                'name'=>'Screen Guard',
                'price'=> 800,
                'icon'=> null,
                'qty'=> 60,
            ],
            [
                'name'=>'Amazone Charger',
                'price'=> 2000,
                'icon'=> null,
                'qty'=> 15,
            ],
            [
                'name'=>'Smart Phone Case',
                'price'=> 600,
                'icon'=> null,
                'qty'=> 10,
            ],

        ];
        foreach ($product as $key => $value) {
            $already_exist = Product::where("name", $value['name'])->first();
            if($already_exist == null){
                $product = new Product();
                $product->name = $value['name'];
                $product->price = $value['price'];
                $product->icon = $value['icon'];
                $product->qty = $value['qty'];
                $product->save();
            }
        }
    }
}
