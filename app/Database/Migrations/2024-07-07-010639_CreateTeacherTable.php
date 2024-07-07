<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeacherTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'teacher_id' => [
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
            'email' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 200,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'null' => false,
                'constraint' => 150,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
        ]);

        $this->forge->addKey('teacher_id', true);  // Primary key
        $this->forge->createTable('teacher');
    }

    public function down()
    {
        $this->forge->dropTable('teacher');
    }
}
