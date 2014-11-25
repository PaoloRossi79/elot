<?php
$isFollowing = FALSE;
if($model->followers){
    foreach ($model->followers as $follower) {
        if($follower->follower_id == Yii::app()->user->id){
            $isFollowing = true;
            break;
        }
    }
    $followersId = CHtml::listData( $model->followers, 'follower_id','follower_id');
} else {
    $followersId = array();
}
?>
<div class="lot-panel panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title">
          <span class="row">
          <span class="col-md-10">
              <?php echo CHtml::encode($model->username); ?>
          </span>
          <span class="col-md-2">
              <?php if($this->userId != $model->id){ ?>
                <button class="follUserBtn btn btn-default btn-lg <?php echo ($isFollowing) ? 'startHide' : '';?>"><i class="glyphicon glyphicon-eye-open"></i><?php echo Yii::t("wonlot","Segui");?></button>
                <button class="unfollUserBtn btn btn-default btn-lg <?php echo ($isFollowing) ? '' : 'startHide' ;?>"><i class="glyphicon glyphicon-eye-close"></i><?php echo Yii::t("wonlot","Smetti di seguire");?></button>
              <?php } ?>
          </span>
          </span>
      </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-3">
            <?php echo Users::model()->getImageTag($model,'mediumSquaredThumb'); ?>
        </div>
        <div class="col-md-9">
            <h4><?php echo Yii::t("wonlot","Informazioni"); ?></h4>
            <div class="text-block">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t("wonlot","Nome utente:"); ?></dt>
                    <dd><?php echo CHtml::encode($model->username); ?></dd>
                    <dt><?php echo Yii::t("wonlot","Venditore Garantito?"); ?></dt>
                    <dd><?php echo CHtml::encode($model->is_guaranted); ?></dd>
                    <dt><?php echo Yii::t("wonlot","Votazione media"); ?></dt>
                    <dd><?php echo CHtml::encode($model->avg_rating); ?></dd>
                    <dt><?php echo Yii::t("wonlot","Persone che seguono:"); ?></dt>
                    <dd>
                        <?php 
                        foreach($model->followers as $fl){
                            
                        }
                        echo CHtml::encode(count($model->followers)); 
                        ?>
                    </dd>
                    <dt><?php echo Yii::t("wonlot","Persone che segue:"); ?></dt>
                    <dd>
                        <?php 
                        foreach($model->followings as $fw){
                            
                        }
                        echo CHtml::encode(count($model->followings)); 
                        ?>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="col-md-12">
            <h4><?php echo Yii::t("wonlot","Lotterie"); ?></h4>
            <?php
            $this->widget('ext.isotope.Isotope',array(
                'dataProvider'=>Users::model()->getUserLotteries($model->id),
                'itemView'=>'/lotteries/lot-box',
                'summaryText'=>'', 
                'itemSelectorClass'=>'lot-box-item',
                'options'=>array( // options for the isotope jquery
                    'layoutMode'=>'masonry',
                    'columnWidth'=>240,
                    'containerStyle' => array(
                        'position' => 'relative', 
                        'overflow' => 'hidden', 
                    ),
                    'animationEngine'=>'jquery',
                    'animationOptions'=>array(
                            'duration'=>300,
                    ),
                    'resizesContainer' => true,
                ), 
                'infiniteScroll'=>true, // default to true
                /*'infiniteCallback'=>'
                    \$(".lot-box-int").mouseenter(
                        function(){
                          var hiddenDiv = \$(this).parent().children(".lot-box-hover");
                          hiddenDiv.filter(":not(:animated)").fadeIn();
                        // This only fires if the row is not undergoing an animation when you mouseover it
                        }
                     );
                     \$(".lot-box-hover").mouseleave(
                         function(){
                          \$(this).fadeOut();
                        // This only fires if the row is not undergoing an animation when you mouseover it
                        }
                     );
                ',*/
                'infiniteOptions'=>array(
                    'loading' => array(
                        'msgText' => 'Caricamento ... ',
                        'finishedMsg' => 'Tutte le lotterie sono state caricate!',
                    )
                ), // javascript options for infinite scroller
                'id'=>'lot-isotope-user',
            )); ?>
        </div>
    </div>
</div>