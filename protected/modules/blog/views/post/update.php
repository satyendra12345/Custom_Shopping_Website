<?php



$this->params ['breadcrumbs'] [] = [

    'label' => Yii::t ( 'app', 'Blog' ),

    'url' => [

        'index'

    ]

];

$this->params ['breadcrumbs'] [] = [ 

		'label' => Yii::t ( 'app', 'post' ),

		'url' => [ 

				'index' 

		] 

];



$this->params ['breadcrumbs'] [] = Yii::t ( 'app', 'Update' );

?>

<div class="wrapper">

	<div class="card">

		<div class="blog-update">

			<?=  \app\components\PageHeader::widget(['model' => $model]); ?>

	</div>

	</div>



	<div class="content-section clearfix card">

		<?= $this->render ( '_form', [ 'model' => $model ] )?></div>

</div>



