<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLanguageTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'phrase_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'phrase' => [
                'type' => 'LONGTEXT',
                'null' => false,
                'character set' => 'utf8',
                'collation' => 'utf8_unicode_ci'
            ],
        ]);

        $this->forge->addKey('phrase_id', true);  // Primary key
        $this->forge->createTable('language');
    }

    public function down()
    {
        $this->forge->dropTable('language');
    }
}
