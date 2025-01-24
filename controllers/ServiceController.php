<?php
namespace app\controllers;

use Yii;
use app\models\Service;
use app\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;


class ServiceController extends Controller
{
    public function actionIndex()
    {
        // Create an ActiveDataProvider instance for the Service model
        $dataProvider = new ActiveDataProvider([
            'query' => Service::find(),
            'pagination' => [
                'pageSize' => 5,  // Set the number of items per page
            ],
        ]);

        // Render the index view and pass the dataProvider to it
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $model = new Service();
        if ($model->load(Yii::$app->request->post())) {
            Yii::debug('Form data loaded: ' . var_export(Yii::$app->request->post(), true), __METHOD__);
        
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile'); // Handle file input
            if ($model->validate()) {
                Yii::debug('Model validated successfully', __METHOD__);
            } else {
                Yii::debug('Validation failed: ' . var_export($model->errors, true), __METHOD__);
            }
        }
        
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile'); // Get the uploaded file
            if ($model->uploadImage() && $model->save()) { // Save model only after successful file upload
                Yii::$app->session->setFlash('success', 'Service created successfully!');
                return $this->redirect('index');//rect to view page
            } else {
                Yii::debug('Failed to save service: ' . var_export($model->errors, true), __METHOD__);
            }
        }
    
        return $this->render('create', [
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

public function actionUpdate($id)
{
    $model = Service::findOne($id);

    if (!$model) {
        throw new NotFoundHttpException('The requested service does not exist.');
    }

    if ($model->load(Yii::$app->request->post())) {
        // Handle file upload
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            // Upload the new image and get the absolute file path
            $absoluteFilePath = $model->uploadImage();

            if ($absoluteFilePath) {
                // Delete the old image file if it exists
                if ($model->image_url && file_exists($model->image_url)) {
                    unlink($model->image_url);
                }

                // Save the new absolute file path to the database
                $model->image_url = $absoluteFilePath; // Ensure this is a string
            } else {
                Yii::$app->session->setFlash('error', 'Failed to upload the new image.');
                return $this->refresh();
            }
        }

        // Save the model
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Service updated successfully!');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'Failed to update the service.');
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}

    public function actionDelete($id)
    {
        $model = Service::findOne($id);
        if ($model) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
}
