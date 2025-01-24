<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
?>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data']
]); ?>

    <!-- Name field -->
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- Description field -->
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <!-- Price field -->
    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'step' => '0.01', 'min' => 0]) ?>

    <!-- Discount Price field -->
    <?= $form->field($model, 'discount_price')->textInput(['type' => 'number', 'step' => '0.01', 'min' => 0]) ?>

    <!-- Category dropdown -->
    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Category']
    ) ?>

    <!-- Current image preview -->
    <?php if ($model->image_url): ?>
        <div class="form-group">
            <label>Current Image</label>
            <div>
                <?php
                // Extract the relative path from the absolute path
                $relativePath = str_replace(Yii::getAlias('@webroot') . '/', '', $model->image_url);
                ?>
                <?= Html::img(
                    Yii::getAlias('@web') . '/' . $relativePath,
                    ['alt' => $model->name, 'style' => 'max-width: 200px; max-height: 200px;']
                ) ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- File input for new image -->
    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <!-- Status checkbox -->
    <?= $form->field($model, 'status')->checkbox() ?>

    <!-- Submit button -->
    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>