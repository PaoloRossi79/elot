<?php
/* @var $this UsersController */
/* @var $model Users */
?>



<div class="main-width">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?php echo $model->username; ?></h1>
            <h3>(id: <?php echo $model->id; ?>)</h3>
        </div>
        <div class="panel-body">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </div>
</div>