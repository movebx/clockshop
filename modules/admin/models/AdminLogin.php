<?php

namespace app\modules\admin\models;

use app\modules\admin\identity\Admin;
use yii\base\Model;

class AdminLogin extends Model
{
    const DEFAULT_ADMIN = 'marinka';

    public $login;
    public $password;

    protected $admin;

    public function rules()
    {
        return [
            [['login', 'password'], 'required'],

        ];
    }

    public function validateData()
    {
        $this->admin = Admin::findByLogin(self::DEFAULT_ADMIN);

        if($this->login === $this->admin->login)
            if($this->password === $this->admin->password)
                return true;

        return false;
    }

    public function login()
    {
        \Yii::$app->user->login($this->admin);
    }


}