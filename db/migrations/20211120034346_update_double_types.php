<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UpdateDoubleTypes extends AbstractMigration
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
    public function up(): void
    {
        $product = $this->table('product');
        $product->changeColumn('price', 'double', ['scale' => 2, 'precision' => 11])
            ->changeColumn('images', 'string', ['limit' => 255, 'null' => true])
            ->save();

        $order_details = $this->table('order_details');
        $order_details
            ->changeColumn('quantity', 'double', ['scale' => 2, 'precision' => 11])
            ->changeColumn('total_price', 'double', ['scale' => 2, 'precision' => 11])
            ->save();

        $customer_cart = $this->table('customer_cart');
        $customer_cart
            ->changeColumn('quantity', 'double', ['scale' => 2, 'precision' => 11])
            ->changeColumn('total_price', 'double', ['scale' => 2, 'precision' => 11])
            ->save();
    }
}
