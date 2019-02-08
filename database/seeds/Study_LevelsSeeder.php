<?php

use Illuminate\Database\Seeder;
use App\StudyLevel;

class Study_LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('study_levels')->insert([
          'name' => 'class 4',
          'description' => 'SD',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 5',
          'description' => 'SD',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 6',
          'description' => 'SD',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 7',
          'description' => 'SMP',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 8',
          'description' => 'SMP',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 9',
          'description' => 'SMP',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 10',
          'description' => 'SMA',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 10',
          'description' => 'SMA IPA',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 10',
          'description' => 'SMA IPS',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 11',
          'description' => 'SMA',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 11',
          'description' => 'SMA IPA',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 11',
          'description' => 'SMA IPS',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 12',
          'description' => 'SMA',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 12',
          'description' => 'SMA IPA',
          'created_at' => now(),
          ]);
      DB::table('study_levels')->insert([
          'name' => 'class 12',
          'description' => 'SMA IPS',
          'created_at' => now(),
          ]);
    }
}
