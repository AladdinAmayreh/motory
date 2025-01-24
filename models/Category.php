<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\behaviors\LoggingBehavior;

class Category extends ActiveRecord
{
    public static function tableName()
    {
        return 'categories'; // Table name
    }

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }
    public function attributeLabels()
    {
        return [
          
            'name' => 'Category Name',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function behaviors()
    {
        return [
            LoggingBehavior::class,
        ];
    }
    /**
     * Get all services related to this category.
     */
    public function getServices()
    {
        return $this->hasMany(Service::class, ['category_id' => 'id']);
    }
    public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
        // Ensure this method does not override the attributes being updated
        return true;
    }
    return false;
}
}
