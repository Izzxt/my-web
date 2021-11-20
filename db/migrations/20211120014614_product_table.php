<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ProductTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $product = $this->table('product', ['id' => false, 'primary_key' => 'id']);
        $product->addColumn('id', 'integer', ['limit' => 24, 'identity' => true])
            ->addColumn('product_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('code_product', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('price', 'double', ['limit' => 11, 'null' => true])
            ->addColumn('images', 'double', ['limit' => 255, 'null' => true])
            ->addColumn('description', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('create_date', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('update_date', 'string', ['limit' => 255, 'null' => true])
            ->create();
    }
}
