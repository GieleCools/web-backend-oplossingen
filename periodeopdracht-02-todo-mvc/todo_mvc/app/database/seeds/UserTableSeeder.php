<?php

	class UserTableSeeder extends Seeder
	{
		//om te kunnen seeden --> $this->call('UserTableSeeder') in DatabaseSeeder.php --> roept deze class aan
		public function run()
		{
			//data die al in de db staat verwijderen vooraleer te seeden, anders komt er dubbele data in de db
			DB::table('users')->delete();

			//array met opvuldata/opvulgebruikers
			//bij Laravel geen salt nodig, want maakt gebruikt van BCrypt hash, salt is automatisch inbegrepen
			$users = array(

				array(	'email' => 'giele@test.be',
						'password' => Hash::make('rootroot')
						)
				);

			//database opvullen met users
			DB::table('users')->insert($users);
		}
	}

?>