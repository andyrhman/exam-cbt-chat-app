<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOnlineExamResult extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'online_exam_result_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'online_exam_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'student_id' => [
                'type' => 'INT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'answer_script' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'obtained_mark' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
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
            'exam_started_timestamp' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'result' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
        ]);

        $this->forge->addKey('online_exam_result_id', true);  // Primary key
        $this->forge->createTable('online_exam_result');
    }

    public function down()
    {
        $this->forge->dropTable('online_exam_result');
    }
}
