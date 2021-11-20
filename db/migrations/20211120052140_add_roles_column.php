<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddRolesColumn extends AbstractMigration
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
        $table = $this->table('customer');
        $table->addColumn('role_id', 'integer', [
            'default' => 1, 'limit' => 11, 'null' => true,
        ])->save();

        $customer = $this->table('roles', ['id' => false, 'primary_key' => 'id']);
        $customer->addColumn('id', 'integer', ['limit' => 24, 'identity' => true])
            ->addColumn('role_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('role_desc', 'string', ['limit' => 255, 'null' => true])
            ->create();
    }

    public function up(): void
    {
        $data = [
            ['role_name' => 'customer', 'role_desc' => 'Customer'],
            ['role_name' => 'admin', 'role_desc' => 'Administrator'],
        ];

        $this->table('roles')->insert($data)->save();
    }
}
