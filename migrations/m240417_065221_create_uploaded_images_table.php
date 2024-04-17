<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%uploaded_images}}`.
 */
class m240417_065221_create_uploaded_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%uploaded_images}}', [
            'id' => $this->primaryKey(),
            'file_name' => $this->string(255)->notNull(),
            'upload_time' => $this->dateTime()->defaultExpression('NOW()')->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%uploaded_images}}');
    }
}
