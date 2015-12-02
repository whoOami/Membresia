<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
                ['name' => 'Ryan Chenkie','username' => 'user1', 'email' => 'who@gmail.com', 'password' => Hash::make('secret')],
                ['name' => 'Chris Sevilleja','username' => 'user2', 'email' => 'whoami@gmail.com', 'password' => Hash::make('secret')],
                ['name' => 'Holly Lloyd','username' => 'user3', 'email' => 'la@gmail.com', 'password' => Hash::make('secret')],
                ['name' => 'Adnan Kukic','username' => 'user4', 'email' => 'lala@gmail.com', 'password' => Hash::make('secret')],
        );
		for ($i=0;$i<count($users);$i++){	
			\DB::table('users')->insert(array(
					'name'=>$users[$i]['name'],
					'username'=>$users[$i]['username'],
					'email'=>$users[$i]['email'],
					'password'=>$users[$i]['password'],
					'created_at'=>'2015-09-27 16:00:32',
					'updated_at'=>'2015-09-27 16:00:32',
				)
			);
		}
        //
    }
}
