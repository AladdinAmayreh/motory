<?php
namespace app\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use app\models\ChangeLogs;

class LoggingBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'logCreate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'logUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'logDelete',
        ];
    }

    /**
     * Log creation of a record.
     */
    public function logCreate($event)
    {
        $this->logAction('create', $event->sender);
    }

    /**
     * Log update of a record.
     */
    public function logUpdate($event)
    {
        $this->logAction('update', $event->sender);
    }

    /**
     * Log deletion of a record.
     */
    public function logDelete($event)
    {
        $this->logAction('delete', $event->sender);
    }

    /**
     * Log the action to the change_logs table.
     */
    protected function logAction($action, $model)
    {
        $log = new ChangeLogs();
        $log->entity = $this->getEntityName($model);
        $log->entity_id = $model->id;
        $log->action = $action;
    
        // Log changes for update action
        if ($action === 'update') {
            // Capture old and new data
            $newAttributes = $model->attributes;
    
            $changes = [
                'new' => $newAttributes,
            ];
    
            $log->changes = json_encode($changes, JSON_PRETTY_PRINT);
        } else {
            // For create and delete actions, log the current attributes
            $log->changes = json_encode($model->attributes, JSON_PRETTY_PRINT);
        }
    
        if (!$log->save()) {
            Yii::error('Failed to save log: ' . print_r($log->errors, true), __METHOD__); // Debugging
        }
    }
    /**
     * Get the entity name (e.g., 'Service' or 'Category').
     */
    protected function getEntityName($model)
    {
        return (new \ReflectionClass($model))->getShortName();
    }
}