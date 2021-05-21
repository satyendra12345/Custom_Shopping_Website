<?php
use miloschuman\highcharts\Highcharts;
use app\modules\statistics\assets\StatisticsAsset;

/* @var $this yii\web\View */
/* @var $chart Highcharts */
$this->title = Yii::t('app', 'Dashboard');
StatisticsAsset::register($this);

?>
<link href="<?=$this->theme->getUrl('css/jquery.mCustomScrollbar.min.css')?>">
<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
		<div class="card card-inverse card-info">
			<div class="box text-center text-white"><?=Yii::t('app', 'Today Visits ')?>
		<h1 class="font-light text-white"><?=$chart['today_visit']?></h1>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
		<div class="card card-primary card-inverse">
			<div class="box text-center text-white"><?=Yii::t('app', 'Today Visitors')?></div>
			<h1 class="font-light text-white text-center"><?=$chart['today_visitors']?></h1>
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
		<div class="card card-inverse card-success">
			<div class="box text-center text-white">
				<?=Yii::t('app', 'Yesterday Visits')?>
			</div>
			<h1 class="font-light text-white text-center"><?=$chart['yesterday_visit']?></h1>
		</div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
		<div class="card card-inverse card-warning">
			<div class="box text-center text-white">
				<?=Yii::t('app', 'Yesterday Visitors')?>
			</div>
			<h1 class="font-light text-white text-center"><?=$chart['yesterday_visitors']?></h1>
		</div>
	</div>
</div>
<div class="clear"></div>

<div class="card">
	<div class="card-header"><?=Yii::t('app', 'Last Hits')?></div>
	<div class="card-body">
		<div id="content-2" class="last-visitors longEnough mCustomScrollbar"
			data-mcs-theme="dark">
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th><?=Yii::t('app', 'IP')?></th>
						<th><?=Yii::t('app', 'Date')?></th>
						<th class="last-visitors-default-col fit"><?=Yii::t('app', 'OS')?></th>
						<th class="last-visitors-default-col"><?=Yii::t('app', 'Browser')?></th>
						<th class="last-visitors-default-col"><?=Yii::t('app', 'Location')?></th>
						<th class="last-visitors-default-col fit"><?=Yii::t('app', 'Referer')?></th>
						<th class="last-visitors-detail"><?=Yii::t('app', 'Detail')?></th>
					</tr>
				</thead>
				<tbody>
                    <?php
                    $url = isset(Yii::$app->params['url']) ? Yii::$app->params['url'] : '';
                    $i = 1;
                    ?>
                    <?php

                    foreach ((array) $visitors as $v) :
                        ?>
                        <tr>
						<td class="fit"><?=$i ++;?></td>
						<td class="fit"><?=$v['ip'];?></td>
						<td class="fit ltr"><?=$v['visit_date'];?></td>
						<td class="last-visitors-default-col fit"><?=$v['os'];?></td>
                            <?php
                        $locationTitle = $visitorsModel->getTitle($url, $v['location']);
                        $refererTitle = $visitorsModel->getTitle($url, $v['referer']);
                        ?>
                            <td class="last-visitors-default-col fit"><?=$v['browser']?></td>
						<td class="last-visitors-default-col"><a
							href="<?=$v['location'];?>" target="_blank"
							style="text-align: left; direction: rtl"><?=$locationTitle?></a></td>
						<td style="direction: ltr" class="last-visitors-default-col fit">
                                <?php

                        if ($v['referer'] != null) :
                            ?>
                                    <a href="<?=$v['referer']?>"
							target="_blank"><?=$refererTitle?></a>
                                <?php endif ?>
                            </td>
						<td class="last-visitors-detail">
							<div class="dropdown">
								<button class="btn btn-sm btn-default dropdown-toggle"
									type="button" data-toggle="dropdown"
									style="padding: 3px 7px 3px 7px; line-height: 0px;">
									<span class="fa fa-bars"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li><a href="#os"><span class="fa fa-desktop"></span> <?=
                        $v['os']?></a></li>
									<li><a href="#browser"><span class="fa fa-tablet"></span> <?=$v['browser']?></a></li>
									<li><a href="<?=$v['location']?>" target="_blank"><span
											class="fa fa-map-marker"></span> <?=$locationTitle?></a></li>
                                        <?php

                        if ($v['referer'] != null) :
                            ?>
                                            <li><a
										href="<?=$v['referer']?>" target="_blank"
										style="direction: ltr"><?=$refererTitle?> <span
											class="fa fa-link"></span></a></li>
                                        <?php endif ?>
                                    </ul>
							</div>
						</td>
					</tr>
                    <?php

                    endforeach
                    ;
                    ?>
                    </tbody>
			</table>
		</div>
		<!-- -->
	</div>
</div>

<div class="card ">
	<div class="card-header">
		<thnx ?=Yii::t('app', 'Hits InLast 30 Days')?>
	
	</div>
	<div class="card-body">
		<!-- -->
		<div style="width: 100%; margin-top: -15px;">
			<canvas id="chart_visitors"></canvas>
			<script>
                    var chart_labels = <?=$chart['labels'];?>;
                    var chart_max_visit = <?=$chart['max_visit'];?>;
                    var visit_labels = '<?=$chart['visit']['title'];?>';
                    var visit_data = <?=$chart['visit']['data'];?>;
                    var visitor_labels = '<?=$chart['visitor']['title'];?>';
                    var visitor_data = <?=$chart['visitor']['data'];?>;
                </script>
		</div>
		<!-- -->
	</div>
</div>
<script>

(function($){
    $(window).on("load",function(){
        $(".content").mCustomScrollbar();
    });
})(jQuery);

</script>
<script src="<?=$this->theme->getUrl('js/jquery.mCustomScrollbar.concat.min.js')?>"></script>