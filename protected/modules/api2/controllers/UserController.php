<?php

namespace app\modules\api2\controllers;

use app\models\LoginForm;
use app\models\User;
use app\modules\api2\components\ApiTxController;
use Yii;
use app\modules\api2\models\DeviceDetail;
use app\models\Halogins;
use yii\filters\AccessControl;
use yii\filters\AccessRule;

/**
 * UserController implements the API actions for User model.
 */
class UserController extends ApiTxController
{

    public function behaviors()
    {
        $unAuthorize = [
            'login',
            'signup',
            'recover',
            'social-login'
        ];

        $optional = [];

        $behaviors = parent::behaviors();
        $behaviors['authenticator']['optional'] = $optional;
        $behaviors['authenticator']['except'] = $unAuthorize;
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'ruleConfig' => [
                'class' => AccessRule::className()
            ],
            'rules' => [
                [
                    'actions' => [
                        'check',
                        'update',
                        'delete',
                        'logout',
                        'change-password'
                    ],
                    'allow' => true,
                    'matchCallback' => function () {
                        return User::isUser();
                    }
                ],

                [
                    'actions' => $optional,
                    'allow' => true,
                    'roles' => [
                        '?',
                        '*',
                        '@'
                    ]
                ],

                [
                    'actions' => $unAuthorize,
                    'allow' => true,
                    'roles' => [
                        '?',
                        '*'
                    ]
                ]
            ],
            'denyCallback' => function ($rule, $action) {
                throw new \yii\web\ForbiddenHttpException(\Yii::t('app', 'You are not allowed to access this page'));
            }
        ];

        return $behaviors;
    }

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['get'] = [
            'GET'
        ];
        return $verbs;
    }

    public function actionTestttt()
    {
        $data = [
            'dsadd' => 'sddf'
        ];
        $this->response = $data;
    }

    /**
     * Displays a single User model.
     *
     * @return mixed
     */
    public function actionGet($id)
    {
        $this->modelClass = "app\models\User";
        return $this->txget($id);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionAdd()
    {
        $this->modelClass = "app\models\User";
        return $this->txSave();
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $data = [];
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

            if ($model->save()) {
                $this->setStatus(200);
                $data['detail'] = $model;
            } else {
                $data['message'] = $model->flattenErrors;
            }
        } else {
            $data['message'] = 'No Data Posted';
        }
        $this->response = $data;
    }

    public function actionSignup()
    {
        $data = [];
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $email_identify = User::findByUsername($model->email);
            if (empty($email_identify)) {
                $model->setPassword($model->password);
                if ($model->save()) {
                    $this->setStatus(200);
                    $data['detail'] = $model->asJson();
                } else {
                    $data['message'] = $model->getErrorsString();
                }
            } else {
                $data['message'] = \yii::t('app', "Email already exists.");
            }
        } else {
            $data['message'] = "Data not posted.";
        }
        $this->response = $data;
    }

    public function actionCheck()
    {
        $data = [];
        $deviceToken = DeviceDetail::find()->where([
            'created_by_id' => \Yii::$app->user->id
        ])->one();
        if (! empty($deviceToken)) {

            if ($deviceToken->load(Yii::$app->request->post())) {
                if ($deviceToken->save()) {
                    $this->setStatus(200);
                } else {
                    $data['message'] = $deviceToken->getErrorString;
                }
            } else {
                $data['message'] = \yii::t('app', "No data posted");
            }
        } else {
            $data['message'] = \yii::t('app', "No device token found");
        }

        $this->response = $data;
    }

    /**
     *
     * @return string|string[]|NULL[]
     */
    public function actionLogin()
    {
        $data = [];
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            $user = User::findByUsername($model->username);
            if ($user) {
                if ($model->login()) {
                    $user->generateAccessToken();
                    $user->save(false, [
                        'access_token'
                    ]);
                    $this->setStatus(200);
                    $data['access-token'] = $user->access_token;
                    (new DeviceDetail())->appData($model);
                    $data['detail'] = $model->asJson();
                    $data['user_detail'] = $user->asJson();
                } else {
                    $data['message'] = $model->getErrorsString();
                }
            } else {
                $data['message'] = ' Incorrect Username';
            }
        } else {
            $data['message'] = "No data posted.";
        }
        $this->response = $data;
    }

    public function actionLogout()
    {
        $data = [];
        $user = \Yii::$app->user->identity;
        if (\Yii::$app->user->logout()) {
            $user->access_token = '';
            $user->save(false, [
                'access_token'
            ]);
            (new DeviceDetail())->deleteOldAppData($user->id);
            $this->setStatus(200);
        }

        $this->response = $data;
    }

    public function actionChangePassword()
    {
        $data = [];

        $model = User::findOne([
            'id' => \Yii::$app->user->identity->id
        ]);

        $newModel = new User([
            'scenario' => 'changepassword'
        ]);
        if ($newModel->load(Yii::$app->request->post()) && $newModel->validate()) {
            if ($model->validatePassword($newModel->oldPassword)) {
                $model->setPassword($newModel->newPassword);
                if ($model->save()) {
                    $this->setStatus(200);
                } else {
                    $data['message'] = 'Incorrect Password';
                }
            } else {
                $data['message'] = ' Old password is incorrect';
            }
        }
        $this->response = $data;
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        return $this->txDelete($id, "User");
    }

    /**
     * Social Login.
     *
     * @return mixed
     */
    public function actionSocialLogin()
    {
        $flag = false;
        $data = [];
        $params = \Yii::$app->request->getBodyParams();
        if (! empty($params['User'])) {
            $auth = Halogins::find()->where([
                'userId' => $params['User']['userId']
            ])->one();

            if (empty($auth)) { // not exist
                if ((! empty($params['User']['email']) && ! empty($params['User']['userId']))) {
                    $contact_no = $params['User']['contact_no'];
                    $email = $params['User']['email'];
                    $password = $params['User']['password'];
                    $address = $params['User']['address'];
                    $address_line = $params['User']['address_line'];
                    $firstname = $params['User']['first_name'];
                    $lastname = $params['User']['last_name'];
                    $username = $params['User']['username'];
                    $country = $params['User']['country'];
                    $zipcode = $params['User']['zipcode'];
                    $date_of_birth = $params['User']['date_of_birth'];
                    $state = $params['User']['state'];
                    $city = $params['User']['city'];
                    $id = $params['User']['userId'];
                    $provider = $params['User']['provider'];
                    $token = $params['LoginForm']['device_token'];
                    $type = $params['LoginForm']['device_type'];
                    $device_name = $params['LoginForm']['device_name'];
                    $email_identify = '';
                    $contact_identify = '';
                    $transaction = \Yii::$app->db->beginTransaction();
                    $email_identify = User::findByUsername($email);
                    $password = (new User())->hashPassword($id);
                    if (! empty($email_identify)) {
                        $user = $email_identify;
                    } else {
                        $user = new User([
                            'contact_no' => $contact_no,
                            'email' => $email,
                            'username' => $username,
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'country' => $country,
                            'state' => $state,
                            'city' => $city,
                            'zipcode' => $zipcode,
                            'password' => $password,
                            'created_on' => date('Y-m-d H:i:s'),
                            'date_of_birth' => $date_of_birth,
                            'address' => $address,
                            'address_line' => $address_line,
                            'role_id' => User::ROLE_USER
                        ]);
                        if (! empty($params['img_url'])) {
                            $random = rand(0, 999) . 'dummy_img.png';
                            $user->profile_file = $random;
                            copy($params['img_url'], UPLOAD_PATH . $random);
                        }
                        $user->state_id = User::STATE_ACTIVE;
                    }
                    $user->generatePasswordResetToken();

                    $user->first_name = $firstname;
                    $user->last_name = $lastname;
                    if (! $user->save()) {

                        $data['message'] = $user->getErrorsString();
                        $data['customError'] = \Yii::t('app', "user entry");
                        return $this->response = $data;
                    } else {
                        $user->generateAccessToken();
                        $flag = true;
                    }
                    $auth = new Halogins([
                        'userId' => (string) $id,
                        'loginProvider' => $provider,
                        'loginProviderIdentifier' => md5($id),
                        'user_id' => $user->id
                    ]);
                    if (! $auth->save()) {
                        $data['customError'] = "auth entry";
                        $data['message'] = $auth->getErrorsString();
                        return $this->response = $data;
                    } else {
                        $flag = true;
                    }
                    $login_form = new LoginForm();
                    if (! $login_form->load(\Yii::$app->request->post())) {
                        $data['customError'] = \Yii::t('app', "post banned");
                        $data['message'] = \Yii::t('app', "Data required for login can not be blank");
                        return $this->response = $data;
                    } else {

                        $flag = true;
                    }
                    if ($flag) {

                        $transaction->commit();
                        $login_form->username = $username;
                        $login_form->password = $id;
                        if ($login_form->login()) {

                            (new DeviceDetail())->appData($login_form);
                            $data['access-token'] = $user->access_token;
                            $data['is_login'] = "0";
                            $this->setStatus(200);
                            $data['detail'] = $user->asJson();
                            $data['message'] = \yii::t('app', 'Signup');
                        }
                    } else {

                        $transaction->rollBack();
                    }
                } else {
                    $data['message'] = \yii::t('app', 'Please fill all the Details');
                    return $this->response = $data;
                }
            } else { // already exist
                $user_model = User::findOne([
                    'id' => $auth->user_id
                ]);
                if ($user_model->state_id == User::STATE_BANNED) {
                    $data['customError'] = \Yii::t('app', "banned");
                    $data['message'] = \Yii::t('app', 'Your account is blocked, Please contact Particulars Admin');
                    return $this->response = $data;
                }
                if ($user_model->state_id == User::STATE_INACTIVE) {
                    $data['customError'] = \Yii::t('app', "inactive");
                    $data['message'] = yii::t('app', 'Your account is not verified by admin');
                    $data['id'] = $user_model->id;
                    return $this->response = $data;
                }
                $user = $auth->user;
                if (empty($user_model)) {
                    $data['customError'] = \Yii::t('app', "not found");
                    $data['message'] = \Yii::t('app', "User not found");
                    return $this->response = $data;
                }
                $login_form = new LoginForm();
                $login_form->username = $user->email;
                $login_form->password = $user->password;
                if (! $login_form->load(\Yii::$app->request->post())) {
                    $data['customError'] = \Yii::t('app', "post banned");
                    $data['message'] = \Yii::t('app', "Data required for login can not be blank");
                    return $this->response = $data;
                }
                if (\Yii::$app->user->login($user, 3600 * 24 * 30)) {
                    $user_model->generateAccessToken();
                    if ($user_model->save()) {
                        (new DeviceDetail())->appData($login_form);
                        $data['is_login'] = "1";
                        $data['detail'] = $user_model->asJson();
                        $data['success'] = yii::t('app', 'Login Successfully');
                        $this->setStatus(200);
                        $data['access-token'] = $user_model->access_token;
                    }
                }
            }
        } else {
            $data['message'] = 'No data posted';
        }
        $this->response = $data;
    }
}
