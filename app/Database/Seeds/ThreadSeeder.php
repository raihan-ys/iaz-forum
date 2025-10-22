<?php

namespace App\Database\Seeds;

class ThreadSeeder extends \CodeIgniter\Database\Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create();
		for ($i = 0; $i < 10; $i++) {
			$thread = [
				'title' => $faker->sentence(6, true),
				'content' => $faker->paragraph(6, true),
				'category_id' => rand(1, 5),	
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => 271,
			];
			echo "Inserting ".($i + 1)." Dummy Data\n";
			$this->db->table('thread')->insert($thread);
		}
	}
}
