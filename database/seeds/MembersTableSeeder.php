<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MembersTableSeeder extends Seeder {


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Faker\Factory::create();
		for ($i=0;$i<=100;$i++){	
			$rand=rand(0,10);
			$group=$rand==0?null:$rand;
			$rand=rand(0,2);
			\DB::table('members')->insert(array(
					'first'=>$faker->firstName,
					'last'=>$faker->lastName,
					'identification'=>rand(99999,99999999),
					'mobile'=>$faker->phoneNumber,
					'home'=>$faker->phoneNumber,
					'address'=>$faker->address,
					'district'=>$faker->city,
					'birthdate'=>$faker->dateTimeThisCentury->format('Y-m-d'),
					'active'=>true,
					'note'=>$faker->text,
					'avatar'=>$faker->imageUrl(200,130),
					'civil_status'=>'Unmarried',
					'labor_status'=>'Employed',
					'educational_level'=>'University',
					'group'=>$group,
					'created_at'=>'2015-09-27 16:00:32',
					'updated_at'=>'2015-09-27 16:00:32',
				)
			);
		}
	}

}
