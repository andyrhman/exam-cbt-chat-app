<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOnlineExamBank extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'question_bank_id' => [
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
            'question_title' => [
                'type' => 'LONGTEXT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'number_of_options' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'options' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'correct_answers' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
            'mark' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
        ]);

        $this->forge->addKey('question_bank_id', true);  // Primary key
        $this->forge->createTable('question_bank');
    }

    public function down()
    {
        $this->forge->dropTable('question_bank');
    }
}
