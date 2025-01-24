<?php
use yii\helpers\Html;
?>

<h1>Change Logs</h1>

<!-- Display Change Logs -->

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Action</th>
            <th>Changes</th>
            <th>Timestamp</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= Html::encode($log->action) ?></td>
                <td>
                    <?php
                    $changes = json_decode($log->changes, true);
                    echo '<pre>' . Html::encode(print_r($changes, true)) . '</pre>';
                    ?>
                </td>
                <td><?= Yii::$app->formatter->asDatetime($log->created_at) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Display All Service Images in a Table (Only for Services) -->
<?php if ($entity === 'service' && !empty($serviceImages)): ?>
    <h2>All Service Images</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image Preview</th>
                <th>Image URL</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($serviceImages as $image): ?>
                <tr>
                    <td>
                        <?= Html::img(Yii::getAlias('@web') . $image->image_url, [
                            'alt' => 'Service Image',
                            'style' => 'max-width: 100px; max-height: 100px;',
                        ]) ?>
                    </td>
                    <td><?= Html::encode($image->image_url) ?></td>
                    <td><?= Yii::$app->formatter->asDatetime($image->created_at) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>