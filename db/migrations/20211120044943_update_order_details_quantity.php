<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UpdateOrderDetailsQuantity extends AbstractMigration
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
        $order_details = $this->table('order_details');
        $order_details
            ->changeColumn('quantity', 'string', ['limit' => 255, 'null' => true])
            ->save();
    }
}
