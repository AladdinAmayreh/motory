<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Category;
use app\models\ServicesImages;
use app\models\ChangeLogs;

class CategoryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Displays a paginated list of categories.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Create an ActiveDataProvider instance
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
            'pagination' => [
                'pageSize' => 20, // Set the number of items per page
            ],
        ]);

        // Render the index view and pass the dataProvider to it
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new category.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Category created successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing category.
     *
     * @param int $id The ID of the category.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the category is not found.
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Category updated successfully.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update the category.');
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing category.
     *
     * @param int $id The ID of the category.
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the category is not found.
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Category deleted successfully.');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to delete the category.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Displays logs for a specific entity (e.g., category or service).
     *
     * @param string $entity The entity type (e.g., 'category').
     * @param int $entity_id The ID of the entity.
     * @return string
     */
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

    /**
     * Finds the Category model based on its primary key value.
     *
     * @param int $id The ID of the category.
     * @return Category The loaded model.
     * @throws NotFoundHttpException if the model cannot be found.
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested category does not exist.');
    }
}