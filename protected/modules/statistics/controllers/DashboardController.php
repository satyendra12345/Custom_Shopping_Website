<?php
namespace app\modules\statistics\controllers;

use app\modules\statistics\models\Statistics;
use app\modules\statistics\models\Visitor;
use yii\filters\AccessControl;
use app\components\TController;
use app\models\User;
use app\components\filters\AccessRule;

/**
 * Default controller for the `statistics` module
 */
class DashboardController extends TController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className()
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'update',
                            'delete',
                            'home'
                        ],
                        'allow' => true,
                        'matchCallback' => function () {
                            return User::isAdmin();
                        }
                    ]
                ]
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'delete' => [
                        'post'
                    ]
                ]
            ]
        ];
    }

    public function actionHome()
    {
        $visitors = new Visitor();
        return $this->render('home', [
            'visitorsModel' => $visitors,
            'visitors' => $visitors->lastVisitors(),
            'chart' => $visitors->chart()
        ]);
    }

    /**
     * Renders the index view for the module
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Statistics();
        $visitors = new Visitor();

        return $this->render('index', [
            'model' => $model,
            'pie_chart' => $visitors->pie_chart(),
            'visit_period' => $visitors->visit_period()
        ]);
    }
}
