<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  $table->bigIncrements('id');
     *  $table->string('name');
     *  $table->string('description');
     * @return void
     */
    public function run()
    {
        $roles = array([
            [
				'id' => '1', 
				'name' => 'Administrator',
				'description' => 'Administrador del sistema',				
			],
            [
				'id' => '2', 
				'name' => 'Usuario',
				'description' => 'Administrador del sistema',				
			],
            [
				'id' => '3', 
				'name' => 'Recepcionista',
				'description' => 'Recepcionista',				
			],
            [
				'id' => '4', 
				'name' => 'Admin_negocio',
				'description' => 'Propietario de negocio',				
			],
		]);

		foreach($roles as $item){
			DB::table('roles')->insert($item);
		}
	}
}
