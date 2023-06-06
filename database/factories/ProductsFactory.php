<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Products;
use App\Models\Images;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductsFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     //
        // ];
        // $product = Products::create([
        //     'productName'   => fake()->sentence(),
        //     'quantity'      => random_int(5, 20),
        //     'unit'          => random_int(1,3),
        //     'priceCode'     => uniqid(),
        //     'description'   => fake()->paragraph(),
        //     'uploadedBy'    => 1  
        // ]);

        // Images::create([
        //     'name'  => time(). uniqid(),
        //     'location'  => 'http://example.com',
        //     'products_id'   => $product->id,
        // ]);

        return [
            'productName'   => fake()->sentence(),
            'quantity'      => random_int(5, 20),
            'unit'          => random_int(1,7),
            'priceCode'     => uniqid(),
            'description'   => fake()->paragraph(),
            'uploadedBy'    => 1  
        ];
    }
}
