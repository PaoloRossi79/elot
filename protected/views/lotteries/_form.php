<div class="panel panel-default bootstrap-widget-table">
    <div class="panel-heading">
      <h3 class="panel-title">
          <?php 
             if($model->id){
                  echo Yii::t('wonlot','Edit Lottery') . " " .$model->name;
             } else {
                  echo Yii::t('wonlot','Create Lottery');
             }
          ?>
      </h3>
    </div>
    <div class="panel-body">
        <div class="form">
        <?php
        //$form->setId('lot-form');
        echo $form->renderBegin();
        ?>
        <!--SAVED IMG SECTION-->
          <div class="">
            <?php if(!empty($form->model->id)){ ?>
              <?php $this->renderPartial('_setDefaultImage',array('data'=>$form->model)); ?>
            <?php } ?>
          </div>
        <?php
        //echo $form->getActiveFormWidget()->errorSummary(array($form['deal']->model, $form['clone']->model));
        echo $form->renderElements();
        /*foreach($form->getElements() as $k=>$element){
            echo $element->render();
        }*/
        ?>
            <?php 
            /* http://www.yiiframework.com/extension/egmap/ */
            $this->widget('gmap.EGMapAutocomplete', array(
                'name' => 'lot_location',
                'model' => $this->locationForm,
                'attribute' => 'address',
                'options' => array(
                   'types' => array(
                     '(cities)'
                   ),
                   /*'componentRestrictions' => array(
                      'country' => 'us',
                    )*/
                )
            ));
            ?>

            <div id="prize_img">
            <?php
                //echo $form->labelEx($model,'photos');

                $this->widget( 'xupload.XUpload', array(
                    'url' => Yii::app( )->createUrl( "/lotteries/upload"),
                    'model' => $this->upForm,
                    'htmlOptions' => array('id'=>'lot-form'),
                    'attribute' => 'file',
                    'multiple' => true,
                    'showForm' => false,
                    'entityModel' => $form->model,
                    )    
                );
            ?>
            </div>
        <?php
        echo $form->renderButtons();
        echo $form->renderEnd();
        ?>
        </div>
    </div>
</div>

