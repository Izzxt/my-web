<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UpdateOrderDetails extends AbstractMigration
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
        $table = $this->table('order_details');
        $table->addColumn('cart', 'string', ['limit' => 255, 'null' => true])
            ->update();

        $table = $this->table('order_details');
        $table->removeColumn('price')
            ->removeColumn('code_product')
            ->removeColumn('quantity')
            ->update();
    }
}
