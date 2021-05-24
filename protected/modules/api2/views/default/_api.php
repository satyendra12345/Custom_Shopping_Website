<?php

use yii\helpers\Html;
use yii\helpers\Url;
use Egulias\EmailValidator\Warning\LabelTooLong;
?>


<table class="table table-striped">
<?php
foreach ($model as $class => $apis) {

    ?>
<tr>
		<th id="<?=$class?>" class="text-center text-uppercase" colspan="4">
<?=$class;?>
</th>
	</tr>
	<tr>
		<!-- <th>API</th>
		<th>POST PARAMATERS</th> -->

		<!-- <th>Response</th> -->
	</tr>
<?php

    foreach ($apis as $api => $posts) {

        ?>
        
<tr>
<td>
<label class="d-block w-100 text-uppercase pl-1">
<?php
        $api_action = preg_replace('/\?(.*)$/', '-', $api);
        echo (! empty($posts)) ? 'POST' : 'GET';
        ?>
  </label>
		<td>
			<div class="form-group">
				
<?php
        echo Html::textInput('action_' . $class . '-' . $api_action, $class . '/' . $api, [
            'style' => 'width:50%',
            'class' => 'form-control w-100'
        ]);
        ?>
      
        </div>
		</td>
		<td>
			<div class="form-group d-flex justify-content-between mt-4">
				<a class="btn-sm btn btn-warning text-center text-white retest"
					id="retest_<?=$class?>-<?=$api_action;?>"
					api-id="<?=$api_action;?>" class-id="<?=$class;?>">Retest </a> 
					
					<?php
        $arr = explode("?", $api, 2);
        if (! empty($posts)) {
            ?>
					<a data-id="<?=$arr[0]?>" href='javascript:'
					class="show-button btn btn-sm btn-success text-center">Show Params</a>
					<?php
        }
        ?>
			</div>
		</td>
	<!-- <td><input type="radio">Js_json</td> -->
	
	<tr>
		<td colspan="5">
			<form class="form-layout form-<?=$arr[0]?>"
				id="form_<?=$class?>-<?=$api_action;?>"
				action="<?=Url::toRoute([$class . '/' . $api])?>"
				enctype="multipart/form-data">
				<div class="card-body">
<?php
        foreach ($posts as $param => $data) {
            ?>
            <div class="field form-group">
						<label>
<?php
            echo $param;
            ?></label>
						<div class="param d-flex input-group">
			<?php

            if (strstr($param, '_file'))
                echo Html::fileInput($param, $data, [
                    'id' => 'param',
                    'style' => 'width:60%;'
                ]);
            else
                echo Html::textInput($param, $data, [
                    'id' => 'param',
                    'style' => 'width:60%;',
                    'class' => 'form-control'
                ]);

            ?>
                 <div class="input-group-append cross-icon">
								<span class="input-group-text"><i class="fa fa-remove"></i></span>
							</div>
							<!--                 <div class="cross-icon ml-2">
							 <a id="remove" style="cursor: pointer;"><i class="fa fa-remove"></i></a>
                    </div> -->
						</div>
					</div>
			<?php
        }
        ?>
        </div>
			</form>
		</td>
	</tr>
	</tr>
	</tbody>	
<?php
    }
}
?>

</table>