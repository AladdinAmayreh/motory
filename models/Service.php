<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\behaviors\LoggingBehavior;

class Service extends \yii\db\ActiveRecord
{
    // Property for file upload (not part of the database)
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Services'; // Ensure this matches your table name
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'description'], 'required'],
            [['name', 'description'], 'string'],
            [['status'], 'boolean'],
            [['price', 'discount_price', 'insurance_years'], 'number'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['image_url'], 'safe'],
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
            'status' => '1: Published, 0: Unpublished',
            'category_id' => 'Category Name',
            'imageFile' => 'Service Image',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            LoggingBehavior::class, // Attach logging behavior
        ];
    }

    /**
     * Handles the file upload and saves it to the server.
     *
     * @param UploadedFile $imageFile The uploaded file instance.
     * @return string|null The relative path to the uploaded file, or null on failure.
     */
    public function uploadImage($imageFile)
    {
        if (!$imageFile) {
            Yii::error('No image file provided.', __METHOD__);
            return null;
        }

        // Define the upload directory
        $uploadDir = Yii::getAlias('@webroot/uploads/');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }

        // Generate a unique file name
        $fileName = uniqid() . '.' . $imageFile->extension;
        $filePath = $uploadDir . $fileName;

        // Save the file to the server
        if ($imageFile->saveAs($filePath)) {
            Yii::info('Image uploaded successfully: ' . $filePath, __METHOD__);
            return '/uploads/' . $fileName; // Return the relative path
        }

        Yii::error('Failed to save image: ' . $filePath, __METHOD__);
        return null;
    }

    /**
     * Establishes a relation with the Category model.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Fetches the latest image associated with the service.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLatestImage()
    {
        return $this->hasOne(ServicesImages::class, ['service_id' => 'id'])
            ->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * Fetches all images associated with the service.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ServicesImages::class, ['service_id' => 'id']);
    }
}