<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MemberRelationsTableSeeder extends Seeder {


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		$relation=array('Spouse','Parent');
		for ($i=0;$i<=100;$i++){	
			\DB::table('member_relations')->insert(array(
					'id_a'=>rand(1,100),
					'relation'=>$relation[rand(0,1)],
					'id_b'=>rand(1,100),
					'created_at'=>'2015-09-27 16:00:32',
					'updated_at'=>'2015-09-27 16:00:32',
				)
			);
		}
	}

}
