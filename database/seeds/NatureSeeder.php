<?php

use Illuminate\Database\Seeder;
use App\Nature;

class NatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Nature::truncate();
        Nature::create(['name'=>'construction']);
        Nature::create(['name'=>'rehabilitation']);
        Nature::create(['name'=>'amenagement']);
        Nature::create(['name'=>'etancheite']);
        Nature::create(['name'=>'logements d\'astreinte']);

    }
}
