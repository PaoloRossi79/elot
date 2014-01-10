<?php 
    $formModel=$this->subscriptionForm;
    $nlForm = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'newsletter-form',
            'action'=>CController::createUrl('users/editNewsletter'),
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
                echo $nlForm->checkBoxListRow($formModel, "selections", $formModel->categories, array('label' => false)); 
            ?>
        </div>
        <?php echo CHtml::submitButton('Save', array('name' => 'save', 'class' => 'btn')); ?>
    </div>
<?php $this->endWidget(); ?>