<?php
use yii\helpers\Html;
?>

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
<header>
    <h1>Motory Frontend</h1>
    <nav>
        <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">Home</a>
    </nav>
</header>
<div class="container">
    <?= $content ?>
</div>
<footer>
    <p>&copy; <?= date('Y') ?> Motory. All rights reserved.</p>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>