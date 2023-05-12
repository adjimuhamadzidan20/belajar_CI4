<?php  
	namespace App\Models;

	use CodeIgniter\Model;

	class Anggota_Model extends Model
	{
    protected $table = 'orang';
  	protected $primaryKey = 'id_orang';
  	protected $useTimestamps = true;
  	protected $allowedFields = ['nama_lengkap', 'alamat'];

  	// fungsi menangkap data anggota
  	public function getOrang() {
  		return $this->findAll();
  	}

  	// fungsi menangkap data anggota sesuai id
  	public function getIdOrang($id) {
  		return $this->find($id);
  	}

  	// fungsi menambah data anggota
  	public function addOrang($nama, $alamat) {
  		return $this->insert([
    			'nama_lengkap' => $nama,
    			'alamat' => $alamat
    		]);
  	}

  	// fungsi mengubah data anggota
  	public function updateOrang($id, $nama, $alamat) {
  		$data = [
          "nama_lengkap" => $nama,
          "alamat" => $alamat
        ];

        return $this->update($id, $data);
  	}

  	// fungsi mencari data anggota
  	public function searchOrang($nama) {
  		$tabel = $this->table('orang');
  		$tabel->like('nama_lengkap', $nama);
  		$tabel->orLike('alamat', $nama);
  		return $tabel;
  	}
	}

?>