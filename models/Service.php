<?php
namespace app\models;

use Yii;
use yii\web\UploadedFile;

class Service extends \yii\db\ActiveRecord
{
    public $imageFile; // This is needed for file upload (not part of the database)

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
     * Handles the file upload and saves it to the server.
     */
    public function uploadImage()
{
    if ($this->imageFile) {
        // Generate a unique file name
        $fileName = uniqid() . '.' . $this->imageFile->extension;

        // Define the full server path
        $filePath = Yii::getAlias('@webroot/uploads/') . $fileName;

        // Ensure the uploads directory exists
        $uploadDir = dirname($filePath);
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }

        // Save the file to the server
        if ($this->imageFile->saveAs($filePath, false)) {
            return $filePath; // Return the absolute file path as a string
        } else {
            Yii::error('File upload failed', __METHOD__);
        }
    }

    return false; // Return false if the file upload fails
}
    


    /**
     * Establish relation with Category
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
