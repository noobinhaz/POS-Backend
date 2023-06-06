<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Units;
use App\Models\Categories;

class BaseSeed extends Seeder
{
    public function unitSeed(){
        Units::create([
            'name'  => 'KG',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

        Units::create([
            'name'  => 'Piece',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

        Units::create([
            'name'  => 'Oz',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

        Units::create([
            'name'  => 'Set',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

        Units::create([
            'name'  => 'Gram',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

        Units::create([
            'name'  => 'Meter',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

        Units::create([
            'name'  => 'Bootle',
            'description'   => fake()->sentence(),
            'status'        => true
        ]);

    }

    public function categorySeed(){

        Categories::create([
            'name'  => 'Body Kits and Fairings'
        ]);

        Categories::create([
            'name'  => 'Handlebars and Controls'
        ]);

        Categories::create([
            'name'  => 'Mirrors and Indicators'
        ]);

        Categories::create([
            'name'  => 'Lights and Lighting Accessories'
        ]);

        Categories::create([
            'name'  => 'Graphics and Decals'
        ]);

        Categories::create([
            'name'  => 'Performance Upgrades'
        ]);

        Categories::create([
            'name'  => 'Body Kits and Fairings'
        ]);

        Categories::create([
            'name'  => 'Brake Upgrades and Accessories'
        ]);

        Categories::create([
            'name'  => 'Protective Gear '
        ]);

        Categories::create([
            'name'  => 'Maintenance and Care Products'
        ]);

        
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->unitSeed();
        $this->categorySeed();
    }
}
