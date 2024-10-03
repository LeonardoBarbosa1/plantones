<?php

use antonyz89\migrate\Migration;

/**
 * Handles the creation of table `{{%duty_activities}}`.
 */
class m241003_012405_create_duty_activities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%duty_activities}}', [
            'id' => $this->primaryKey(),
            'duty_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
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
        $this->dropTable('{{%duty_activities}}');
    }
}
