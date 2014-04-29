<?php
if($model->followers){
    $followersId = CHtml::listData( $model->followers, 'follower_id','follower_id');
} else {
    $followersId = array();
}
?>
<div class="lot-panel panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title">
          <span class="row">
          <span class="col-md-11">
              <?php echo CHtml::encode($model->username); ?>
          </span>
          <span class="col-md-1">
              <?php if($this->userId != $model->id){ ?>
                <?php if(!in_array($model->id,$followersId)){ ?>
                      <?php echo CHtml::ajaxLink('', '#',array(),array('id'=>'follUserBtn-'.$model->id,'name'=>$model->id,'class'=>'follUserBtn setFav btn btn-default btn-lg glyphicon glyphicon-star-empty')); ?>
                <?php } else { ?>
                      <?php echo CHtml::ajaxLink('', '#',array(),array('id'=>'unfollUserBtn-'.$model->id,'name'=>$model->id,'class'=>'follUserBtn unsetFav btn btn-default btn-lg glyphicon glyphicon-star'));?>
                <?php } ?>
              <?php } ?>
          </span>
          </span>
      </h3>
    </div>
    <div class="panel-body">
        <div class="col-md-3">
            <?php if($model->ext_source > 1){
                //echo CHtml::image($model->profile->img, "User Avatar", array("class"=>"user-avatar"));
                // TODO: get Image from socials
                echo "<img src='".$model->profile->img."' style='width:200px;heigth:200px;'/>";
            } else {
                echo CHtml::image("/images/userProfiles/".Yii::app()->user->id."/boxThumb/".$model->profile->img, "User Avatar", array("class"=>"img-thumbnail"));
            } ?>
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
            $dataProvider =  new CArrayDataProvider('Lotteries');
            $dataProvider->setData($model->lotteries);
            $this->widget('ext.isotope.Isotope',array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'/lotteries/lot-box',
                'summaryText'=>'', 
                'itemSelectorClass'=>'lot-box-item',
                'options'=>array( // options for the isotope jquery
                    'layoutMode'=>'masonry',
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