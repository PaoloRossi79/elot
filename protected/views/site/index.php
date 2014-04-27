<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
<div class="slideshow-ext">
    <div id="slideshow-container">
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover1.png", "",array('class'=>'img-responsive')); ?>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover2.png", "",array('class'=>'img-responsive')); ?>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover3.png", "",array('class'=>'img-responsive')); ?>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover4.png", "",array('class'=>'img-responsive')); ?>
    </div>
</div>

<div class="line-breaker"></div>

<div class="filter-container row-fluid">
     <div class="label-find-lot col-lg-5">    
         <h1>Trova la proposta</h1>
         <h4>scegli la categoria d'interesse o cerca nella tua città</h4>
     </div>

    <div class="col-lg-7">
        <?php 
            $form = $this->beginWidget(
                'CActiveForm',
                array(
                    'id' => 'searchLot-form',
                    'action' => CController::createUrl('lotteries/index'),
                    'htmlOptions' => array('enctype' => 'multipart/form-data'), // for inset effect
                )
            );
            echo $form->hiddenField($this->filterModel,'LotStartStatus');
            echo $form->hiddenField($this->filterModel,'Category');
        ?>
        <div class="input-group">
          <div class="input-group-btn">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span id="cat-sel"><?php echo Yii::t('wonlot','Categories'); ?></span><span class="glyphicon glyphicon-tag"></span>
              </button>
            <ul class="dropdown-menu cat-list">
              <?php
                    $cat = $this->filterModel->lists['Categories'];
                    foreach($cat as $k=>$item){ ?>
                    <?php echo "<li id='".$item."' data-id='".$k."'>".$item."</li>";?>
              <?php } ?>
            </ul>
          </div><!-- /btn-group -->
          <?php echo $form->textField($this->filterModel,'searchText',array('placeholder' => 'Cosa cerchi? ...', 'class' => "form-control")); ?>
          <?php echo CHtml::submitButton('Search', array('name' => 'search', 'class' => 'btn btn-success')); ?>
        </div><!-- /input-group -->
        <?php $this->endWidget(); ?>
    </div><!-- /.col-lg-6 -->
 </div>  
<div class="clear"></div>
<div class="winners-container" style="display: none;"> 
    <div class="winners-banner">
        <img src="/images/site/left-star.png">
        <img src="/images/site/winners-banner.png">
        <img src="/images/site/right-star.png">
    </div>
    <div class="winners-list">
        
    </div>
</div>
<div class="line-breaker"></div>
<div class="clear"></div>
<div class="main-lot-container">
    <div class="main-lot-banner">
        <img src="/images/site/all-lot-banner.png">
    </div>
    <div class="main-lot-list">
        <?php 
            $this->renderPartial('/lotteries/main-lot'); 
//        $this->widget('listLotteryWidget');
        ?>
    </div>
</div>

<div class="clear"></div>
         
   