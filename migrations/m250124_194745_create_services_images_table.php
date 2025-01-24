<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services_images}}`.
 */
class m250124_194745_create_services_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('services_images', [
            'id' => $this->primaryKey(),
            'service_id' => $this->integer()->notNull(),
            'image_url' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    
        // Add foreign key to link with the `services` table
        $this->addForeignKey(
            'fk-services_images-service_id',
            'services_images',
            'service_id',
            'services', // Assuming your services table is named `services`
            'id',
            'CASCADE',
            'CASCADE'
        );
    }
    
    public function safeDown()
    {
        $this->dropForeignKey('fk-services_images-service_id', 'services_images');
        $this->dropTable('services_images');
    }
}
