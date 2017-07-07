<?php
namespace backend\controllers;

use backend\base\Constants;
use backend\base\Utility;
use common\models\User;
use Yii;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * 主控制器
 *
 * @package backend\controllers
 */
class MainController extends BaseController
{

    public function actions()
    {
        return [
            // 配置验证码
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    /**
     * 首页
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 登录
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new \backend\models\form\Login();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 退出登录
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goBack();
    }

    /**
     * 选择语言
     */
    public function actionSwitchLanguage()
    {
        $locale = Yii::$app->request->get('locale');
        $supportLanguage = Utility::getSupportLanguage();

        if(isset($supportLanguage[$locale]))
        {
            $languages['code'] = $locale;
            $languages['name'] = $supportLanguage[$locale];
            $languages['switch'] = 1;
            Utility::setCookie(Constants::COOKIE_NAME_USER_LANGUAGE, $languages);
            \Yii::$app->language = $locale;
        }
        \Yii::$app->response->redirect(Url::toRoute('/main/index'));
    }

}
