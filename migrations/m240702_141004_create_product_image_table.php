<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_image}}`.
 */
class m240702_141004_create_product_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_image}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'base_url' => $this->string(),
            'path_url' => $this->string(),
        ]);

        $this->addForeignKey('fk-product-image-product_id', 'product_image', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product-image-product_id', 'product_image');

        $this->dropTable('{{%product_image}}');
    }
}
