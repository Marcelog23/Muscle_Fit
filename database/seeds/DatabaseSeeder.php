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
        //sempre q criar uma nova classe de seed, rodar o comando 'composer dump-autoload'




        $this->call(CidadeTableSeeder::class);
        $this->call(AcademiaTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(FormaPagamentoTableSeeder::class);

       // $this->call(AlunoTableSeeder::class);
       $this->call(ExercicioTableSeeder::class);


    }
}
