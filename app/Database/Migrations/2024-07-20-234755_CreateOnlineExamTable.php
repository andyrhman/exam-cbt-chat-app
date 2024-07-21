<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOnlineExamTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'online_exam_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'code' => [
                'type' => 'LONGTEXT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'title' => [
                'type' => 'LONGTEXT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'class_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'section_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'subject_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'exam_date' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'time_start' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'time_end' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'duration' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'minimum_percentage' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'instruction' => [
                'type' => 'LONGTEXT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'running_year' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
        ]);

        $this->forge->addKey('online_exam_id', true);  // Primary key
        $this->forge->createTable('online_exam');
    }

    public function down()
    {
        $this->forge->dropTable('online_exam');
    }
}
