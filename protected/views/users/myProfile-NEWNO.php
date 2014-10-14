<div class="main-width">
    <?php 
        $panel2=CHtml::ajaxButton ("Buy Credit",
            CController::createUrl('users/buyCredit'), 
            array('update' => '#buyCreditTarget',
                    'type' => 'POST', 
                    'data'=>'js:$("#userWallet-form").serialize()',
            ));
        $panel2.=$this->renderPartial('_buyCredit', array('model'=>$model),true);
        $panel3=CHtml::ajaxButton ("Save",
            CController::createUrl('users/editNewsletter'), 
            array('update' => '#newsForm',
                    'type' => 'POST', 
                    'data'=>'js:$("#newsletter-form").serialize()',
            ));
        $panel3.=$this->renderPartial('_newsletter', array('model'=>$model),true);
    ?>
    <?php
    $tab1Label = '<span class="badge"><em class="glyphicon glyphicon-user"></em></span> <span class="tab-text ng-binding">Profilo</span>';
    $tab2Label = '<span class="badge"><em class="glyphicon glyphicon-euro"></em></span> <span class="tab-text ng-binding">Conto</span>';
    $tab3Label = '<span class="badge"><em class="glyphicon glyphicon-envelope"></em></span> <span class="tab-text ng-binding">Newsletter</span>';
    $tab4Label = '<span class="badge"><em class="glyphicon glyphicon-envelope"></em></span> <span class="tab-text ng-binding">Tickets</span>';
    $this->widget('zii.widgets.jui.CJuiTabs',array(
        'tabs'=>array(
            $tab1Label=>array('content'=>$this->renderPartial('_profile', array('model'=>$model),true), 'id'=>'tab1'),
            $tab2Label=>array('content'=>$panel2, 'id'=>'tab2'),
            $tab3Label=>array('content'=>$panel3, 'id'=>'tab3'),
            // panel 3 contains the content rendered by a partial view
            $tab4Label=>array('ajax'=>$this->createAbsoluteUrl('tickets/index')),
        ),
        // additional javascript options for the tabs plugin
        'options'=>array(
            'collapsible'=>true,
        ),
    ));
    ?>
    
    
</div>