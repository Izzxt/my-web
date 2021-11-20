<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class OrderDetailsTable extends AbstractMigration
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
        $order_details = $this->table('order_details', ['id' => false, 'primary_key' => 'id']);
        $order_details->addColumn('id', 'integer', ['limit' => 24, 'identity' => true])
            ->addColumn('customer_id', 'integer', ['limit' => 11])
            ->addColumn('order_number', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('code_product', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('shipping_address', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('quantity', 'double', ['limit' => 11, 'null' => true])
            ->addColumn('total_price', 'double', ['limit' => 11, 'null' => true])
            ->addColumn('payment_status', 'enum', ['null' => true, 'values' => ['unpaid', 'paid'], 'default' => 'unpaid'])
            ->addColumn('payment_type', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('status', 'enum', ['null' => true, 'values' => ['pending', 'done'], 'default' => 'pending'])
            ->addColumn('timestamp', 'string', ['limit' => 255, 'null' => true])
            ->create();
    }
}
