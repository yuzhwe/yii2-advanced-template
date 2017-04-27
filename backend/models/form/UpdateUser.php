<?php
namespace backend\models\form;

use Yii;
use common\models\User;
use yii\base\Model;

class UpdateUser extends User
{
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],

            [ 'password', 'string', 'min' => 8, 'max' => 16 ],
            [['password'], 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*-_=.()+\/?\|,\{\}\[\]\'":;<>`~]{8,20}$/', 'message' => \Yii::t('default', 'Password must be contain uppercase and lowercase letters and numbers of minimum 8 and maximum 20 valid characters.')],


            [ 'status', 'default', 'value' => User::STATUS_ACTIVE],
            [ 'status', 'in', 'range' => [User::STATUS_ACTIVE, User::STATUS_INACTIVE]],

        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('default', 'Username'),
            'password' => Yii::t('default', 'Password'),
            'email' => Yii::t('default', 'Email'),
            'status' => Yii::t('default', 'Status'),
        ];
    }

    public function change()
    {
        if ($this->validate()) {
            $user = $this;

            $user->updated_at = time();
            $user->username = $this->username;
            $user->email = $this->email;
            $this->password && $user->setPassword($this->password);
            $user->status = $this->status;
            $user->generateAuthKey();
            $user->save();
            return $user;
        }

        return [];
    }

}
