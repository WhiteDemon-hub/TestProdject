<?php

use Illuminate\Database\Seeder;
use App\PlantsModel;

class PlantsTableSeederer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PlantsModel::create([
            'name'=>'Венерина мухоловка',
            'image'=>'1.jpg',
        ]);

        PlantsModel::create([
            'name'=>'Жирянка',
            'image'=>'2.jpg',
        ]);

        PlantsModel::create([
            'name'=>'Непентес',
            'image'=>'3.jpg',
        ]);

        PlantsModel::create([
            'name'=>'Росянка',
            'image'=>'4.jpg',
        ]);

        PlantsModel::create([
            'name'=>'Саррацения',
            'image'=>'5.jpg',
        ]);
    }
}
