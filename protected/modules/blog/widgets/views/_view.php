<?php
use yii\helpers\Html;

?>

<li><div class="items">
		<div class="menu-icon">
			<div class="row">
				<div class="col-md-4 sideimage">
					<a
						href="<?php
    
    echo $model->getUrl()?>">
						<?php
    
    echo Html::img($model->getImageUrl(), [
       
        'width' => '100%',
        'alt' => 'Image'
    
    ])?>
    </a>
				</div>
				<div class="col-md-8">
	<?php echo  $model->linkify()?>
	</div>
			</div>
		</div>
	</div></li>
<div class="clearfix"></div>





