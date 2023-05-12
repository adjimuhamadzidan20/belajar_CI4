<?php
    namespace App\Models;

    use CodeIgniter\Model;

    class Komik_Model extends Model
    {
        protected $table = 'komik';
        protected $primaryKey = 'id_komik';
        protected $useTimestamps = true;
        protected $allowedFields = ['judul', 'slug', 'penulis', 'penerbit', 'sampul'];

        // fungsi menangkap data komik
        public function getKomik() {
            return $this->findAll();
        }

        // fungsi menampilkan detail data
        public function getDetail($slug) {
            return $this->where(['slug' => $slug])->first();
        }

        // fungsi menyimpan data komik
        public function addKomik($judul, $slug, $penulis, $penerbit, $sampul) {
           return $this->insert([
                    'judul' => $judul,
                    'slug' => $slug,
                    'penulis' => $penulis,
                    'penerbit' => $penerbit,
                    'sampul' => $sampul
                ]);
        }

        // fungsi mengubah data komik
        public function updateKomik($id, $judul, $slug, $penulis, $penerbit, $sampul) {
            $data = [
                    'judul' => $judul,
                    'slug' => $slug,
                    'penulis' => $penulis,
                    'penerbit' => $penerbit,
                    'sampul' => $sampul
                ];
                
            return $this->update($id, $data);
        }

        // fungsi mencari data komik
        public function searchKomik($komik) {
            $tabel = $this->table('komik');
            $tabel->like('judul', $komik);
            return $tabel;
        }
    }

?>