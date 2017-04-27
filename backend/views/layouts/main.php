<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

if (class_exists('backend\assets\AppAsset')) {
    backend\assets\AppAsset::register($this);
}

dmstr\web\AdminLteAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Yii::$app->name ?> <?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-black fixed sidebar-mini">
    <?php $this->beginBody() ?>

    <?
    if (\common\modules\rbac\components\Helper::checkRoute('main/index')) {
        ?>
        <div class="wrapper">
            <?= $this->render(
                'header.php',
                ['directoryAsset' => $directoryAsset]
            ) ?>

            <?= $this->render(
                'left.php',
                ['directoryAsset' => $directoryAsset]
            )
            ?>

            <?= $this->render(
                'content.php',
                ['content' => $content, 'directoryAsset' => $directoryAsset]
            ) ?>

        </div>

        <?
    } else {
        ?>
        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>
        <section class="content">
            <?= \dmstr\widgets\Alert::widget() ?>
            <?= $content ?>
        </section>
        <?
    }
    ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>