<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="row">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5><?= Html::encode($model->name) ?></h5>
                    </div>
                    <div class="card-body">
                        <!-- Display the service image -->
                        <?php if ($model->latestImage): ?>
                            <img src="<?= Html::encode($model->latestImage->image_url) ?>" alt="<?= Html::encode($model->name) ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <p>No image available.</p>
                        <?php endif; ?>

                        <!-- Display other service details -->
                        <p class="card-text"><?= Html::encode($model->description) ?></p>
                        <p><strong>Price:</strong> <?= Yii::$app->formatter->asCurrency($model->price, 'SAR') ?></p>
                        <p><strong>Discount Price:</strong> <?= Yii::$app->formatter->asCurrency($model->discount_price, 'SAR') ?></p>
                        <p>
                            <strong>Status:</strong>
                            <?= Html::a(
                                $model->status ? 'Published' : 'Unpublished',
                                Url::to(['toggle-status', 'id' => $model->id]),
                                [
                                    'class' => $model->status ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Are you sure you want to toggle this status?',
                                ]
                            ) ?>
                        </p>
                        <p>
                            <strong>Views:</strong>
                            <h5><?= Html::encode($model->views) ?></h5>
                        </p>
                        <p><strong>Category:</strong> <?= $model->category ? Html::encode($model->category->name) : 'No Category' ?></p>
                    </div>
                    <div class="card-footer">
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'data-method' => 'post',
                            'data-confirm' => 'Are you sure you want to delete this service?',
                        ]) ?>
                        <?= Html::a('View Logs', ['service/view-logs', 'entity' => 'Service', 'entity_id' => $model->id], [
                            'class' => 'btn btn-info btn-sm',
                        ]) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
