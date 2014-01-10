<?php
/*/////////////////////////////////////////////////////////////////////////
// This file is part of the
//  _______                   _               ______  
// (_______)                 | |             (_____ \ 
//  _____  ____  _____   ___ | |__   _   _     ____) )
// |  ___)/ ___)| ___ | /___)|  _ \ | | | |   / ____/ 
// | |   | |    | ____||___ || | | || |_| |  | (_____ 
// |_|   |_|    |_____)(___/ |_| |_| \__  |  |_______)
//                                  (____/            
//                                          Yii theme
//
// Ported from the original Wordpress Freshy 2 theme:
// http://www.jide.fr/english/downloads/freshy2
//
// Licensed under the GPL, like the original theme
// Copyleft 2011 - Jacob 'jacmoe' Moen @ http://www.jacmoe.dk/
/////////////////////////////////////////////////////////////////////////*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" media="screen, projection" />
    <?php /* Put the custom style here - like 'custom_bloggy.css', 'custom_vitamin', etc - you can store it in the app params or in a database. */ ?>
    <?php //if((Yii::app()->config->get('style') !== 'freshy2') && (Yii::app()->config->get('style'))) : ?>
<!--        <link rel="stylesheet" type="text/css" href="<?php //echo Yii::app()->theme->baseUrl; ?>/css/<?php //echo Yii::app()->config->get('style')?>.css" media="screen, projection" />-->
    <?php //endif; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/yii_style.css" media="screen, projection" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
<div id="body">
    <div id="header">
        <div class="container">
            <div id="title">
                <h1>
                    <?php echo CHtml::link(CHtml::encode(Yii::app()->name), $this->createUrl('')) ?>
                </h1>
                <div class="description">
                    <small><?php echo Yii::app()->params['description']?></small>
                </div>
            </div>
            <div id="header_image">
                <div id="menu">
                    <div class="menu_container">
                        <?php $this->widget('Freshy2Menu',array(
                            'items'=>array(
                                    array('label'=>'Home', 'url'=>array('/site/index')),
                                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                            ),
                        )); ?>
                    </div><span class="menu_end"></span>
                </div><!-- menu -->
            </div><!-- header_image -->
        </div><!-- container -->
    </div><!-- header -->
    <?php echo $content; ?>
    <div id="footer">
        <div class="container">
            <div id="footer_content">
                <div style="font-size: 75%;font-style: italic;">Copyright &copy; <?php echo 'year'//Yii::app()->params['copyright_year']; ?> by <?php echo 'name'//Yii::app()->params['copyright_holder']; ?><br/>All Rights Reserved.<br/></div>
                <a href="http://www.yiiframework.com"><img title="Powered by Yii Framework" alt="Powered by Yii Framework" src="<?php echo Yii::app()->theme->baseUrl ?>/images/yii-powered.png"/></a><br/>
                <a href="http://www.jide.fr"><img alt="design by jide" src="<?php echo Yii::app()->theme->baseUrl ?>/images/micro_jide.png"/></a>
            </div><!-- footer_content -->
        </div><!-- container -->
    </div><!-- footer -->
</div><!-- body -->
</body>
</html>