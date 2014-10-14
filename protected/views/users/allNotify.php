<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="main-width">
    <div class="panel panel-default bootstrap-widget-table">
        <div class="panel-body">
            <table class="table table-hover">

            <?php 
              $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'notifyRow',   // refers to the partial view named '_post'
                    'enableSorting'=>true,
                    'sortableAttributes'=>array(
                        'from_user_id',
                        'to_user_id',
                        'message_type',
                    ),
              ));
                    
            ?>
            
            </table>
        </div>
    </div>
</div>