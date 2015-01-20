<?php

	class ItemTableSeeder extends Seeder
	{
		//om te kunnen seeden --> $this->call('ItemTableSeeder') in DatabaseSeeder.php --> roept deze class aan
		public function run()
		{
			//data die al in de db staat verwijderen vooraleer te seeden, anders komt er dubbele data in de db
			DB::table('items')->delete();

			//array met opvuldata/opvulgebruikers
			//bij Laravel geen salt nodig, want maakt gebruikt van BCrypt hash, salt is automatisch inbegrepen
			$items = array(

				array(	'user_id' => 1, 
						'name' => 'Todo App in MVC maken.', 
						'done' => FALSE
				),

				array(	'user_id' => 1, 
						'name' => 'Pizza eten.', 
						'done' => TRUE
				),

				array(	'user_id' => 1, 
						'name' => 'Examen marketingcommunicatie studeren.', 
						'done' => FALSE
				),

				array(	'user_id' => 1, 
						'name' => 'Slapen.', 
						'done' => FALSE
				));

			//database opvullen met users
			DB::table('items')->insert($items);
		}

	}

?>