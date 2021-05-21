<?php


namespace app\modules\api2\components;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\Inflector;
use yii\rest\ActiveController;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;

abstract class ApiTxController extends ActiveController
{

    /*
     * public static $httpStatuses = [
     * 100 => 'Continue',
     * 101 => 'Switching Protocols',
     * 102 => 'Processing',
     * 118 => 'Connection timed out',
     * 200 => 'OK',
     * 201 => 'Created',
     * 202 => 'Accepted',
     * 203 => 'Non-Authoritative',
     * 204 => 'No Content',
     * 205 => 'Reset Content',
     * 206 => 'Partial Content',
     * 207 => 'Multi-Status',
     * 208 => 'Already Reported',
     * 210 => 'Content Different',
     * 226 => 'IM Used',
     * 300 => 'Multiple Choices',
     * 301 => 'Moved Permanently',
     * 302 => 'Found',
     * 303 => 'See Other',
     * 304 => 'Not Modified',
     * 305 => 'Use Proxy',
     * 306 => 'Reserved',
     * 307 => 'Temporary Redirect',
     * 308 => 'Permanent Redirect',
     * 310 => 'Too many Redirect',
     * 400 => 'Bad Request',
     * 401 => 'Unauthorized',
     * 402 => 'Payment Required',
     * 403 => 'Forbidden',
     * 404 => 'Not Found',
     * 405 => 'Method Not Allowed',
     * 406 => 'Not Acceptable',
     * 407 => 'Proxy Authentication Required',
     * 408 => 'Request Time-out',
     * 409 => 'Conflict',
     * 410 => 'Gone',
     * 411 => 'Length Required',
     * 412 => 'Precondition Failed',
     * 413 => 'Request Entity Too Large',
     * 414 => 'Request-URI Too Long',
     * 415 => 'Unsupported Media Type',
     * 416 => 'Requested range unsatisfiable',
     * 417 => 'Expectation failed',
     * 418 => 'I\'m a teapot',
     * 421 => 'Misdirected Request',
     * 422 => 'Unprocessable entity',
     * 423 => 'Locked',
     * 424 => 'Method failure',
     * 425 => 'Unordered Collection',
     * 426 => 'Upgrade Required',
     * 428 => 'Precondition Required',
     * 429 => 'Too Many Requests',
     * 431 => 'Request Header Fields Too Large',
     * 449 => 'Retry With',
     * 450 => 'Blocked by Windows Parental Controls',
     * 451 => 'Unavailable For Legal Reasons',
     * 500 => 'Internal Server Error',
     * 501 => 'Not Implemented',
     * 502 => 'Bad Gateway or Proxy Error',
     * 503 => 'Service Unavailable',
     * 504 => 'Gateway Time-out',
     * 505 => 'HTTP Version not supported',
     * 507 => 'Insufficient storage',
     * 508 => 'Loop Detected',
     * 509 => 'Bandwidth Limit Exceeded',
     * 510 => 'Not Extended',
     * 511 => 'Network Authentication Required'
     * ];
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON
                // 'application/xml' => Response::FORMAT_XML,
            ]
        ];

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => [
                'index'
            ],
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(), // param : Authorization : Bearer L7b9G9n_jbw3oj8-G1X_t-Jg2FUNMcm1
                QueryParamAuth::className() // param : access-token
            ]
        ];

        /* For Projects like Angular,React or any frontend framework uncomment below code */
        /*
         * $behaviors['corsFilter'] = [
         *
         * 'class' => Cors::className(), // the new Cors class inherited from yii2's
         *
         * 'cors' => [
         *
         * 'Origin' => ['*'],
         *
         * 'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
         *
         * 'Access-Control-Request-Headers' => ['Origin', 'X-Requested-With', 'Content-Type', 'accept', 'Authorization'],
         *
         * ],
         *
         * ];
         */

        /*
         * $behaviors['verbFilter'] = [
         * 'class' => VerbFilter::className(),
         * 'actions' => $this->verbs()
         * ];
         */

        /*
         * $behaviors['rateLimiter'] = [
         * 'class' => \yii\filters\RateLimiter::className(),
         * ];
         */

        return $behaviors;
    }

    /* Declare actions supported by APIs (Added in api/modules/v1/components/controller.php too) */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    /* Declare methods supported by APIs */
    protected function verbs()
    {
        return [
            'create' => [
                'POST'
            ],
            'update' => [
                'PUT',
                'PATCH',
                'POST'
            ],
            'delete' => [
                'DELETE'
            ],
            'view' => [
                'GET'
            ],
            'index' => [
                'GET'
            ]
        ];
    }

    // For Pagination
    public $modelClass = '';

    protected $response = [];

    public function beforeAction($action)
    {
        /* Setting default status if status is not set to 200 by api */
        $this->setStatus(400);
        $accessTokenCheck = isset($_GET['access-token']) && empty(Yii::$app->request->get('access-token')) ? false : true;
        if ($accessTokenCheck === false) {
            Yii::$app->response->format = "json";
            $this->setStatus(401);
            return $this->handleFailure($this->response);
        }

        return parent::beforeAction($action);
    }

    public function setStatus($status_code, $status_message = null)
    {
        \Yii::$app->response->setStatusCode($status_code, trim(preg_replace('/\s\s+/', ' ', $status_message)));
    }

    public function afterAction($action, $result)
    {
        $this->response['datecheck'] = ! empty(DATECHECK) ? DATECHECK : null;

        \Yii::$app->response->data = $this->response;
        return parent::afterAction($action, $result);
    }

    public function txDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->delete()) {
            $this->setStatus(200);
            $data['message'] = $this->modelClass . ' is deleted Successfully.';
        }
        $this->response = $data;
    }

    public function txSave($fileAttributes = [])
    {
        $model = new $this->modelClass();
        if ($model->load(Yii::$app->request->post())) {
            foreach ($fileAttributes as $file) {
                $model->saveUploadedFile($model, $file);
            }
            if ($model->save()) {
                $this->setStatus(200);
                $data['detail'] = $model;
            } else {
                $err = '';
                foreach ($model->getErrors() as $error) {
                    $err .= implode(',', $error);
                }
                $data['message'] = $err;
            }
        }
        $this->response = $data;
    }

    public function txGet($id)
    {
        $model = $this->findModel($id);
        $data['detail'] = $model->asJson();
        $this->setStatus(200);
        $this->response = $data;
    }

    public function txIndex()
    {
        $model = new $this->modelClass();
        $dataProvider = $model->search(\Yii::$app->request->queryParams);
        $data = (new TPagination())->serialize($dataProvider);
        $this->setStatus(200);
        $this->response = $data;
    }

    protected function findModel($id)
    {
        $modelClass = Inflector::id2camel(\Yii::$app->controller->id);
        $modelClass = 'app\models\\' . $modelClass;
        if (($model = $modelClass::findOne($id)) !== null) {
            if (! ($model->isAllowed()))
                throw new HttpException(403, Yii::t('app', 'You are not allowed to access this page.'));
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
