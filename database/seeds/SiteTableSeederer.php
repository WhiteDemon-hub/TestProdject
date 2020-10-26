<?php

use Illuminate\Database\Seeder;
use App\SiteModel;
class SiteTableSeederer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteModel::create([
            'titel' => 'PlansShop',
            'logo' =>   'img\triangle_PNG30.png',
            'email' => 'sword5157@gmail.com',
            'footer_text' => '<img src="http://127.0.0.1:8000/storage/img/triangle_PNG30.png" width="150px" draggable="true" class="wh-max"><span style="font-size: 14.4px; color: rgb(248, 249, 250); text-align: center; background-color: rgb(52, 58, 64);">&nbsp;© 2020 Березин Станислав,&nbsp;</span><span style="font-size: 14.4px; text-align: center; background-color: rgb(52, 58, 64);"><font color="#ff0000">Все ошибки защищены</font></span><br>',
        ]);
    }
}
