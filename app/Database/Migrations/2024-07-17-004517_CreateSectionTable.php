<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSectionTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'section_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 200,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'name_numeric' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 200,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'class_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'teacher_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ]
        ]);

        $this->forge->addKey('section_id', true);  // Primary key
        $this->forge->createTable('section');
    }

    public function down()
    {
        $this->forge->dropTable('section');
    }
}
