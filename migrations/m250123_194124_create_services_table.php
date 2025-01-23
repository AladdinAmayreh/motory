<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 */
class m250123_194124_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull(),
            'discount_price' => $this->decimal(10, 2)->defaultValue(null),
            'insurance_years' => $this->integer()->defaultValue(0),
            'image_url' => $this->string(255)->defaultValue(null),
            'status' => $this->tinyInteger(1)->defaultValue(1)->comment('1: Published, 0: Unpublished'),
            'category_id' => $this->integer()->notNull(),
            'views' => $this->integer()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    
        // Add foreign key for category_id
        $this->addForeignKey(
            'fk-services-category_id',
            '{{%services}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }
    
    public function safeDown()
    {
        $this->dropForeignKey('fk-services-category_id', '{{%services}}');
        $this->dropTable('{{%services}}');
    }
}
