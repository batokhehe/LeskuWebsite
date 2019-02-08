<?php

use Illuminate\Database\Seeder;
use App\Subject;

class SubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('subjects')->insert
      (
        [
          'name' => 'Bahasa Indonesia',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Bahasa Inggris',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Matematika',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'IPA',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'IPS',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'PPkn',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Matematika Wajib',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Matematika Minat',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Fisika',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Kimia',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Biologi',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Sejarah Wajib',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Sejarah Peminatan',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Ekonomi',
          'description' => '',
          'created_at' => now(),
        ]
      );
      DB::table('subjects')->insert
      (
        [
          'name' => 'Geografi',
          'description' => '',
          'created_at' => now(),
        ]
      );

    }
}
