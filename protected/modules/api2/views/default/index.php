<?php
/**
 *@copyright : ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 *@author	 : Shiv Charan Panjeta < shiv@toxsl.com >
 */
use yii\widgets\ListView;
use yii\base\Widget;
use yii\helpers\Url;
use yii\helpers\StringHelper;
?>
<style>
html {
	scroll-behavior: smooth;
}
.api-list table td {
    vertical-align: middle;
}
.container-fluid {
	padding: 0px 0px;
}

.maintopbar a.form-collapse {
	color: #fff;
	padding: 0 15px;
	border-right: 1px solid #fff;
}

.maintopbar a.form-collapse:last-child {
	border-right: 0px;
}

.form-layout .card-body {
	box-shadow: 0px 0px 5px #ccc;
	background: #f1f1f1;
	margin: 20px auto;
}

.bottom-file-inner {
	width: 100% !important;
	position: relative;
	border-top: 5px solid #1c2833;
}
table td .form-group {
    margin-bottom: 0px;
    margin-top: 0 !important;
}
.bg-blue {
	background: #1c2833;
}

.bottom-file {
	position: fixed;
	background: #f2f7f8;
	border-top: 1px solid #000;
	top: 0;
	z-index: 1;
	width: 50%;
	height: 100vh;
	right: 0;
	overflow-y: auto;
}

#json-input {
	display: block;
	width: 100%;
	height: 200px;
}

span#copyBtn {
	padding: 10px 20px;
	border-radius: 3px;
	cursor: pointer;
}

#translate {
	padding: 10px 20px;
	border-radius: 3px;
	cursor: pointer;
	max-width: 100%;
}

#json-display {
	margin: 0;
	padding: 15px 0px 10px;
}

.bottom-file i {
	width: 100%;
	text-align: right;
	position: absolute;
	right: 10px;
	top: 10px;
	color: #fff;
}

.bottom-file-inner {
	width: 100% !important;
	position: relative;
}
.dropdown-menu.dropdown-menu-right.animated.flipInY.show {
    right: 0 !important;
    left: auto !important;
    transform: none !important;
    top: 100% !important;
}
.maintopbar {
	background: linear-gradient(to right, #0178bc 0%, #00bdda 100%);
	padding: 10px 15px;
}
.dropdown-user {
    list-style: none;
    padding: 0 15px;
    margin: 0;
}
.dropdown-toggle.text-muted.waves-effect.text-white.waves-dark i {
    color: #fff;
}
</style>
<script type="text/javascript"
	src="<?=$this->theme->getUrl('js/json-viewer.js')?>"></script>

<div class='container-fluid'>
	<div class="row">
		<div class="col-md-6">
			<div class='api-list'>
				<div class="maintopbar">
				
				<?php

    $getRecords = $dataProvider->models;
    foreach ($getRecords as $records) {
        foreach ($records as $class => $apis) {
            $arr = explode("?", $class, 2);
            ?>
				  <a class="form-collapse" data-id="<?=$arr[0]?>" href="#<?=$class?>"> <?=StringHelper::mb_ucfirst($class)?></a>
				    <?php
        }
    }
    ?>
				</div>
                <?=ListView::widget(['dataProvider' => $dataProvider,'itemView' => '_api','summary' => '']);?>
            </div>

		</div>
		<div class="col-md-6">
			<div class="bottom-file">
				<!--<div class="jquery-script-ads" style="margin:30px auto">
             </div> -->
				<div id="copySuccess" class="alert alert-danger my-1" role="alert">
					Text Copied!</div>
				<div class="bottom-file-inner">
					<textarea id="json-input" autocomplete="off">
                            [{
        	"Your Result will show here": 200,
        	"This container is EDITABLE": "Copy/Paste your JSON",
        	"You can use this as your default JSON VIEWER": "That's Awesome!"
						    },{
		"example Sending multiple data in JSON":[
			{"Name":"John","Age":"35"},
			{"Name":"Alie","Age":"40"}
                            ]}
                            ]
                    </textarea>
					<i class="fa fa-close"></i>
					<div class="row bg-blue mr0">
						<div class="col-sm-10">
							<pre id="json-display"></pre>
						</div>
						<div class="col-md-2 mt-4 text-right">
							<span id="copyBtn" class="btn btn-sm btn-info">Copy</span> <span
								id="translate" class="btn btn-sm btn-warning">Translate</span>
						</div>
					</div>

					<script type="text/javascript">
                        function getJson() {
                            try {
                                return JSON.parse($('#json-input').val());
                            } catch (ex) {
                                alert('Wrong JSON Format: ' + ex);
                            }
                        }
                
                        var editor = new JsonEditor('#json-display', getJson());
                        $('#translate').on('click', function () {
                            editor.load(getJson());
                        });
                    </script>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$("#copySuccess").hide();


$("#copyBtn").click(function(){
    $("#json-input").select();
    document.execCommand('copy');
    $("#copySuccess").show().delay(5000).fadeOut();
});
$('div .api-list form').hide();

$(".show-button").click(function(e){
	var dataId  = $(this).attr('data-id');
	console.log(dataId);
	$(".form-"+dataId).toggle();
});

$('input').focus(function()
		{
	        $('input').animate({ height: '-=50'}, 'fast');
		    $(this).animate({ height: '+=50'}, 'fast');
		});

$("[id^=retest]").click(function(e){
	//startPopUp();
	var api = $(this).attr('api-id');	
	var classid = $(this).attr('class-id');	
	var action = $("[name=action_"+classid+"-"+api+"]").val();	
	
	var values = $("#form_"+classid+"-"+api).serializeArray();
	var fd = new FormData();
	var file = $("#form_"+classid+"-"+api).find('input[type="file"]');
	
	if(typeof file[0] != 'undefined') { 
		var file_data = file[0].files; // for multiple files
		var name = $("#form_"+classid+"-"+api).find('input[type="file"]').attr('name');
		fd.append(name, file_data[0]);
	}
    $.each(values,function(key,input){
        fd.append(input.name,input.value);
    });
    
    $('#json-input').val('');
    $('#json-display').html('');
   
	$.ajax({
		url:"<?=Url::to('')?>/"+action,
		type:'POST',
		data:fd,
		contentType:false,
		processData:false,
		success:function(response) {	
			
			console.log('res'+response);
			if(response.status == '200') 
			{
				$("span#response_"+classid+'-'+api).removeClass('btn-primary').addClass('btn-success');
			}
			$("#response_"+classid+'-'+api).html(response.status);
			$( "#json-input" ).val(JSON.stringify(response) );
			$("#translate").trigger('click');
		},
		error:function(xhr, status, error)
		{
			if(error == "Internal Server Error" || error == "Unauthorized"){
                error = JSON.stringify(xhr);
                $( "#json-input" ).val(error);
				}else{
					$( "#json-input" ).val(JSON.stringify(error) );
					}
			$("#translate").trigger('click');	
			$("span#response_"+classid+'-'+api).html(error);
		}
		
		});
});
$("[id^=remove]").click(function(){
	$(this).parent().find('#param').attr('disabled',true);
	$(this).parent().parent().hide();	
});
</script>