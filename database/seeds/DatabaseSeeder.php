<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Carlos',
            'email' => 'playeralfa22@gmail.com',
            'activation_token' => 'Activo',
            'isActive' => True,
            'disabled' => False,
            'password' => Hash::make('93050807702'),
        ]);
        $token = auth()->attempt(['email' => $user->email, 'password' => '93050807702']);

        $user2 = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'activation_token' => 'Activo',
            'isActive' => True,
            'disabled' => False,
            'password' => Hash::make('93050807702'),
        ]);
        $token2 = auth()->attempt(['email' => $user2->email, 'password' => '93050807702']);
		
        $roles = array([
            [
				'id' => '1', 
				'name' => 'Administrator',
                'description' => 'Administrador del sistema',
                'disabled' => False,
                'created_at' => Carbon::now()				
			],
            [
				'id' => '2', 
				'name' => 'Usuario',
                'description' => 'Usuario del sistema',
                'disabled' => False,
                'created_at' => Carbon::now()				
			],
            [
				'id' => '3', 
				'name' => 'Recepcionista',
                'description' => 'Recepcionista',
                'disabled' => False,	
                'created_at' => Carbon::now()			
			],
            [
				'id' => '4', 
				'name' => 'Admin_negocio',
                'description' => 'Propietario de negocio',
                'disabled' => False,
                'created_at' => Carbon::now()				
			],
		]);

		foreach($roles as $item){
			DB::table('roles')->insert($item);
        }

        $role = DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => $user->id,
            'created_at' => carbon::now(),
        ]);
        $role = DB::table('role_user')->insert([
            'role_id' => '2',
            'user_id' => $user2->id,
            'created_at' => carbon::now(),
        ]);

        $business = array([
            [
				'id' => '1', 
				'name' => 'Unknown',
                'description' => 'Negocio Desconocido',
                'user_id' => $user->id,
                'disabled' => False,
                'created_at' => Carbon::now()				
            ],
        ]);

        foreach($business as $item){
            DB::table('businesses')->insert($item);
        }

        $branch = array([
            [
				'id' => '1', 
				'name' => 'Unknown',
                'description' => 'Rama Desconocida',
                'code' => 'CUDA',
                'business_id' => '1',
                'categoria_id' => '1',
                'disabled' => False,
                'created_at' => Carbon::now()				
            ],
        ]);

        foreach($branch as $item){
            DB::table('branches')->insert($item);
        }

        $branch_user = array([
            [
				'user_id' => $user->id, 
				'branch_id' => '1',
                'created_at' => Carbon::now()				
            ],
            [
				'user_id' => $user2->id, 
				'branch_id' => '1',
                'created_at' => Carbon::now()				
            ],
        ]);

        foreach($branch_user as $item){
            DB::table('branch_user')->insert($item);
        }
        
        $config = array([
            [
				'id' => '1', 
				'email_app' => 'photomanager@gmail.com',
				'telef_app' => '+1 (551) 4142-5914',				
				'logo_app' => 'http://localhost/photomanager-api/upload_documentos/logo.png',				
				'name_app' => 'PHOTOMANAGER',				
			]
		]);

		foreach($config as $item){
			DB::table('config_app')->insert($item);
		}

    }
}
