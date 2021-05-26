<?php

use app\components\useraction\UserAction;

use app\modules\comment\widgets\CommentsWidget;

use yii\helpers\Html;

use app\components\TActiveForm;

/* @var $this yii\web\View */

/* @var $model app\models\Payment */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['index']];

$this->params['breadcrumbs'][] = (string)$model;

?>

<div class="wrapper">

   <div class="card">

      <div class="payment-view card-body">

         <h4 class="text-danger">Are you sure you want to delete this item? All related data is deleted</h4>

         <?php echo  \app\components\PageHeader::widget(['model'=>$model]); ?>

      </div>

   </div>

   <div class="card">

      <div class="card-body">

         <?php echo \app\components\TDetailView::widget([

         'id'	=> 'payment-detail-view',

         'model' => $model,

         'options'=>['class'=>'table table-bordered'],

         'attributes' => [

                     'id',
            /*'title',*/
            'key',
            'value',
            /*[

			'attribute' => 'state_id',

			'format'=>'raw',

			'value' => $model->getStateBadge(),],*/
            [

			'attribute' => 'type_id',

			'value' => $model->getType(),

			],
            'create_time:datetime',
            [

            			'attribute' => 'created_by_id',

            			'format'=>'raw',

            			'value' => $model->getRelatedDataLink('created_by_id'),

            			],

         ],

         ]) ?>

         <?php  ?>

         <?php 
         $form = TActiveForm::begin([

         'id'	=> 'payment-form',

         'options'=>[

         'class'=>'row'

         ]

         ]);?>

         echo $form->errorSummary($model);	

         ?>
         <div class="col-md-12 text-right">

            <?= Html::submitButton('Confirm', ['id'=> 'payment-form-submit','class' =>'btn btn-success']) ?>

         </div>

         <?php TActiveForm::end(); ?>

      </div>

   </div>

   
   <div class="card">

      <div class="card-body">

         <div

            class="payment-panel">

            <?php

            $this->context->startPanel();

            
            $this->context->addPanel('Feeds', 'feeds', 'Feed',$model /*,null,true*/);

            
            $this->context->endPanel();

            ?>

         </div>

      </div>

   </div>

   
   <?php echo CommentsWidget::widget(['model'=>$model]); ?>

</div>