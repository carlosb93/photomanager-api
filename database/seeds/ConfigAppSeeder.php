<?php

use Illuminate\Database\Seeder;

class ConfigAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
}
