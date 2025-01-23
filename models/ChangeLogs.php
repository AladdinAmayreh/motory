<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "change_logs".
 *
 * @property int $id
 * @property string $entity services or categories
 * @property int $entity_id ID of the service or category
 * @property string $action create, update, delete
 * @property string $changes JSON format of changes
 * @property string $created_at
 */
class ChangeLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'change_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity', 'entity_id', 'action', 'changes'], 'required'],
            [['entity_id'], 'integer'],
            [['changes'], 'string'],
            [['created_at'], 'safe'],
            [['entity', 'action'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity' => 'Entity',
            'entity_id' => 'Entity ID',
            'action' => 'Action',
            'changes' => 'Changes',
            'created_at' => 'Created At',
        ];
    }
}
