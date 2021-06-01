<?php

/**

 *@copyright : Satyendra Pandey

 *@author	 : Satyendra Pandey  < pandeysatyendra870@gmail.com >

 *

 * All Rights Reserved.

 * Proprietary and confidential :  All information contained herein is, and remains

 * the property of Satyendra Pandey  and his partners.

 * Unauthorized copying of this file, via any medium is strictly prohibited.

 *

 */

namespace app\controllers;



use Yii;

use app\models\Product;


use app\models\search\Product as ProductSearch;


use app\components\TController;

use yii\web\NotFoundHttpException;

use yii\filters\AccessControl;

use yii\filters\AccessRule;

use app\models\User;

use yii\web\HttpException;

use app\components\TActiveForm;
use app\models\Cart;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**

 * ProductController implements the CRUD actions for Product model.

 */

class ProductController extends TController
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

                            'clear',

                            'delete',

                        ],

                        'allow' => true,

                        'matchCallback' => function () {

                            return User::isAdmin();
                        }

                    ],

                    [

                        'actions' => [

                            'index',

                            'add',

                            'view',

                            'update',

                            'clone',

                            'ajax',

                            'mass'

                        ],

                        'allow' => true,

                        'roles' => [

                            '@'

                        ]

                    ],

                    [

                        'actions' => [



                            'view',
                            'add-cart'

                        ],

                        'allow' => true,

                        'roles' => [

                            '?',

                            '*'

                        ]

                    ]

                ]

            ]

        ];
    }





    /**

     * Lists all Product models.

     * @return mixed

     */

    public function actionIndex()

    {


        $searchModel = new ProductSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->updateMenuItems();

        return $this->render('index', [

            'searchModel' => $searchModel,

            'dataProvider' => $dataProvider,

        ]);
    }



    /**

     * Displays a single Product model.

     * @param integer $id

     * @return mixed

     */

    public function actionView($id)

    {

        $model = $this->findModel($id);

        $this->updateMenuItems($model);

        return $this->render('view', ['model' => $model]);
    }


   
    /**

     * Creates a new Product model.

     * If creation is successful, the browser will be redirected to the 'view' page.

     * @return mixed

     */

    public function actionAdd(/* $id*/)
    {
        $model = new Product();
        $model->loadDefaultValues();
        $model->state_id = Product::STATE_ACTIVE;
        $model->checkRelatedData([
            'created_by_id' => User::class,
        ]);
        $post = \yii::$app->request->post();
        if (\yii::$app->request->isAjax && $model->load($post)) {
            \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return TActiveForm::validate($model);
        }
        if ($model->load($post)) {

           $x=  $model->saveUploadedFile($model, 'thumb_main_file');
          

            $model->image_file = UploadedFile::getInstances($model, 'image_file');
            $index = 0;
            foreach ($model->image_file as  $image_file) {
                $basepath = UPLOAD_PATH;
                $filename = time().$index .'_product.'. $image_file->extension;
                $image_file->saveAs($basepath . $filename);
                $file_array[$index] = $filename;
                $index++;
            }
            $model->image_file = json_encode($file_array);
            if ($model->save()) {
                return $this->redirect($model->getUrl());
            }
        }
        $this->updateMenuItems();
        return $this->render('add', [
            'model' => $model,
        ]);
    }



    /**

     * Updates an existing Product model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id

     * @return mixed

     */

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $flag = true;

        $post = \yii::$app->request->post();
        $old_image = $model->image_file;
        if (\yii::$app->request->isAjax && $model->load($post)) {
            \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return
                TActiveForm::validate($model);
        }

        // VarDumper::dump($post);
        // exit;
        if (empty($model->image_file)) {
            $model->image_file = $old_image;
            $flag = false;
        }
        $file_array=[];
        if ($model->load($post)) {


            if ($flag) {
                $model->image_file = UploadedFile::getInstances($model, 'image_file');
                $index = 0;
                foreach ($model->image_file as  $image_file) {
                    $basepath = UPLOAD_PATH;
                    $filename = time() .$index. '_product.' . $image_file->extension;
                    $image_file->saveAs($basepath . $filename);
                    $file_array[$index] = $filename;
                    $index++;
                }

                $model->image_file = json_encode($file_array);
            } else {
                $model->image_file = $old_image;
            }

            if ($model->save()) {
                return $this->redirect($model->getUrl());
            }
        }
        $this->updateMenuItems($model);
        return $this->render('update', [
            'model' => $model,
        ]);
    }



    /**

     * Clone an existing Product model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id

     * @return mixed

     */

    public function actionClone($id)

    {

        $old = $this->findModel($id);



        $model = new Product();

        $model->loadDefaultValues();

        $model->state_id = Product::STATE_ACTIVE;

        //$model->id  = $old->id$model->title  = $old->title$model->description  = $old->description$model->image_file  = $old->image_file$model->category_id  = $old->category_id$model->menu_id  = $old->menu_id$model->price  = $old->price//$model->state_id  = $old->state_id$model->type_id  = $old->type_id//$model->created_on  = $old->created_on$model->updated_on  = $old->updated_on//$model->created_by_id  = $old->created_by_id


        $post = \yii::$app->request->post();

        if (\yii::$app->request->isAjax && $model->load($post)) {

            \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return TActiveForm::validate($model);
        }

        if ($model->load($post) && $model->save()) {

            return $this->redirect($model->getUrl());
        }

        $this->updateMenuItems($model);

        return $this->render('update', [

            'model' => $model,

        ]);
    }



    /**

     * Deletes an existing Product model.

     * If deletion is successful, the browser will be redirected to the 'index' page.

     * @param integer $id

     * @return mixed

     */

    public function actionDelete($id)

    {

        $model = $this->findModel($id);



        if (\yii::$app->request->post()) {

            $model->delete();

            return $this->redirect(['index']);
        }

        return $this->render('delete', [

            'model' => $model,

        ]);
    }

    /**

     * Truncate an existing Product model.

     * If truncate is successful, the browser will be redirected to the 'index' page.

     * @param integer $id

     * @return mixed

     */

    public function actionClear($truncate = true)

    {

        $query = Product::find();

        foreach ($query->each() as $model) {

            $model->delete();
        }

        if ($truncate) {

            Product::truncate();
        }

        \Yii::$app->session->setFlash('success', 'Product Cleared !!!');

        return $this->redirect([

            'index'

        ]);
    }



    /**

     * Finds the Product model based on its primary key value.

     * If the model is not found, a 404 HTTP exception will be thrown.

     * @param integer $id

     * @return Product the loaded model

     * @throws NotFoundHttpException if the model cannot be found

     */

    protected function findModel($id, $accessCheck = true)

    {


        if (($model = Product::findOne($id)) !== null) {



            if ($accessCheck && !($model->isAllowed()))

                throw new HttpException(403, Yii::t('app', 'You are not allowed to access this page.'));



            return $model;
        } else {

            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function updateMenuItems($model = null)

    {

        switch (\Yii::$app->controller->action->id) {



            case 'add': {

                    $this->menu['manage'] = [

                        'label' => '<span class="glyphicon glyphicon-list"></span>',

                        'title' => Yii::t('app', 'Manage'),

                        'url' => [

                            'index'

                        ]

                        // 'visible' => User::isAdmin ()

                    ];
                }

                break;

            case 'index': {

                    $this->menu['add'] = [

                        'label' => '<span class="glyphicon glyphicon-plus"></span>',

                        'title' => Yii::t('app', 'Add'),

                        'url' => [

                            'add'

                        ]

                        // 'visible' => User::isAdmin ()

                    ];

                    $this->menu['clear'] = [

                        'label' => '<span class="glyphicon glyphicon-remove"></span>',

                        'title' => Yii::t('app', 'Clear'),

                        'url' => [

                            'clear'

                        ],

                        'htmlOptions' => [

                            'data-confirm' => "Are you sure to delete these items?"

                        ],

                        'visible' => User::isAdmin()

                    ];
                }

                break;

            case 'update': {

                    $this->menu['add'] = [

                        'label' => '<span class="glyphicon glyphicon-plus"></span>',

                        'title' => Yii::t('app', 'add'),

                        'url' => [

                            'add'

                        ]

                        // 'visible' => User::isAdmin ()

                    ];

                    $this->menu['manage'] = [

                        'label' => '<span class="glyphicon glyphicon-list"></span>',

                        'title' => Yii::t('app', 'Manage'),

                        'url' => [

                            'index'

                        ]

                        // 'visible' => User::isAdmin ()

                    ];
                }

                break;



            default:

            case 'view': {

                    $this->menu['manage'] = [

                        'label' => '<span class="glyphicon glyphicon-list"></span>',

                        'title' => Yii::t('app', 'Manage'),

                        'url' => [

                            'index'

                        ]

                        // 'visible' => User::isAdmin ()

                    ];

                    if ($model != null) {

                        $this->menu['clone'] = array(

                            'label' => '<span class="glyphicon glyphicon-copy">Clone</span>',

                            'title' => Yii::t('app', 'Clone'),

                            'url' => $model->getUrl('clone'),

                            // 'visible' => User::isAdmin ()

                        );

                        $this->menu['update'] = [

                            'label' => '<span class="glyphicon glyphicon-pencil"></span>',

                            'title' => Yii::t('app', 'Update'),

                            'url' => $model->getUrl('update')

                            // 'visible' => User::isAdmin ()

                        ];

                        $this->menu['delete'] = [

                            'label' => '<span class="glyphicon glyphicon-trash"></span>',

                            'title' => Yii::t('app', 'Delete'),

                            'url' => $model->getUrl('delete')

                            // 'visible' => User::isAdmin ()

                        ];
                    }
                }
        }
    }
}
