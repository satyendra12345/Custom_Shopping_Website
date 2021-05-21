<?php
/**
 *@copyright : ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 *@author	 : Shiv Charan Panjeta < shiv@toxsl.com >
 */
use app\components\grid\TGridView;
use yii\widgets\Pjax;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MassAction;
/**
 *
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\Blog $searchModel
 */

?>

<?php
if (User::isAdmin()) {
    echo MassAction::widget([
        'url' => Url::toRoute([
            'post/mass'
        ]),
        'grid_id' => 'post-grid-data',
        'pjax_grid_id' => 'post-pjax-grid'
    ]);
}
?>
<?php Pjax::begin(['id'=>'post-pjax-grid','enablePushState'=>false,'enableReplaceState'=>false]); ?>
    <?php
    
    echo TGridView::widget([
        'id' => 'post-grid-data',
        'dataProvider' => $dataProvider,
        
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered'
        ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn','header'=>'<a>S.No.<a/>'],
            [
                'name' => 'check',
                'class' => 'yii\grid\CheckboxColumn',
                'visible' => User::isAdmin()
            ],
            'id',
            'title',
            /* 'content:html',*/
            /* 'keywords',*/
            /* ['attribute' => 'image_file','filter'=>$searchModel->getFileOptions(),
			'value' => function ($data) { return $data->getFileOptions($data->image_file);  },],*/
             'view_count',
            [
                'attribute' => 'state_id',
                'format' => 'raw',
                'filter' => isset($searchModel) ? $searchModel->getStateOptions() : null,
                'value' => function ($data) {
                    return $data->getStateBadge();
                }
            ],
            [
                'attribute' => 'type_id',
                'value' => function ($model) {
                    return $model->type;
                }
            ],
            'created_on:datetime',
			'updated_on:datetime', 
								[
                'attribute' => 'created_by_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return isset($model->createUser) ? $model->createUser->full_name : "Not set";
                }
            ],
            [
                'class' => 'app\components\TActionColumn',
                'header' => '<a>Actions</a>'
            ]
        ]
    ]);
    ?>
<?php Pjax::end();?>

<script> 
$('#bulk_delete_post-grid').click(function(e) {
	e.preventDefault();
	 var keys = $('#post-grid-data').yiiGridView('getSelectedRows');

	 if ( keys != '' ) {
		var ok = confirm("Do you really want to delete these items?");

		if( ok ) {
			$.ajax({
				url  : '<?php echo Url::toRoute(['post/mass','action'=>'delete','model'=>get_class($searchModel)])?>', 
				type : "POST",
				data : {
					ids : keys,
				},
				success : function( response ) {
					if ( response.status == "OK" ) {
						 $.pjax.reload({container: '#post-grid-data'});
					}
				}
		     });
		}
	 } else {
		alert('Please select items to delete');
	 }
});

</script>
