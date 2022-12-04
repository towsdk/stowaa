<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::create([
            'name'=> 'S',
            'slug'=> 's',
        ]);

        Size::create([
            'name'=> 'M',
            'slug'=> 'm',
        ]);

        Size::create([
            'name'=> 'L',
            'slug'=> 'l',
        ]);
        
        Size::create([
            'name'=> 'XL',
            'slug'=> 'xl',
        ]);
        Size::create([
            'name'=> 'XXL',
            'slug'=> 'xxl',
        ]);
    }
}
