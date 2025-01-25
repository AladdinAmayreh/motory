<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Service;
use app\models\Category;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
        // Check for language change parameter
        if (Yii::$app->request->get('lang')) {
            $language = Yii::$app->request->get('lang');
            if ($language == 'ar') {
                Yii::$app->language = 'ar-SA'; // Set language to Arabic
            } elseif ($language == 'en') {
                Yii::$app->language = 'en-US'; // Set language to English
            }
        }
    
        // Set the layout based on the route
        if (strpos($action->id, 'admin-') === 0) {
            $this->layout = 'main'; // Use the admin layout
        } else {
            $this->layout = 'frontend'; // Use the user layout
        }
    
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        // Fetch all categories for the filter dropdown
        $categories = Category::find()->all();
    
        // Initialize the query to fetch services
        $query = Service::find()->where(['status' => 1]);
    
        // Check if a category filter is applied
        $categoryId = Yii::$app->request->get('category_id');
        if ($categoryId) {
            $query->andWhere(['category_id' => $categoryId]);
        }
    
        // Fetch services based on the query
        $services = $query->all();
    
        // Pass services and categories to the view
        return $this->render('index', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }

    public function actionView($id)
    {
        // Find the service by ID
        $service = Service::findOne($id);
        if (!$service) {
            throw new NotFoundHttpException('Service not found.');
        }

        // Increment the views column for the service
        $service->views += 1;
        $service->save(false);

        // Increment the views column for the category associated with the service
        $category = Category::findOne($service->category_id);
        if ($category) {
            $category->views += 1;
            $category->save(false);
        }

        // Render the view details page
        return $this->render('view', [
            'service' => $service,
        ]);
    }

    public function actionAdminDashboard()
    {
        // Admin dashboard
        return $this->render('admin-dashboard');
    }

    public function actionAdminServices()
    {
        // Admin services management
        return $this->render('admin-services');
    }
}