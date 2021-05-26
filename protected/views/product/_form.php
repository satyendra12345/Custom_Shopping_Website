<?php
use yii\helpers\Html;
use app\components\TActiveForm;
use app\models\User;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<header class="card-header">
   <?php echo strtoupper(Yii::$app->controller->action->id); ?>
</header>
<div class="card-body">
   <?php 
   $form = TActiveForm::begin([
   'id' => 'product-form',
   'options'=>[
   'class'=>'row',
   'enctype'=>'multipart/form-data'
   ]
   ]);
   echo $form->errorSummary($model);    
   ?><div class="col-md-6">
                  <?php echo $form->field($model, 'title')->textInput(); ?>
                              <?php echo  $form->field($model, 'description')->widget ( app\components\TRichTextEditor::className (), [ 'options' => [ 'rows' => 6 ],'preset' => 'basic' ] ); //$form->field($model, 'description')->textarea(['rows' => 6]); ?>
                            <?php 

echo  $form->field($model, 'image_file')->fileInput();


      //     echo FileInput::widget([
      //       'model' => $model,
      //       'attribute' => 'image_file',
      //       'name' => 'image_file',
      //       'options' => [
      //           'multiple' => true,
      //           'accept' => 'image/*'
      //       ],
      //       'pluginOptions' => [
      //           'showCaption' => false,
      //           'showRemove' => false,
      //           'showUpload' => false,
      //           'browseClass' => 'btn btn-primary btn-block',
      //           'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
      //           'browseLabel' =>  'Attach Multiple Product Images',
      //           'allowedFileExtensions' => ['jpg','gif','png'],
      //           'overwriteInitial' => false
      //       ],
      //   ]);

    ?>
                              <?php echo $form->field($model, 'category_id')->dropDownList($model->getCategoryOptions(), ['prompt' => '']) ?>
                              <?php echo $form->field($model, 'menu_id')->dropDownList($model->getMenuOptions(), ['prompt' => '']) ?>
                              <?php echo $form->field($model, 'price')->textInput() ?>
                        <?php if(User::isAdmin()){?>     <?php echo $form->field($model, 'state_id')->dropDownList($model->getStateOptions(), ['prompt' => '']) ?>
      <?php }?>                        <?php echo $form->field($model, 'type_id')->dropDownList($model->getTypeOptions(), ['prompt' => '']) ?>
              </div>    <div
      class="col-md-12 text-right">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['id'=> 'product-form-submit','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
   </div>
   <?php TActiveForm::end(); ?>
</div>


