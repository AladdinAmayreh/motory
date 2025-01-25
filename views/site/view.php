<?php
use yii\helpers\Html;
?>

<h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">
    <?= Html::encode($service->name) ?>
</h1>

<div class="service-details" style="display: flex; flex-direction: column; align-items: center; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff; padding: 20px; max-width: 800px; margin: 0 auto;">

    <!-- Service Image -->
    <?= Html::img($service->latestImage->image_url ?? 'path/to/placeholder.png', [
        'alt' => $service->name,
        'class' => 'service-image',
        'style' => 'width: 100%; max-width: 300px; height: auto; object-fit: contain; border-radius: 10px; background-color: #f9f9f9; margin-bottom: 20px;'
    ]) ?>

    <!-- Service Description -->
    <p style="font-size: 16px; color: #555; text-align: center; margin: 0 0 15px;">
        <?= Html::encode($service->description) ?>
    </p>

    <!-- Price -->
    <p style="font-size: 18px; font-weight: bold; color: #000; margin: 0 0 15px;">
        Price: $<?= Html::encode($service->price) ?>
    </p>

    <!-- Category -->
    <p style="font-size: 16px; color: #555; margin: 0;">
        Category: <?= Html::encode($service->category->name) ?>
    </p>
</div>