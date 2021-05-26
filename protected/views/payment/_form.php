<?php
use yii\helpers\Html;
use app\components\TActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>
<header class="card-header">
   <?php echo strtoupper(Yii::$app->controller->action->id); ?>
</header>
<div class="card-body">
   <?php    $form = TActiveForm::begin([
    
   'id' => 'payment-form',
   'options'=>[
   'class'=>'row'
   ]
   ]);

   echo $form->errorSummary($model);    
   
   ?>

<div class="row"> 
   <div class="col-md-3">
    <?php echo $form->field($model, 'title')->textInput(['maxlength' => 1024]) ?>
   </div>
   <div class="col-md-3">
    <?php echo $form->field($model, 'key')->textInput() ?>
   </div>

    <div class="col-md-3">
    <?php echo $form->field($model, 'value')->textInput(['maxlength' => 255]) ?>
    </div>

    <div class="col-md-3">
  <?php if(User::isAdmin()){?>      
     <?php echo $form->field($model, 'state_id')->dropDownList($model->getStateOptions(), ['prompt' => ''])  ?>
  <?php }?>   
    </div>     
    <div class="col-md-3">               
   <?php echo $form->field($model, 'type_id')->dropDownList($model->getTypeOptions(), ['prompt' => '']) ?>
    </div>
 <div class="col-md-12 text-right">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['id'=> 'payment-form-submit','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
 </div>
</div>
   <?php TActiveForm::end(); ?>
</div>