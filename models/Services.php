<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property float $price
 * @property float|null $discount_price
 * @property int|null $insurance_years
 * @property string|null $image_url
 * @property int|null $status 1: Published, 0: Unpublished
 * @property int $category_id
 * @property int|null $views
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Categories $category
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'category_id'], 'required'],
            [['description'], 'string'],
            [['price', 'discount_price'], 'number'],
            [['insurance_years', 'status', 'category_id', 'views'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_url'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'discount_price' => 'Discount Price',
            'insurance_years' => 'Insurance Years',
            'image_url' => 'Image Url',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'views' => 'Views',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
    }
}
