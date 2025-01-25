<?php
use yii\helpers\Html;
?>

<?php $this->registerCssFile('@web/css/services.css'); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?= Html::cssFile('@web/css/frontend.css') ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Header -->
<header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: #f8f9fa; border-bottom: 1px solid #ddd; direction: <?= Yii::$app->language == 'ar-SA' ? 'rtl' : 'ltr'; ?>;">
    
    <!-- Logo -->
    <div style="display: flex; align-items: center; order: <?= Yii::$app->language == 'ar-SA' ? '2' : '1'; ?>;">
        <?= Html::img('@web/images/logo.png', [
            'alt' => 'Motory Logo',
            'style' => 'height: 50px; margin-right: 10px;'
        ]) ?>
    </div>

    <!-- Navigation -->
    <nav style="order: <?= Yii::$app->language == 'ar-SA' ? '1' : '2'; ?>;">
        <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>" style="margin-right: 15px; text-decoration: none; color: #007bff;">Home</a>
        <!-- Language Switcher -->
        <a href="<?= Yii::$app->urlManager->createUrl(['site/index', 'lang' => Yii::$app->language == 'en-US' ? 'ar' : 'en']) ?>" style="text-decoration: none; color: #007bff;">
            <?= Yii::$app->language == 'en-US' ? 'عربي' : 'English' ?>
        </a>
    </nav>
</header>

<!-- Main Content -->
<div class="container">
    <?= $content ?>
</div>

<!-- Footer -->
<footer style="text-align: center; padding: 20px; background-color: #f8f9fa; border-top: 1px solid #ddd; margin-top: 20px;">
    <p style="margin: 0; color: #555;">&copy; <?= date('Y') ?> Motory. All rights reserved.</p>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>