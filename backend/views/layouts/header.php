<?php
use yii\helpers\Html;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">S</span><span class="logo-lg">Seamobi</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <?
            if (!Yii::$app->user->isGuest) {
                $authManager = Yii::$app->getAuthManager();
                $roles = $authManager->getRolesByUser(\backend\base\Utility::getUserId());
                if (\common\modules\rbac\components\Helper::checkRoute('main/switch-language')) {
            ?>
                    <li class="dropdown notifications-menu" style="font-style: normal;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?= Yii::t('default', 'Select Languages') ?>
                        </a>
                        <ul class="dropdown-menu" style="width: 60px;">
                            <li>
                                <ul class="menu">
                                    <?
                                    foreach (\backend\base\Utility::getSupportLanguage() as $code => $name) {

                                        ?>
                                        <li>
                                            <a href="<?= \yii\helpers\Url::toRoute(['/main/switch-language', 'locale' => $code]) ?>">
                                                <?= $name ?>
                                            </a>
                                        </li>
                                        <?
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
            <?
                }
            ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= $directoryAsset ?>/img/avatar.png" class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="height: 100%;">
                                <img src="<?= $directoryAsset ?>/img/avatar.png" class="img-circle"
                                     alt="User Image"/>
                                <p>
                                    <?
                                    foreach ($roles as $name => $v) {
                                        echo $name . '<br/>';
                                    }
                                    ?>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <?
                                    if (\common\modules\rbac\components\Helper::checkRoute('password/change-password')) {
                                        ?>
                                        <a href="<?= \yii\helpers\Url::toRoute(['/password/change-password']) ?>"
                                           class="btn btn-default btn-flat"><?= Yii::t('default', 'Reset Password') ?></a>
                                        <?
                                    }
                                    ?>
                                </div>
                                <div class="pull-right">
                                    <?= Html::a(
                                        Yii::t('default', 'Sign Out'),
                                        ['/main/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                    ) ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                <?
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
