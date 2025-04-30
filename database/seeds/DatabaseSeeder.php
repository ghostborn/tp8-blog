<?php
use think\migration\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->table('users')->insert($data)->save();
    }
}