<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_soal_pilihan_ganda_table extends CI_Migration {

    public function up()
    {
        // Create soal_pilihan_ganda table
        $this->dbforge->add_field([
            'id_soal' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'nip' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'id_mapel' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'id_tugas' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ],
            'pertanyaan' => [
                'type' => 'TEXT'
            ],
            'kunci_jawaban' => [
                'type' => 'ENUM("A","B","C","D")'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->dbforge->add_key('id_soal', TRUE);
        $this->dbforge->create_table('soal_pilihan_ganda');

        // Create pilihan_jawaban table
        $this->dbforge->add_field([
            'id_pilihan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'id_soal' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'pilihan_a' => [
                'type' => 'TEXT'
            ],
            'pilihan_b' => [
                'type' => 'TEXT'
            ],
            'pilihan_c' => [
                'type' => 'TEXT'
            ],
            'pilihan_d' => [
                'type' => 'TEXT'
            ]
        ]);
        $this->dbforge->add_key('id_pilihan', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id_soal) REFERENCES soal_pilihan_ganda(id_soal) ON DELETE CASCADE');
        $this->dbforge->create_table('pilihan_jawaban');
    }

    public function down()
    {
        $this->dbforge->drop_table('pilihan_jawaban');
        $this->dbforge->drop_table('soal_pilihan_ganda');
    }
} 