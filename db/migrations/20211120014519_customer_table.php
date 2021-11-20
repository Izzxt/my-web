<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CustomerTable extends AbstractMigration
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
        $customer = $this->table('customer', ['id' => false, 'primary_key' => 'id']);
        $customer->addColumn('id', 'integer', ['limit' => 24, 'identity' => true])
            ->addColumn('username', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('password', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('phone_number', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('address', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('state', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('create_date', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('update_date', 'string', ['limit' => 255, 'null' => true])
            ->create();
    }
}
