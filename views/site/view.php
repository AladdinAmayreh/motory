<?php
use yii\helpers\Html;
?>

<h1><?= Html::encode($service->name) ?></h1>

<div class="service-details">
    <?= Html::img($service->image_url, ['alt' => $service->name, 'class' => 'service-image']) ?>
    <p><?= Html::encode($service->description) ?></p>
    <p>Price: $<?= Html::encode($service->price) ?></p>
    <p>Category: <?= Html::encode($service->category->name) ?></p>
</div>

<h2>Images</h2>
<div class="service-images">
    <?php foreach ($service->images as $image): ?>
        <?= Html::img($image->image_url, ['alt' => 'Service Image', 'class' => 'service-image']) ?>
    <?php endforeach; ?>
</div>