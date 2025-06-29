<?php

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create();
		for ($i = 0; $i < 5; $i++) {
			$user = [
				'username' => $faker->userName,
				'password' => $faker->password,
				'salt' => uniqid('', true),	
				'name' => $faker->name,
				'email' => $faker->email,
				'birthdate' => $faker->date($format = 'Y-m-d', $max='now'),
				'address' => $faker->address,
				'phone_number'=> $faker->phoneNumber,
				'avatar' => 'user-logo.jpeg',
				'role' => $faker->randomElement(['Admin', 'Member']),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => 168,
			];
			echo "Inserting ".($i + 1)." Dummy Data\n";
			$this->db->table('user')->insert($user);
		}
	}
}
