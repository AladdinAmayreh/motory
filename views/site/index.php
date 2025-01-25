<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1>Services</h1>

<div class="service-list">
    <?php foreach ($services as $service): ?>
        <div class="service-card">
            <?= Html::img($service->image_url, ['alt' => $service->name, 'class' => 'service-image']) ?>
            <h2><?= Html::encode($service->name) ?></h2>
            <p><?= Html::encode($service->description) ?></p>
            <p>Price: $<?= Html::encode($service->price) ?></p>
            <a href="<?= Url::to(['site/view', 'id' => $service->id]) ?>" class="btn btn-primary">View Details</a>
        </div>
    <?php endforeach; ?>
</div>