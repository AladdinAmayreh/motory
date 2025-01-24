<?php
namespace app\controllers;

use Yii;
use app\models\Category;
use app\models\ServicesImages;
use app\models\ChangeLogs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        // Create an ActiveDataProvider instance
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
            'pagination' => [
                'pageSize' => 20,  // Set the number of items per page
            ],
        ]);

        // Render the index view and pass the dataProvider to it
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = Category::findOne($id);
    
        if (!$model) {
            throw new NotFoundHttpException('The requested category does not exist.');
        }
    
        Yii::debug('Before Load: ' . print_r($model->attributes, true), __METHOD__); // Debugging
    
        if ($model->load(Yii::$app->request->post())) {
            Yii::debug('Form Data: ' . print_r(Yii::$app->request->post(), true), __METHOD__); // Debugging
            Yii::debug('After Load: ' . print_r($model->attributes, true), __METHOD__); // Debugging
            Yii::debug('Dirty Attributes: ' . print_r($model->getDirtyAttributes(), true), __METHOD__); // Debugging
    
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Category updated successfully!');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update the category.');
            }
        }
    
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = Category::findOne($id);
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
