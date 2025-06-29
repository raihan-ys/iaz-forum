<?php

namespace App\Database\Seeds;

class RatingSeeder extends \CodeIgniter\Database\Seeder
{
	public function run()
	{
		for ($i = 0; $i < 10; $i++) {
			$rating = [
				'thread_id' => rand(1157, 1187),
				'user_id' => rand(168, 198),
				'star' => rand(1, 5),
			];
			echo "Inserting ".($i + 1)." Dummy Data\n";
			$this->db->table('rating')->insert($rating);
		}
	}
}
