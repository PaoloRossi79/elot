<div class="main-width">

    <div class="panel panel-default bootstrap-widget-table">
        <div class="panel-heading">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
                <li class="profile-tab-item width-25perc active">
                    <a id="profileButton1" href="#tabProfile1" data-toggle="tab" class="btn btn-info"><span class="badge"><em class="glyphicon glyphicon-user"></em></span> <span class="tab-text ng-binding">Profilo</span></a>
                </li>
                <li class="profile-tab-item width-25perc">
                    <a id="profileButton2" href="#tabProfile2" data-toggle="tab" class="btn"><span class="badge"><em class="glyphicon glyphicon-euro"></em></span> <span class="tab-text ng-binding">Conto</span></a>
                </li>
                <li class="profile-tab-item width-25perc">
                    <a id="profileButton3" href="#tabProfile3" data-toggle="tab" class="btn"><span class="badge"><em class="glyphicon glyphicon-envelope"></em></span> <span class="tab-text ng-binding">Tickets</span></a>
                </li>
                <li class="profile-tab-item width-25perc">
                    <a id="profileButton4" href="#tabProfile4" data-toggle="tab" class="btn"><span class="badge"><em class="glyphicon glyphicon-envelope"></em></span> <span class="tab-text ng-binding">Newsletter</span></a>
                </li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="form">
                <!-- Tab panes -->
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tabProfile1">
                      <?php echo $this->renderPartial('_profile', array('model'=>$model),true); ?>
                  </div>
                  <div class="tab-pane fade" id="tabProfile2">
                      <?php 
                        $panel2 =$this->renderPartial('_creditPanel', array('model'=>$model),true);
                        $panel2 .= $this->renderPartial('_transactionsEmpty', array(),true);
                        echo $panel2;
                      ?>
                  </div>
                  <div class="tab-pane fade" id="tabProfile3">
                      <?php 
                        echo $this->renderPartial('_tickets', array('tickets'=>$this->tickets),true);
                      ?>
                  </div>
                  <div class="tab-pane fade" id="tabProfile4">
                      <?php 
                        $panel3=CHtml::ajaxButton ("Save",
                            CController::createUrl('users/editNewsletter'), 
                            array('update' => '#newsForm',
                                    'type' => 'POST', 
                                    'data'=>'js:$("#newsletter-form").serialize()',
                            ));
                        $panel3.=$this->renderPartial('_newsletter', array('model'=>$model),true);
                        echo $panel3;
                      ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>