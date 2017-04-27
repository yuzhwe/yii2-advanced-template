<?php
namespace backend\base;

use common\models\User;
use common\modules\rbac\components\Helper;
use yii\helpers\Url;
use Yii;

class Utility {

    public static function getYesNoText() {
        return [1 => Yii::t('default', 'Yes'), 0 => Yii::t('default', 'No')];
    }

    public static function getUserStatusText() {
        return [User::STATUS_ACTIVE => Yii::t('default', 'Normal'), User::STATUS_INACTIVE => Yii::t('default', 'Disabled')];
    }

    public static function getUserStatusTextByKey($key) {
        $data = self::getUserStatusText();
        return isset($data[$key]) ? $data[$key] : '';
    }

    public static function getStatusText() {
        return [1 => Yii::t('default', 'Normal'), 0 => Yii::t('default', 'Disabled')];
    }

    public static function getStatusTextByKey($key) {
        $data = self::getStatusText();
        return isset($data[$key]) ? $data[$key] : '';
    }

    public static function getUserId()
    {
        if(Yii::$app->user->isGuest) {
            return 0;
        }
        return Yii::$app->user->identity->id;
    }

    public static function getIp($type = 0)
    {
        $type = $type ? 1 : 0;
        static $ip = NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) unset($arr[$pos]);
            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $long = sprintf("%u", ip2long($ip));
        $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }

    public static function getCacheKey($method = null)
    {
        is_null($method) && $method = __METHOD__;
        return md5($method);
    }

    public static function setCache($key, $value, $duration = 300) {
        if(!YII_DEBUG) {
            Yii::$app->cache->set($key, $value, $duration);
        }
    }

    public static function getSupportLanguage()
    {
        return [
            'zh-CN' => '简体中文',
            'zh-TW' => '繁体中文',
            'en' => 'English'
        ];
    }

    public static function setCookie($name, $value, $expire = 7200)
    {
        $cookie = new \yii\web\Cookie();
        $cookie->name = $name;
        $cookie->value = $value;
        $cookie->expire = time() + $expire;
        \Yii::$app->response->cookies->add($cookie);
    }

    public static function getCookie($name)
    {
        return \Yii::$app->request->cookies->getValue($name);
    }

    public static function lang()
    {
        static $lang;

        if(!$lang){
            if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
                $fullLang = strtolower(explode(';', $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0]);
            }else{
                $fullLang = 'en';
            }
            $lang = substr($fullLang, 0, 2);
            switch($lang){
                case 'zh':
                    $lang = explode(',', $fullLang)[0];
                    if($lang == 'zh' || strpos($lang, 'cn') !== false){
                        $lang = 'zh-CN';
                    }else{
                        $lang = 'zh-TW';
                    }
                    break;
            }
        }

        return $lang;
    }
}