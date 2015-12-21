<?php


namespace app\modules\admin\identity;

use yii\base\Model;

class Admin extends Model implements \yii\web\IdentityInterface
{
    public $id;
    public $login;
    public $email;
    public $password;
    public $auth_key;
    public $access_token;

    static protected $admins = [
        '1' => [
            'id' => '1',
            'login' => 'marinka',
            'email' => 'zalupa@yandex.ua',
            'password' => 'mirana1111',
            'auth_key' => '',
            'access_token' => '',
        ]
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::$admins[$id]) ? new static(self::$admins[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$admins as $admin) {
            if ($admin['access_token'] === $token) {
                return new static($admin);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string $login
     * @return static|null
     */
    public static function findByLogin($login)
    {
        foreach (self::$admins as $admin) {
            if (strcasecmp($admin['login'], $login) === 0) {
                return new static($admin);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}