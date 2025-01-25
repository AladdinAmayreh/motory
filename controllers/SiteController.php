<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function beforeAction($action)
    {
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
        // Fetch services from the database
        $services = \app\models\Service::find()->all();
    
        // Pass services to the view
        return $this->render('index', ['services' => $services]);
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