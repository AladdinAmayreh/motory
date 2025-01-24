<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

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
          
            // Add other validation rules as necessary
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

    /**
     * Get all services related to this category.
     */
    public function getServices()
    {
        return $this->hasMany(Service::class, ['category_id' => 'id']);
    }
}
