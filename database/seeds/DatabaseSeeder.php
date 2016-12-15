<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('colaboradores')->insert([
        	'nome' => 'Thiago Hofmeister',
        	'email' => 'thiago.hofmeister@gmail.com',
        	'telefone' => '(51) 99401-7101',
        	'data_nascimento' => '1997-04-25',
        	'password' => Hash::make('540120'),
        	'status' => '1'
        ]);
        DB::table('colaboradores')->insert([
        	'nome' => 'Tiago Silveira',
        	'email' => 'tiagonomade@gmail.com',
        	'telefone' => '(51) 99366-4639',
        	'data_nascimento' => '1997-04-25',
        	'password' => Hash::make('456123'),
        	'status' => '1'
        ]);
    }
}
