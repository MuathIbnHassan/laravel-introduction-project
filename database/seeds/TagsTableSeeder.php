<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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
            DB::table('tags')->insert([
                'id' => $i,
                'tag_name' => 'tag ' . $i,
                'tag_color' => '#color' . $i . '',
            ]);
            for ($j = $i; $j < $i + 10; $j++) {
                DB::table('taggables')->insert([
                    'id' => (($i - 1) * 20) + $j,
                    'tag_id' => $i,
                    'taggable_id' => random_int($i, $j),
                    'taggable_type' => 'App\Employee'
                ]);
            }
            for ($j = $i + 10; $j < $i + 20; $j++) {
                DB::table('taggables')->insert([
                    'id' => (($i - 1) * 20) + $j,
                    'tag_id' => $i,
                    'taggable_id' => random_int($i, $j),
                    'taggable_type' => 'App\Company'
                ]);
            }
        }
    }
}
