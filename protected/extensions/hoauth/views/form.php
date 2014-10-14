
<div class="form">
<?php echo CHtml::beginForm(); ?>
 
    <?php echo CHtml::errorSummary($form->form->model); ?>
 
<!--    <div class="row">
        <?php echo CHtml::activeLabel($form->form->model,'email'); ?>
        <?php echo CHtml::activeTextField($form->form->model,'email') ?>
    </div>
 
    <div class="row">
        <?php echo CHtml::activeLabel($form->form->model,'password'); ?>
        <?php echo CHtml::activePasswordField($form->form->model,'password') ?>
    </div>
 
    
    <div class="row submit">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>-->
 
<?php echo CHtml::endForm(); ?>