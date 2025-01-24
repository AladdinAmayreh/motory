<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "change_logs".
 *
 * @property int $id
 * @property string $entity
 * @property int $entity_id
 * @property string $action
 * @property string $changes
 * @property string $created_at
 */
class ChangeLogs extends ActiveRecord
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