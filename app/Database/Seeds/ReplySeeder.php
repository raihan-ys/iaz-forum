<?php

namespace App\Database\Seeds;

class ReplySeeder extends \CodeIgniter\Database\Seeder
{
	public function run()
	{
		$faker = \Faker\Factory::create();
		for ($i = 0; $i < 10; $i++) {
			$reply = [
				'thread_id' => 1157,
				'content' => $faker->paragraph(6, true),
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => 168,
			];
			echo "Inserting ".($i + 1)." Dummy Data\n";
			$this->db->table('reply')->insert($reply);
		}
	}
}
