<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        for ($i = 1; $i < 150; $i++) {
            //insert to table $step->id , $i  for example 
            DB::table('companies')->insert([
                'id' => $i,
                'name' => 'company ' . $i,
                'email' => 'mail-' . $i . '@email.com',
                'logo' => 'google.png',
                'website' => 'company' . $i . '.com',
            ]);
            for ($j = 1; $j <= 10; $j++) {
                //insert to table $step->id , $i  for example
                $currentCount = ((($i - 1) * 10) + $j);
                DB::table('employees')->insert([
                    'id' => $currentCount,
                    'first_name' => 'employee ' . $currentCount,
                    'last_name' => 'employee ' . $currentCount,
                    'email' => 'mail-' . $currentCount . '@email.com',
                    'phone' => '+966' . $currentCount . '5555231',
                    'company_id' => $i,
                ]);
            }
        }
    }
}
