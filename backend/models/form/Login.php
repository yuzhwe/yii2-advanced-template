<?php
namespace backend\models\form;

use common\models\User;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Login extends Model
{
    public $username;
    public $password;
    public $verifyCode;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
//            [['username', 'password','verifyCode'], 'required'],
            [['username', 'verifyCode'], 'trim'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            ['verifyCode', 'captcha', 'captchaAction' => 'main/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('default', 'Username'),
            'password' => Yii::t('default', 'Password'),
            'verifyCode' => Yii::t('default', 'Captcha'),
            'rememberMe' => Yii::t('default', 'Remember Me'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if(!$user && $user['status'] == User::STATUS_INACTIVE) {
                $this->addError($attribute, Yii::t('default', 'User login has been disabled.'));
            }
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('default', 'Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername(strtolower($this->username));
        }

        return $this->_user;
    }
}
