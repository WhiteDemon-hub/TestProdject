<?php

use Illuminate\Database\Seeder;
use App\SliderModel;

class SliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SliderModel::create(
        [
            'image' => '1.jpg',
            'name' => 'Titel_one',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis consequatur, ab quaerat vitae, aliquid at hic quis itaque, deleniti similique obcaecati nihil! Voluptate ad reiciendis hic soluta, non totam placeat?',
        ]);

        SliderModel::create(
        [
            'image' => '2.jpg',
            'name' => 'Titel_two',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis consequatur, ab quaerat vitae, aliquid at hic quis itaque, deleniti similique obcaecati nihil! Voluptate ad reiciendis hic soluta, non totam placeat?',
        ]);

        SliderModel::create(
        [
            'image' => '3.jpg',
            'name' => 'Titel_three',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis consequatur, ab quaerat vitae, aliquid at hic quis itaque, deleniti similique obcaecati nihil! Voluptate ad reiciendis hic soluta, non totam placeat?',
        ]);

        SliderModel::create(
        [
            'image' => '4.jpg',
            'name' => 'Titel_four',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis consequatur, ab quaerat vitae, aliquid at hic quis itaque, deleniti similique obcaecati nihil! Voluptate ad reiciendis hic soluta, non totam placeat?',
        ]);
    }
}
