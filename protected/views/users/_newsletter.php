<div id="newsForm">

    <?php 
    $formModel=$this->subscriptionForm;
    $nlForm = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'newsletter-form',
//            'action'=>CController::createUrl('users/editNewsletter'),
            'htmlOptions' => array('class' => 'well','enctype' => 'multipart/form-data'), // for inset effect
        )
    );
    ?>
    <?php echo $nlForm->errorSummary($formModel); ?>
    
    <div class="">
        <div><?php echo Yii::t('elot','Newsletter'); ?></div>
        <br/><br/>
        <div class="span3">Categories:
            <?php  
                /*foreach($this->categories as $k=>$cat){
                    echo $nlForm->checkBoxRow($formModel, $cat, array('label' => false));
                }*/
                echo $nlForm->checkBoxListRow($formModel, "catSelections", $formModel->categories, array('label' => false)); 
            ?>
        </div>
        <hr/><br/>
        <div class="span3">Other newsletters:
            <?php  
                /*foreach($this->categories as $k=>$cat){
                    echo $nlForm->checkBoxRow($formModel, $cat, array('label' => false));
                }*/
                echo $nlForm->checkBoxListRow($formModel, "othSelections", $formModel->others, array('label' => false)); 
            ?>
        </div>
        <br/>
        <div class="span3">
            <?php 
            echo $nlForm->checkBoxRow($formModel, 'privacyOk', array('label' => "Accept privacy policy?"));
//            echo $nlForm->error($formModel,'privacyOk');
            echo $nlForm->checkBoxRow($formModel, 'termsOk', array('label' => "Accept terms & conditions?"));
//            echo $t = $nlForm->error($formModel,'termsOk');
//            echo CHtml::ajaxSubmitButton('Save', CController::createUrl('users/editNewsletter'), array('name' => 'save', 'class' => 'btn')); 
            ?>
            <?php 
            
            /*$this->widget(
                'bootstrap.widgets.TbButton',
                array(
                    'type' => 'primary',
                    'buttonType' => 'ajaxSubmit',
                    'label' => 'Save',
                    'url' => CController::createUrl('users/editNewsletter'), 
                    'ajaxOptions' => array(
                        'update' => '#newsForm',
                        'type' => 'POST', 
                        'data'=>'js:jQuery(this).parents("form").serialize()',
                    ),
                )
            );*/ ?>
        </div>
    </div>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'type' => 'primary',
                'buttonType' => 'ajaxSubmit',
                'label' => 'Save',
                'url' => CController::createUrl('users/editNewsletter'), 
                'ajaxOptions' => array(
                    'update' => '#newsForm',
                    'type' => 'POST', 
                    'data'=>'js:jQuery(this).parents("form").serialize()',
                ),
            )
        ); ?>
    <?php $this->endWidget(); ?>
</div>