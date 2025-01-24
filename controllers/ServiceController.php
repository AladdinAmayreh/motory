<?php
namespace app\controllers;

use Yii;
use app\models\Service;
use app\models\Category;
use app\models\ServicesImages;
use app\models\ChangeLogs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class ServiceController extends Controller
{
    public function actionIndex()
    {
        // Create a data provider for the Service model
        $dataProvider = new ActiveDataProvider([
            'query' => Service::find(),
            'pagination' => [
                'pageSize' => 10, // Number of items per page
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC, // Sort by latest first
                ],
            ],
        ]);
        $services = Service::find()->all();
        // Pass the data provider to the view
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'services'=>$services,
        ]);
    }
    public function actionCreate()
    {
        $model = new Service();
    
        if ($model->load(Yii::$app->request->post())) {
            // Handle image upload
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($imageFile) {
                // Call the uploadImage method on the model instance
                $imagePath = $model->uploadImage($imageFile);
                if ($imagePath) {
                    // Save the service first to get its ID
                    if ($model->save()) {
                        // Save the image to the `services_images` table
                        $serviceImage = new ServicesImages();
                        $serviceImage->service_id = $model->id; // Set the service_id
                        $serviceImage->image_url = $imagePath; // Set the image_url
                        if (!$serviceImage->save()) {
                            Yii::error('Failed to save service image: ' . print_r($serviceImage->errors, true), __METHOD__);
                        } else {
                            Yii::info('Service image saved successfully: ' . $imagePath, __METHOD__);
                        }
                    }
                }
            } else {
                // Save the service without an image
                $model->save();
            }
    
            Yii::$app->session->setFlash('success', 'Service created successfully.');
            return $this->redirect(['index']);
        }
    
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
    
        if ($model->load(Yii::$app->request->post())) {
            // Handle image upload
            $imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($imageFile) {
                // Call the uploadImage method on the model instance
                $imagePath = $model->uploadImage($imageFile);
                if ($imagePath) {
                    // Save the service first to ensure the ID is available
                    if ($model->save()) {
                        // Save the new image to the `services_images` table
                        $serviceImage = new ServicesImages();
                        $serviceImage->service_id = $model->id; // Set the service_id
                        $serviceImage->image_url = $imagePath; // Set the image_url
                        if (!$serviceImage->save()) {
                            Yii::error('Failed to save service image: ' . print_r($serviceImage->errors, true), __METHOD__);
                        } else {
                            Yii::info('Service image saved successfully: ' . $imagePath, __METHOD__);
                        }
                    }
                }
            } else {
                // Save the service without an image
                $model->save();
            }
    
            Yii::$app->session->setFlash('success', 'Service updated successfully.');
            return $this->redirect(['index']);
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
{
    if (($model = Service::findOne($id)) !== null) {
        return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
}

    public function actionToggleStatus($id)
{
    $model = $this->findModel($id);
    $model->status = !$model->status; // Toggle the status
    if ($model->save(false)) { // Save without validation
        Yii::$app->session->setFlash('success', 'Status updated successfully!');
    } else {
        Yii::$app->session->setFlash('error', 'Failed to update status!');
    }
    return $this->redirect(['index']);
}



    public function actionDelete($id)
    {
        $model = Service::findOne($id);
        if ($model) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
    public function actionViewLogs($entity, $entity_id)
    {
        $logs = ChangeLogs::find()
            ->where(['entity' => $entity, 'entity_id' => $entity_id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
    
        // Fetch service images only if the entity is a service
        $serviceImages = [];
        if ($entity === 'service') {
            $serviceImages = ServicesImages::find()
                ->where(['service_id' => $entity_id])
                ->orderBy(['created_at' => SORT_DESC])
                ->all();
        }
    
        return $this->render('@app/views/logs/view-logs', [
            'logs' => $logs,
            'serviceImages' => $serviceImages, // Pass the images to the view (empty for categories)
            'entity' => $entity, // Pass the entity type to the view
        ]);
    }
}
