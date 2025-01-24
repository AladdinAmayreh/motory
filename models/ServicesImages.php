<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "services_images".
 *
 * @property int $id
 * @property int $service_id
 * @property string $image_url
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Service $service
 */
class ServicesImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'image_url'], 'required'],
            [['service_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['image_url'], 'string', 'max' => 255],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::class, 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'image_url' => 'Image Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }
}
