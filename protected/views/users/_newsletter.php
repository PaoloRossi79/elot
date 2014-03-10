<div id="newsForm">

    <?php 
    $formModel=$this->subscriptionForm;
    $nlForm = $this->beginWidget(
        'CActiveForm',
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
        <?php 
            echo $nlForm->label($model, 'privacyOk');
            echo $nlForm->checkBox($formModel, 'privacyOk');
            echo $nlForm->label($model, 'termsOk');
            echo $nlForm->checkBox($formModel, 'termsOk');
            ?>
        <div class="">Categories:
            <?php  
                /*foreach($this->categories as $k=>$cat){
                    echo $nlForm->checkBoxRow($formModel, $cat, array('label' => false));
                }*/
                echo $nlForm->checkBoxList($formModel, "catSelections", $formModel->categories, array('label' => false)); 
            ?>
        </div>
        <hr/><br/>
        <div class="">Other newsletters:
            <?php  
                /*foreach($this->categories as $k=>$cat){
                    echo $nlForm->checkBoxRow($formModel, $cat, array('label' => false));
                }*/
                echo $nlForm->checkBoxList($formModel, "othSelections", $formModel->others, array('label' => false)); 
            ?>
        </div>
        <br/>
        <div class="">
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
        <?php echo CHtml::ajaxButton ("Save",
            CController::createUrl('users/editNewsletter'), 
            array('update' => '#newsForm',
                    'type' => 'POST', 
                    'data'=>'js:$("#newsletter-form").serialize()',
            )); ?>
    <?php $this->endWidget(); ?>
</div>