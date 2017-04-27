<?php
namespace backend\models\form;

use backend\base\Utility;
use common\models\User;
use Yii;
use yii\base\Model;

class ChangePassword extends Model
{

    public $currentPassword;
    public $newPassword;
    public $confirmPassword;

    public function rules()
    {
        return [
            [['currentPassword', 'newPassword', 'confirmPassword'], 'required'],
            [['currentPassword', 'newPassword', 'confirmPassword'], 'string'],
            [['currentPassword'], 'string', 'min' => 4],
            [['newPassword', 'confirmPassword'], 'string', 'min' => 6],
            [['newPassword', 'confirmPassword'], 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d!@#$%^&*-_=.()+\/?\|,\{\}\[\]\'":;<>`~]{8,20}$/', 'message' => \Yii::t('default', 'Password must be contain uppercase and lowercase letters and numbers of minimum 8 and maximum 20 valid characters.')],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => Yii::t('default', 'Password'),
            'newPassword' => Yii::t('default', 'New Password'),
            'confirmPassword' => Yii::t('default', 'Confirm Password'),
        ];
    }

    public function updatePassword()
    {
        if ($this->validate()) {

            $user = User::findOne(Utility::getUserId());
            if($this->newPassword != $this->confirmPassword) {
                $this->addError('confirmPassword', Yii::t('default', 'The new password and confirm password is not the same'));
                return false;
            }
            if($this->newPassword == $this->currentPassword) {
                $this->addError('confirmPassword', Yii::t('default', 'The new password and current password cannot be the same'));
                return false;
            }

            if(!$user->validatePassword($this->currentPassword)){
                $this->addError('currentPassword', Yii::t('default', 'The current password is wrong'));
                return false;
            }

            $user->setPassword($this->confirmPassword);
            if(
                User::updateAll(
                    [
                        'password_hash' => $user->password_hash,
                    ],
                    ['id' => Utility::getUserId()]
                )
            ){
                return true;
            }else
                return false;
        }

        return false;
    }

}