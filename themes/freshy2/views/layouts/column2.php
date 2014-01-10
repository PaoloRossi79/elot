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
<?php $this->beginContent('//layouts/main'); ?>
<div id="page" class="sidebar_right">
    <div class="container">
        <div id="frame">
            <div id="content">
                <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links'=>$this->breadcrumbs,
                        )); ?><!-- breadcrumbs -->
                    <br/>
                <?php endif?>
                <?php echo $content; ?>
            </div><!-- content -->
            <div id="sidebar" class="sidebar">
                <div>
                    <div class="widget">
                        <h2>Operations</h2>
                        <?php
                                $this->beginWidget('zii.widgets.CPortlet', array(
                                        'title'=>'Operations',
                                ));
                                $this->widget('zii.widgets.CMenu', array(
                                        'items'=>$this->menu,
                                        'htmlOptions'=>array('class'=>'operations'),
                                ));
                                $this->endWidget();
                        ?>
                    </div>
                </div>
            </div><!-- sidebar -->
        </div><!-- frame -->
    </div><!-- container -->
</div><!-- page -->
<?php $this->endContent(); ?>