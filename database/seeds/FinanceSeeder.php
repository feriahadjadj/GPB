<?php

use Illuminate\Database\Seeder;
use App\Finance;
class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Finance::truncate();
        Finance::create(['name'=>'SUP']);
        Finance::create(['name'=>'FP']);
        Finance::create(['name'=>'BE']);
        Finance::create(['name'=>'HP']);
        Finance::create(['name'=>'FP-08']);
        Finance::create(['name'=>'FP-09']);
        Finance::create(['name'=>'FP-10']);
        Finance::create(['name'=>'FP-11']);
        Finance::create(['name'=>'FP-12']);
        Finance::create(['name'=>'FP-13']);
        Finance::create(['name'=>'FP-14']);
        Finance::create(['name'=>'FP-15']);
        Finance::create(['name'=>'FP-16']);
        Finance::create(['name'=>'FP-17']);
        Finance::create(['name'=>'FP-18']);
        Finance::create(['name'=>'FP-19']);
        Finance::create(['name'=>'FP-20']);
        Finance::create(['name'=>'FP-21']);
        Finance::create(['name'=>'BE-05']);
        Finance::create(['name'=>'BE-06']);
        Finance::create(['name'=>'BE-07']);
        Finance::create(['name'=>'BE-08']);
        Finance::create(['name'=>'BE-09']);
        Finance::create(['name'=>'BE-10']);
        Finance::create(['name'=>'BE-11']);
        Finance::create(['name'=>'BE-12']);
        Finance::create(['name'=>'BE-13']);
        Finance::create(['name'=>'BE-14']);
        Finance::create(['name'=>'BE-15']);
        Finance::create(['name'=>'BE-16']);
        Finance::create(['name'=>'BE-17']);
        Finance::create(['name'=>'BE-18']);
        Finance::create(['name'=>'BE-19']);
        Finance::create(['name'=>'BE-20']);
        Finance::create(['name'=>'BE-21']);


        //
    }
}
