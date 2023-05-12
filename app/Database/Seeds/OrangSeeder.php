<?php  
    namespace App\Database\Seeds;

    use CodeIgniter\Database\Seeder;
    use CodeIgniter\I18n\Time;

    class OrangSeeder extends Seeder
    {
        // eksekusi insert semua data
        public function run()
        {
            $faker = \Faker\Factory::create('id_ID');
            for ($i = 0; $i <= 50; $i++) {
                $data = [
                    'nama_lengkap' => $faker->name,
                    'alamat' => $faker->address,
                    'created_at' => Time::createFromTimestamp($faker->unixTime()),
                    'updated_at' => Time::now()
                ];

                // Using Query Builder
                $this->db->table('orang')->insert($data);
            }
        }
    }

?>