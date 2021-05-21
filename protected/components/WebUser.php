<?php

namespace app\components;

use Yii;
use app\models\User;
use yii\helpers\VarDumper;

class WebUser extends \yii\web\User
{

    public $_modeAdmin = false;

    public $authKeyParam = '__key';

    public $enableAutoLogin = true;

    public $identityClass = 'app\models\User';

    public $loginUrl = [
        '/user/login'
    ];

    public $authTimeout = 86400;

    public function init()
    {
        parent::init();
        $cookiePath = '/';
        $path = \Yii::$app->request->baseUrl;
        if (! empty($path)) {
            $cookiePath = $path;
        }
        $this->identityCookie['name'] = '_user_' . \Yii::$app->id;
        $this->identityCookie['path'] = $cookiePath;
    }

    public function afterLogin($identity, $cookieBased, $duration)
    {
        $identity->last_visit_time = date('Y-m-d H:i:s');
        $identity->updateAttributes([
            'last_visit_time'
        ]);
        $this->setIsAdminMode();
        return parent::afterLogin($identity, $cookieBased, $duration);
    }

    public function afterLogout($identity)
    {
        // $this->cleanupCookies();
    }

    public function getIsAdminMode()
    {
        $this->_modeAdmin = \Yii::$app->session->get('ADMIN_MODE', false);
        return $this->_modeAdmin;
    }

    public function setIsAdminMode($mode = false)
    {
        $this->_modeAdmin = $mode;
        \Yii::$app->session->set('ADMIN_MODE', $mode);
    }

    public function cleanupCookies()
    {
        $past = time() - 3600;
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, false, $past, '/');
        }
    }

    public function can($permissionName, $params = [], $allowCaching = true)
    {
        return parent::can($permissionName, $params, $allowCaching);
    }

    public function canRoute($module, $route = null, $allowCaching = true, $defaultValue)
    {
        if (($accessChecker = $this->getAuthAccessChecker()) === false) {
            return $defaultValue;
        }

        return $accessChecker->canRoute($module, $route, $allowCaching, $defaultValue);
    }

    public function getAuthAccessChecker()
    {
        if (($accessChecker = $this->getAccessChecker()) === null) {
            return false;
        }

        return $accessChecker;
    }

    public function switchIdentity($identity, $duration = 0)
    {
        parent::switchIdentity($identity, $duration);

        if ($identity) {
            $session = Yii::$app->getSession();
            $session->set($this->authKeyParam, $identity->getAuthKey());
        }
    }

    protected function renewAuthStatus()
    {
        $session = Yii::$app->getSession();
        $id = $session->getHasSessionId() || $session->getIsActive() ? $session->get($this->idParam) : null;

        if ($id === null) {
            $identity = null;
        } else {
            /* @var $class User */
            $class = $this->identityClass;
            $identity = $class::findIdentity($id);
        }

        $this->setIdentity($identity);

        if ($identity !== null && ($this->authTimeout !== null || $this->absoluteAuthTimeout !== null)) {
            $expire = $this->authTimeout !== null ? $session->get($this->authTimeoutParam) : null;
            $expireAbsolute = $this->absoluteAuthTimeout !== null ? $session->get($this->absoluteAuthTimeoutParam) : null;
            if ($expire !== null && $expire < time() || $expireAbsolute !== null && $expireAbsolute < time()) {
                $this->logout(false);
            } elseif ($this->authTimeout !== null) {
                $session->set($this->authTimeoutParam, time() + $this->authTimeout);
            }
        }

        if ($this->enableAutoLogin) {
            if ($this->getIsGuest()) {
                $this->loginByCookie();
            } elseif ($this->autoRenewCookie) {

                $id = Yii::$app->session->get("shadow");

                if ($id != null) {
                    $this->renewIdentityCookie();
                    Yii::info("User $id succeeded shadow in progress");
                    return;
                }

                $this->renewIdentityCookie();
                Yii::info("User $id succeeded authKey validation");
            }
        }

        if ($identity !== null) {
            $authKey = $session->get($this->authKeyParam);

            if ($authKey !== null && ! $identity->validateAuthKey($authKey)) {
                $this->logout();
                Yii::info("User $id failed authKey validation");
            }
        }
    }

    public function getUserName()
    {
        if ($this->isGuest) {
            return 'Guest';
        }
        return $this->identity;
    }
}