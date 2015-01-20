<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		//DatabaseSeeder roept de classes van de tabellen uit de db aan, om ze te kunnen op vullen met seed/testgegevens
		$this->call('UserTableSeeder');
		$this->call('ItemTableSeeder');
	}

}
