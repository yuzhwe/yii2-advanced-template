<?php
namespace backend\controllers;

use backend\base\Constants;
use backend\base\Utility;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * 基类控制器
 *
 * @package backend\controllers
 */
class BaseController extends Controller
{

    /**
     * 初始化
     */
    public function init() {
        parent::init();

        // 设置语言
        $currentLanguage = Utility::getCookie(Constants::COOKIE_NAME_USER_LANGUAGE);
        $supportLanguage = Utility::getSupportLanguage();
        if(isset($currentLanguage['code']) && isset($supportLanguage[$currentLanguage['code']]))
        {
            \Yii::$app->language = $currentLanguage['code'];
        } else {
            \Yii::$app->language = Utility::lang();
        }
        // 设置应用名称
        Yii::$app->name = Yii::t('default', 'Title');
        
    }

    /**
     * 重定向
     * @param string $url
     * @return \yii\web\Response
     */
    public function redirectUri($url = '')
    {
        if(Yii::$app->getRequest()->get('redirect')) {
            return $this->redirect(Yii::$app->getRequest()->get('redirect'));
        } else {
            return $this->redirect($url);
        }
    }

    /**
     * 可编辑列ajax提交保存
     * @param $modelClassName
     */
    public function saveSingleColumnValue($modelClassName) {
        /** @var $model \common\models\BaseActiveRecord */

        if (Yii::$app->request->post('hasEditable')) {
            $model = new $modelClassName;
            $modelClassName = substr($modelClassName, strripos($modelClassName, '\\') + 1);

            $posted = current($_POST[$modelClassName]);
            if ($posted) {
                $model->updateAll($posted, ['id' => $_POST['editableKey']]);
            }
            echo Json::encode(['output'=>'', 'message'=>'']);;
            exit;
        }
    }
}
