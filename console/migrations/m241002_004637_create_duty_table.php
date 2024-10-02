<?php

use antonyz89\migrate\Migration;

/**
 * Handles the creation of table `{{%duty}}`.
 */
class m241002_004637_create_duty_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%duty}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%duty}}');
    }
}
