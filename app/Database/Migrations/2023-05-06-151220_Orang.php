<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orang extends Migration
{
    public function up()
    {   
        // membuat tabel di database
        $this->forge->addField([
            'id_orang' => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_lengkap' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_orang', true);
        $this->forge->createTable('orang');
    }

    public function down()
    {
        $this->forge->dropTable('orang');
    }
}
