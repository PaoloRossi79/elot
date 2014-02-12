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
            <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/tickets/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/left-button-1.png", "My Tickets", array("class"=>"img-responsive")); ?>
            </a>
        </span>
        <span class="left-btn">
            <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/tickets/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
                <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/left-button-2.png", "My Tickets", array("class"=>"img-responsive")); ?>
            </a>
        </span>
        <span class="left-btn">
            <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/tickets/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
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
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
        </div>
        <div class="btn-group main-search-grp">
            <div class="input-group main-search-btn">
                <input type="text" class="form-control" placeholder="<?php echo Yii::t('wonlot','City'); ?>">
                <span class="input-group-addon glyphicon glyphicon-map-marker"></span>
            </div>
        </div>
    </div>
 </div>
                  
         
         
<div class="clear"></div>
         
   