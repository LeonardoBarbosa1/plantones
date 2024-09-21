<?php

use antonyz89\migrate\Migration;

class m130524_201442_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull(),
            'status' => $this->integer()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
