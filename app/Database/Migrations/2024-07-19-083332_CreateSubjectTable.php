<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSubjectTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'subject_id' => [
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

        $this->forge->addKey('subject_id', true);  // Primary key
        $this->forge->createTable('subject');
    }

    public function down()
    {
        $this->forge->dropTable('subject');
    }
}
