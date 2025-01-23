<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%change_logs}}`.
 */
class m250123_194133_create_change_logs_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%change_logs}}', [
            'id' => $this->primaryKey(),
            'entity' => $this->string(50)->notNull()->comment('services or categories'),
            'entity_id' => $this->integer()->notNull()->comment('ID of the service or category'),
            'action' => $this->string(50)->notNull()->comment('create, update, delete'),
            'changes' => $this->text()->notNull()->comment('JSON format of changes'),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%change_logs}}');
    }
}
