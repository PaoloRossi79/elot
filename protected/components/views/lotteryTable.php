<div class="main-table col-md-12">
    <?php $tickets->pagination->route = 'users/searchTicket'; ?>
    <table class="table table-hover">
        <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$tickets,
                'itemView'=>'_lotteryTable',
                'id'=>'lotTabTTT',
                //'enablePagination'=>true,
                'ajaxUrl'=> Yii::app()->createUrl('/users/searchTicket'),
                'ajaxUpdate'=>'#userTicketContainer',
                'sortableAttributes'=>array(
                    'name'=>'Nome Asta',
                ),
        )); ?>
    
    </table>
</div>  