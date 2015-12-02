<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$group=array('Logistic','Estadistic','Sound','J. Local', 'Alabanza', 'A. Social', 'A. Pastoral', 'Misiones', 'Jovenes', 'Adulto Mayor');
		for ($i=0;$i<count($group);$i++){	
			\DB::table('groups')->insert(array(
					'name'=>$group[$i],
					'type'=>0,
					'created_at'=>'2015-09-27 16:00:32',
					'updated_at'=>'2015-09-27 16:00:32',
				)
			);
		}
		$group=array('Alpinistas','Escaladores');
		for ($i=0;$i<count($group);$i++){	
			\DB::table('groups')->insert(array(
					'name'=>$group[$i],
					'type'=>1,
					'created_at'=>'2015-09-27 16:00:32',
					'updated_at'=>'2015-09-27 16:00:32',
				)
			);
		}
        //
    }
}
