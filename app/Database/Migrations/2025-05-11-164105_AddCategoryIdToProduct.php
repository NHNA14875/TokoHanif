<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryIdToProduct extends Migration
{
    public function up()
    {
        $this->forge->addColumn('product', [
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
                'after' => 'id',
            ],
        ]);

        $this->forge->addForeignKey('category_id', 'product_category', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('product', 'product_category_id_foreign');
        $this->forge->dropColumn('product', 'category_id');
    }
}