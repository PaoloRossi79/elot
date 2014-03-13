<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>
<div class="slideshow-ext">
    <div id="slideshow-container">
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover1.jpg", "",array('class'=>'img-responsive')); ?>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover2.jpg", "",array('class'=>'img-responsive')); ?>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover3.jpg", "",array('class'=>'img-responsive')); ?>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/cover4.jpg", "",array('class'=>'img-responsive')); ?>
    </div>
    <div class="left-btn-grp">
        <span class="left-btn">
            <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/left-button-1.png", "My Tickets", array("class"=>"img-responsive")); ?>
            </a>
        </span>
        <span class="left-btn">
            <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/left-button-2.png", "My Tickets", array("class"=>"img-responsive")); ?>
            </a>
        </span>
        <span class="left-btn">
            <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/left-button-3.png", "My Tickets", array("class"=>"img-responsive")); ?>
            </a>
        </span>
    </div>
</div>

<div class="line-breaker"></div>
<div class="filter-container">
     <div class="label-find-lot">    
         <h1>Trova la proposta</h1>
         <h4>scegli la categoria d'interesse o cerca nella tua città</h4>
     </div>

    <div class="left">
        <div class="btn-group main-search-grp">
            <button type="button" class="btn btn-default dropdown-toggle main-search-btn" data-toggle="dropdown">
              <?php echo Yii::t('wonlot','Categories'); ?><span class="glyphicon glyphicon-tag"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <?php
                    $cat = $this->filterModel->lists['Categories'];
                    foreach($cat as $k=>$item){ ?>
                    <?php echo "<li>".CHtml::link($item, Yii::app()->createUrl('lotteries/index?cat='.$item), array('label' => false))."</li>";?>
              <?php } ?>
            </ul>
        </div>
        <div class="btn-group main-search-grp">
            <div class="input-group main-search-btn">
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
                $this->widget('gmap.EGMapAutocomplete', array(
                    'name' => 'searchCity',
                    'model' => $this->filterModel,
                    'value' => $this->filterModel->geo,
                    'attribute' => 'geo',
                    'htmlOptions'=>array(
                        'class'=>'input-medium'
                    ),
                    'options' => array(
                       'types' => array(
                         '(cities)'
                       ),
                       /*'componentRestrictions' => array(
                          'country' => 'us',
                        )*/
                    )
                ));
                ?>
                <!--<span class="input-group-addon glyphicon glyphicon-map-marker"></span>-->
                <?php echo CHtml::submitButton('Search', array('name' => 'search', 'class' => 'btn btn-success')); ?>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
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
        <?php $this->renderPartial('/lotteries/main-lot'); ?>
    </div>
</div>

<div class="clear"></div>
         
   