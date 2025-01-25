<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<h1 style="font-size: 24px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">
    <?= Yii::t('app', 'Services') ?>
</h1>

<!-- Category Filter Navbar -->
<div style="text-align: center; margin-bottom: 20px; padding: 10px; background-color: #f9f9f9; border-radius: 10px;">
    <nav style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
        <!-- "All Categories" Link -->
        <a href="<?= Url::to(['site/index']) ?>" style="text-decoration: none; padding: 10px 15px; border-radius: 5px; background-color: <?= !Yii::$app->request->get('category_id') ? '#007bff' : '#ddd'; ?>; color: <?= !Yii::$app->request->get('category_id') ? '#fff' : '#333'; ?>; transition: background-color 0.3s;">
            <?= Yii::t('app', 'All Categories') ?>
        </a>

        <!-- Category Links -->
        <?php foreach ($categories as $category): ?>
            <a href="<?= Url::to(['site/index', 'category_id' => $category->id]) ?>" style="text-decoration: none; padding: 10px 15px; border-radius: 5px; background-color: <?= Yii::$app->request->get('category_id') == $category->id ? '#007bff' : '#ddd'; ?>; color: <?= Yii::$app->request->get('category_id') == $category->id ? '#fff' : '#333'; ?>; transition: background-color 0.3s;">
                <?= Html::encode($category->name) ?>
            </a>
        <?php endforeach; ?>
    </nav>
</div>

<!-- Service List -->
<div class="service-list"
    style="display: grid; grid-template-columns: 1fr; gap: 20px; padding: 20px; max-width: 1200px; margin: 0 auto;">
    <?php foreach ($services as $service): ?>
        <div class="service-card"
            style="display: flex; flex-direction: <?= Yii::$app->language == 'ar-SA' ? 'row-reverse' : 'row'; ?>; align-items: center; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.3s, box-shadow 0.3s; background-color: #fff; padding: 20px; gap: 20px; width: 100%; box-sizing: border-box;">            

            <!-- Logo/Image Section -->
            <?= Html::img($service->latestImage->image_url ?? 'path/to/placeholder.png', [
                'alt' => $service->name,
                'class' => 'service-image',
                'style' => 'width: 120px; height: 120px; object-fit: contain; border-radius: 10px; background-color: #f9f9f9; max-width: 100%;'
            ]) ?>

            <!-- Content Section -->
            <div style="flex: 1; text-align: <?= Yii::$app->language == 'ar-SA' ? 'right' : 'left'; ?>; padding: 10px;">

                <!-- Category Name -->
                <h3 style="font-size: 18px; font-weight: bold; margin: 0 0 10px; color: #333;">
                    <?= Html::encode($service->category->name ?? Yii::t('app', 'Uncategorized')) ?>
                </h3>

                <!-- Service Name -->
                <h2 style="font-size: 20px; font-weight: bold; margin: 0 0 15px; color: #007bff;">
                    <?= Html::encode($service->name) ?>
                </h2>

                <!-- Price and Warranty Section beside the Image -->
                <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 15px;">
                    
                    <!-- Price (Beside the image in Arabic) -->
                    <div>
                        <?php if ($service->discount_price > 0): ?>
                            <p style="font-size: 16px; color: #888; text-decoration: line-through; margin: 0;">
                                <?= Yii::$app->language == 'ar-SA' ? 'ريال ' . Yii::$app->formatter->asDecimal($service->price) : 'SAR ' . Html::encode($service->price) ?>
                            </p>
                            <p style="font-size: 18px; font-weight: bold; color: #000; margin: 0;">
                                <?= Yii::$app->language == 'ar-SA' ? 'ريال ' . Yii::$app->formatter->asDecimal($service->discount_price) : 'SAR ' . Html::encode($service->discount_price) ?>
                            </p>
                        <?php else: ?>
                            <p style="font-size: 18px; font-weight: bold; color: #000; margin: 0;">
                                <?= Yii::$app->language == 'ar-SA' ? 'ريال ' . Yii::$app->formatter->asDecimal($service->price) : 'SAR ' . Html::encode($service->price) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Warranty/Insurance (Beside the price in Arabic) -->
                    <p style="font-size: 14px; color: #555; margin: 0;">
                        <?= Yii::t('app', 'Warranty') ?>:
                        <?= Html::encode($service->insurance_years . " " . (Yii::$app->language == 'ar-SA' ? Yii::t('app', 'سنوات') : Yii::t('app', 'years'))) ?>
                    </p>

                </div>

                <!-- Button Section (At the end of the card) -->
                <div style="text-align: <?= Yii::$app->language == 'ar-SA' ? 'left' : 'right'; ?>;">
                    <a href="<?= Url::to(['site/view', 'id' => $service->id]) ?>" class="btn btn-primary"
                        style="text-decoration: none; background-color: #007bff; color: #fff; padding: 10px 20px; border-radius: 5px; display: inline-block; transition: background-color 0.3s;">
                        <?= Yii::t('app', 'View Details') ?>
                    </a>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>