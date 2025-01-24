<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            'description:ntext',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} {logs}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this category?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'logs' => function ($url, $model) {
                        return Html::a('View Logs', ['category/view-logs', 'entity' => 'Category', 'entity_id' => $model->id], [
                            'class' => 'btn btn-info',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>