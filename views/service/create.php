<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

$this->title = 'Create Service';
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'], 
]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Category']
    ) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?> <!-- Ensure that the form allows file uploads -->

    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?> <!-- Added price field -->

    <?= $form->field($model, 'discount_price')->textInput(['type' => 'number']) ?> <!-- Added discount price field -->

    <?= $form->field($model, 'insurance_years')->textInput(['type' => 'number']) ?> <!-- Added insurance years field -->

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>