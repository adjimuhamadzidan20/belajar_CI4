<?php  
	namespace App\Controllers;
	use App\Models\Anggota_Model;

	class Anggota extends BaseController
	{
		protected $anggotaModel;
		protected $helpers = ['form'];

		public function __construct() {
			$this->anggotaModel = new Anggota_Model();
		}

		// halaman utama anggota
    public function index()
    {
      // paginasi halaman 
    	$pagination = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

    	// pencarian data anggota
    	$keyword = $this->request->getVar('keyword');
    	if ($keyword) {
    		$dataOrg = $this->anggotaModel->searchOrang($keyword);
    	} else {
    		$dataOrg = $this->anggotaModel;
    	}

      $data = [
      	"judul" => "Anggota",
      	"anggota" => $dataOrg->paginate(10, 'orang'),
      	"pager" => $this->anggotaModel->pager,
      	"currentPage" => $pagination
      ];

      return view('anggota/index', $data);
    }

    // proses hapus data
    public function delete($id) {

      $this->anggotaModel->delete($id);
      session()->setFlashData('pesan', 'Data berhasil terhapus');

      return redirect()->to('/anggota');
    }

    // halaman form tambah data
    public function create() {
    	$data = [
    		"judul" => "Tambah Data",
    		"validation" => \Config\Services::validation()
    	];

    	return view('anggota/create', $data);
    }

    // proses tambah data
    public function save() {
    	// cek validasi inputan
    	$rules = [
    		'nama' => [
    			'rules' => 'required',
    			'errors' => [
    				'required' => 'Kolom {field} tidak boleh kosong'
    			],
    		],
    		'alamat' => [
    			'rules' => 'required',
    			'errors' => [
    				'required' => 'Kolom {field} tidak boleh kosong'
    			]
    		]
    	];

    	if (!$this->validate($rules)) {
    		return redirect()->back()->withInput();
    	} 
    	else {
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');

        // menambah data anggota
    		$this->anggotaModel->addOrang($nama, $alamat);

    		// notif pesan
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');

        // kembali ke halaman utama komik
        return redirect()->to('/anggota');
    	}
    }

    // halaman edit data
    public function update($id) {
      $data = [
        "judul" => "Edit Data",
        "data" => $this->anggotaModel->getIdOrang($id)
      ];

      return view('anggota/update', $data);
    }

    // proses edit data
    public function update_proses($id) {
      // cek validasi inputan
      $rules = [
        'nama' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Kolom {field} tidak boleh kosong'
          ],
        ],
        'alamat' => [
          'rules' => 'required',
          'errors' => [
            'required' => 'Kolom {field} tidak boleh kosong'
          ]
        ]
      ];

      if (!$this->validate($rules)) {
        return redirect()->back()->withInput();
      }
      else {
        $nama = $this->request->getVar('nama');
        $alamat = $this->request->getVar('alamat');

        // mengubah data anggota
        $this->anggotaModel->updateOrang($id, $nama, $alamat);

        // notif pesan
        session()->setFlashData('pesan', 'Data berhasil diupdate');

        // kembali ke halaman utama komik
        return redirect()->to('/anggota');
      }
    }
	}

?>