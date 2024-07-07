<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassroomTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'class_id' => [
                'type' => 'INT',
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 150,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'teacher_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'name_numeric' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 150,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
        ]);

        $this->forge->addKey('class_id', true);  // Primary key
        $this->forge->createTable('class');
    }

    public function down()
    {
        $this->forge->dropTable('class');
    }
}
