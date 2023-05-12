<?php
    namespace App\Controllers;
    use App\Models\Komik_Model;

    class Komik extends BaseController {
        protected $komikModel;
        protected $helpers = ['form'];

        public function __construct() {
            $this->komikModel = new Komik_Model();
        }

        // halaman utama komik 
        public function index() {
            // paginasi halaman
            $pagination = $this->request->getVar('page_komik') ? $this->request->getVar('page_komik') : 1; 

            // pencarian data komik
            $keyword = $this->request->getVar('keyword');
            if ($keyword) {
                $dataKomik = $this->komikModel->searchKomik($keyword);
            } else {
                $dataKomik = $this->komikModel;
            }

            $data = [
                "judul" => "Komik",
                "komik" => $dataKomik->paginate(5, 'komik'),
                "pager" => $this->komikModel->pager,
                "currentPage" => $pagination
            ];

            return view('komik/index', $data);
        }

        // halaman detail
        public function detail($slug) {
            $data = [
                "judul" => "Detail Komik",
                "detail" => $this->komikModel->getDetail($slug)
            ];

            // jika detail komik tidak ada
            if (empty($data['detail'])) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('judul komik '. $slug .' tidak tersedia');
            }

            return view('komik/detail', $data);
        }

        // halaman tambah data
        public function create() {
            $data = [
                "judul" => "Tambah Data",
                "validation" => \Config\Services::validation() 
            ];

            return view('komik/create', $data);
        }

        // proses tambah
        public function save() {
            // validasi inputan
            $rules = [
                'judul' => [
                    'rules' => 'required|is_unique[komik.judul]',
                    'errors' => [
                        'required' => 'Kolom {field} tidak boleh kosong!',
                        'is_unique' => 'Nama {field} sudah ada!'
                    ],
                ],
                'sampul' => [
                    'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/png,image/jpeg,image/jpeg]',
                    'errors' => [
                        'max_size' => 'Ukuran file gambar terlalu besar!',
                        'is_image' => 'File yang diupload harus gambar!',
                        'mime_in' => 'File yang diupload harus gambar!'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                // $validation = \Config\Services::validation();
                // return redirect()->back()->withInput()->with('validation', $validation);
                return redirect()->back()->withInput();
            } 
            else {
                 // ambil input sampul
                $fileSampul = $this->request->getFile('sampul');

                // periksa gambar diupload / tidak
                if ($fileSampul->getError() == 4) {
                    $namaFileSampul = 'default.png';
                } else {
                    $namaFileSampul = $fileSampul->getRandomName();
                    $fileSampul->move('img', $namaFileSampul);
                }

                // merubah judul menjadi slug (huruf kecil)
                $slug = url_title($this->request->getVar('judul'), '-', true);
                
                $judul = $this->request->getVar('judul');
                $penulis = $this->request->getVar('penulis');
                $penerbit = $this->request->getVar('penerbit');
                
                // menambah data komik
                $this->komikModel->addKomik($judul, $slug, $penulis, $penerbit, $namaFileSampul);

                // notif pesan
                session()->setFlashData('pesan', 'Data berhasil ditambahkan');

                // kembali ke halaman utama komik
                return redirect()->to('/komik');
            }
        }

        // proses hapus data
        public function delete($id) {

            // hapus sampul komik
            $sampulKomik = $this->komikModel->find($id);

            // periksa jika itu sampul default
            if ($sampulKomik['sampul'] != 'default.png') {
                unlink('img/'. $sampulKomik['sampul']);
            }

            $this->komikModel->delete($id);
            session()->setFlashData('pesan', 'Data berhasil terhapus');

            return redirect()->to('/komik');
        }

        // halaman edit data
        public function update($slug) {
            $data = [
                "judul" => "Edit Data",
                "validation" => \Config\Services::validation(),
                "data" => $this->komikModel->getDetail($slug)
            ];

            return view('komik/update', $data);
        }

        // proses edit data
        public function update_proses($id) {
            // cek judul komik
            $dataKomik = $this->komikModel->getDetail($this->request->getVar('slug'));
            if ($dataKomik['judul'] == $this->request->getVar('judul')) {
                $rule = 'required';
            } else {
                $rule = 'required|is_unique[komik.judul]';
            }

            $rules = [
                'judul' => [
                    'rules' => $rule,
                    'errors' => [
                        'required' => 'Kolom {field} tidak boleh kosong!',
                        'is_unique' => 'Nama {field} sudah ada!'
                    ],
                ],
                'sampul' => [
                    'rules' => 'max_size[sampul,2048]|is_image[sampul]|mime_in[sampul,image/png,image/jpeg,image/jpeg]',
                    'errors' => [
                        'max_size' => 'Ukuran file gambar terlalu besar!',
                        'is_image' => 'File yang diupload harus gambar!',
                        'mime_in' => 'File yang diupload harus gambar!'
                    ]
                ]
            ];

            // validasi inputan
            if (!$this->validate($rules)) {
                // $validation = \Config\Services::validation();
                // return redirect()->back()->withInput()->with('validation', $validation);
                return redirect()->back()->withInput();
            }
            else {
                $fileSampul = $this->request->getFile('sampul'); // sampul baru
                $fileSampulLama = $this->request->getVar('sampulLama'); // sampul lama

                // cek gambar sampul 
                if ($fileSampul->getError() == 4) {
                    // sampul lama
                    $namaFileSampul = $fileSampulLama;
                } else {
                    // sampul baru
                    $namaFileSampul = $fileSampul->getRandomName();
                    $fileSampul->move('img', $namaFileSampul);
                    unlink('img/'. $fileSampulLama);
                }

                // merubah judul menjadi slug (huruf kecil)
                $slug = url_title($this->request->getVar('judul'), '-', true);
                
                $judul = $this->request->getVar('judul');
                $penulis = $this->request->getVar('penulis');
                $penerbit = $this->request->getVar('penerbit');

                // mengubah data komik
                $this->komikModel->updateKomik($id, $judul, $slug, $penulis, $penerbit, $namaFileSampul);
                
                // notif pesan
                session()->setFlashData('pesan', 'Data berhasil diupdate');

                // kembali ke halaman utama komik
                return redirect()->to('/komik');
            }
        }
    }

?>