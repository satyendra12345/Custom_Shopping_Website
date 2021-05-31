<?php

namespace app\controllers;

use app\components\TActiveForm;
use app\components\TController;
use app\models\Cart;
use app\models\Category as ModelsCategory;
use app\models\ContactForm;
use app\models\EmailQueue;
use app\models\Product;
use app\models\search\Category;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use app\modules\page\models\Page;
use bizley\contenttools\actions\UploadAction;
use bizley\contenttools\actions\InsertAction;
use bizley\contenttools\actions\RotateAction;

class SiteController extends TController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'contact',
                            'about',
                            'privacy',
                            'terms',
                            'error',
                            'content-tools-image-upload',
                            'content-tools-image-insert',
                            'content-tools-image-rotate',
                            'cart',
                            'listing',
                            'product-view',
                            'add-cart'
                        ],
                        'allow' => true,
                        'roles' => [
                            '*',
                            '@',
                            '?'
                        ]
                    ]
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null
            ],
            'content-tools-image-upload' => UploadAction::className(),
            'content-tools-image-insert' => InsertAction::className(),
            'content-tools-image-rotate' => RotateAction::className()
        ];
    }

    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        return $this->render('error', [
            'message' => $exception->getMessage(),
            'name' => 'Error'
        ]);
    }

    public function actionIndex()
    {
        $this->updateMenuItems();
        if (!\Yii::$app->user->isGuest) {
            if (User::isAdmin()) {
                $this->layout = User::LAYOUT_MAIN;
                return $this->redirect('dashboard');
            } else {
                $this->layout = User::LAYOUT_GUEST_MAIN;
                return $this->redirect('dashboard');
            }
        } else {
            $userModel = new User();
            $this->layout = User::LAYOUT_GUEST_MAIN;
            return $this->render('index', ['userModel' => $userModel]);
        }
    }


    public function actionCart()
    {
        $this->updateMenuItems();
        $this->layout = User::LAYOUT_GUEST_MAIN;
        return $this->render('cart');
    }

    public function actionListing()
    {
        $this->updateMenuItems();
        $this->layout = User::LAYOUT_GUEST_MAIN;


        return $this->render('listing');
    }

    public function actionAddCart($product_id)
    {

        $productModel = Cart::findOne($product_id);
        $category_id = $productModel['category_id'];
        $menu_id = $productModel['menu_id'];

        if (!empty(Yii::$app->user->identity)) {
            $cartModel = new Cart();
            $cartModel->created_by_id = $_SERVER['REMOTE_ADDR'];
            $cartModel->product_id = $product_id;
            if ($cartModel->save()) {
                Yii::$app->session->flash('success', 'Cart Updated Successfully');
            } else {
                Yii::$app->session->flash('danger', 'Error in Cart Adding ');
            }
        } else {
            $cartModel = new Cart();
            $cartModel->created_by_id = $_SERVER['REMOTE_ADDR'];
            $cartModel->product_id = $product_id;
            $cartModel->state_id=Product::STATE_ACTIVE;
            if ($cartModel->save(false)) {
                Yii::$app->session->setFlash('success', 'Cart Updated Successfully');
            }
            if ($cartModel->save()) {
                Yii::$app->session->setFlash('danger', 'Error in Cart Adding ');
            }
        }

        $this->updateMenuItems($cartModel);

        return  $this->render('listing',['category_id'=>$category_id,'menu_id' => $menu_id] );
    }

    public function actionProductView()
    {
        $this->updateMenuItems();
        $this->layout = User::LAYOUT_GUEST_MAIN;
        return $this->render('product_view');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return TActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $sub = 'New Contact: ' . $model->subject;
            $from = $model->email;
            $message = \yii::$app->view->renderFile('@app/mail/contact.php', [
                'user' => $model
            ]);
            EmailQueue::sendEmailToAdmins([
                'from' => $from,
                'subject' => $sub,
                'html' => $message
            ], true);
            \Yii::$app->getSession()->setFlash('success', \Yii::t('app', 'Warm Greetings!! Thank you for contacting us. We have received your request. Our representative will contact you soon.'));
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionAbout()
    {
        $this->layout = User::LAYOUT_GUEST_MAIN;
        $model = Page::find()->where([
            'type_id' => Page::TYPE_ABOUT_US
        ])->one();
        return $this->render('about', [
            'model' => $model
        ]);
    }

    public function actionPrivacy()
    {
        $this->layout = User::LAYOUT_GUEST_MAIN;
        $model = Page::find()->where([
            'type_id' => Page::TYPE_PRIVACY
        ])->one();
        return $this->render('policy', [
            'model' => $model
        ]);
    }

    public function actionTerms()
    {
        $this->layout = User::LAYOUT_GUEST_MAIN;

        $model = Page::find()->where([
            'type_id' => Page::TYPE_TERM_CONDITION
        ])->one();
        return $this->render('term', [
            'model' => $model
        ]);
    }
}
