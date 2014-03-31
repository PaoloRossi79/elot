<?php 
    if($model->ext_source > 1){
        //echo CHtml::image($model->profile->img, "User Avatar", array("class"=>"user-avatar"));
        // TODO: get Image from socials
    } else {
        echo CHtml::image("/images/userProfiles/".Yii::app()->user->id."/boxThumb/".$model->profile->img, "User Avatar", array("class"=>"user-avatar img-thumbnail"));
    } ?>


<?php 
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userProfile-form',
            'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data'), // for inset effect
        )
    );
   
    $profile=$model->profile;
    if(!$profile){
        $profile = new UserProfiles();
    }
    $companyProfile=$model->companyProfile;
    if(!$companyProfile){
        $companyProfile = new CompanyProfiles();
    }
?>
        <div class="form-group">
            <?php if($model->user_type_id == Yii::app()->user->userTypes['admin']){ ?>
                <p>Sei un <b>ADMIN!</b></p>
            <?php } else { ?>
                <?php echo $form->errorSummary($model); ?>
                <?php $profileTypes = array(1 => 'Privato', 3 => 'Azienda');
                echo $form->radioButtonList($model, "user_type_id", $profileTypes, array('id'=>'userTypeRadio')); 
                ?>
            <?php } ?>
        </div>
        <div id="private-profile" <?php echo ($model->user_type_id == 1 || !$model->user_type_id) ? "" : 'style="display: none"'; ?>>
            <div class="form-group">
                <?php echo $form->labelEx($profile,'first_name',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($profile, 'first_name', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($profile,'last_name',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($profile, 'last_name', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>

            <div class="form-group">
                <?php echo $form->errorSummary($profile); ?>
                <?php $genders = array('M' => 'uomo', 'F' => 'donna');
                echo $form->radioButtonList($profile, "gender", $genders); 
                ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($profile,'description',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textArea($profile, 'description', array('class' => 'col-sm-6','rows'=>10)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($profile,'cod_fisc',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($profile, 'cod_fisc', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>
            
        </div>
        
        <div id="company-profile" <?php echo ($model->user_type_id == 3) ? "" : 'style="display: none"'; ?>>
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'legal_name',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($companyProfile, 'legal_name', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>

            <div class="form-group">
                <?php echo $form->errorSummary($companyProfile); ?>
                <?php 
                echo $form->radioButtonList($companyProfile, "company_type", Yii::app()->params['companyTypes']); 
                ?>
            </div>
            
            <div class="form-group">
                <?php 
                    echo $form->labelEx($companyProfile,'category');
                    echo $form->dropDownList($companyProfile,'category', PrizeCategories::model()->getPrizeCatCheckbox());
                ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'description',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textArea($companyProfile, 'description', array('class' => 'col-sm-6','rows'=>10)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'cod_fisc',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($companyProfile, 'cod_fisc', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'vat',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($companyProfile, 'vat', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'ref_name',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($companyProfile, 'ref_name', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'ref_email',array('class'=>'col-sm-2 control-label'));?>
                <?php echo $form->textField($companyProfile, 'ref_email', array('class' => 'col-sm-6','size'=>45,'maxlength'=>45)); ?>
            </div>
        </div>

	<div class="form-group">
            <?php echo $form->labelEx($this->locationForm,'address',array('class'=>'col-sm-2 control-label'));?>
            <div class="col-sm-6">
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
            </div>
        </div>
	
        <div class="form-group">
            <div id="user_img">
                <?php
                    //echo $form->labelEx($model,'photos');
                    $this->widget( 'xupload.XUpload', array(
                        'url' => Yii::app( )->createUrl( "/userProfiles/upload"),
                        //our XUploadForm
                        'model' => $this->upForm,
                        //We set this for the widget to be able to target our own form
                        'htmlOptions' => array('id'=>'userProfile-form'),
                        'attribute' => 'file',
                        'multiple' => false,
                        'showForm' => false,
                        )    
                    );
                ?>
            </div>
        </div>
        
<?php
    //Yii::import('ext.gmap.*');
    $gMap = new EGMap();
    $gMap->zoom = 10;
    $mapTypeControlOptions = array(
      'position'=> EGMapControlPosition::LEFT_BOTTOM,
      'style'=>EGMap::MAPTYPECONTROL_STYLE_DROPDOWN_MENU
    );

    $gMap->mapTypeControlOptions= $mapTypeControlOptions;

    $gMap->setCenter(39.721089311812094, 2.91165944519042);

    // Create GMapInfoWindows
    $info_window_a = new EGMapInfoWindow('<div>I am a marker with custom image!</div>');
    $info_window_b = new EGMapInfoWindow('Hey! I am a marker with label!');

    $icon = new EGMapMarkerImage("http://google-maps-icons.googlecode.com/files/gazstation.png");

    $icon->setSize(32, 37);
    $icon->setAnchor(16, 16.5);
    $icon->setOrigin(0, 0);

    // Create marker
    $marker = new EGMapMarker(39.721089311812094, 2.91165944519042, array('title' => 'Marker With Custom Image','icon'=>$icon));
    $marker->addHtmlInfoWindow($info_window_a);
    $gMap->addMarker($marker);

    // Create marker with label
    $marker = new EGMapMarkerWithLabel(39.821089311812094, 2.90165944519042, array('title' => 'Marker With Label'));

    $label_options = array(
      'backgroundColor'=>'yellow',
      'opacity'=>'0.75',
      'width'=>'100px',
      'color'=>'blue'
    );

    /*
    // Two ways of setting options
    // ONE WAY:
    $marker_options = array(
      'labelContent'=>'$9393K',
      'labelStyle'=>$label_options,
      'draggable'=>true,
      // check the style ID 
      // afterwards!!!
      'labelClass'=>'labels',
      'labelAnchor'=>new EGMapPoint(22,2),
      'raiseOnDrag'=>true
    );

    $marker->setOptions($marker_options);
    */

    // SECOND WAY:
    $marker->labelContent= '$425K';
    $marker->labelStyle=$label_options;
    $marker->draggable=true;
    $marker->labelClass='labels';
    $marker->raiseOnDrag= true;

    $marker->setLabelAnchor(new EGMapPoint(22,0));

    $marker->addHtmlInfoWindow($info_window_b);

    $gMap->addMarker($marker);

    // enabling marker clusterer just for fun
    // to view it zoom-out the map
    $gMap->enableMarkerClusterer(new EGMapMarkerClusterer());

//    $gMap->renderMap();
?>
<style type="text/css">
.labels {
   color: red;
   background-color: white;
   font-family: "Lucida Grande", "Arial", sans-serif;
   font-size: 10px;
   font-weight: bold;
   text-align: center;
   width: 40px;     
   border: 2px solid black;
   white-space: nowrap;
}
</style>

	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva'); ?>
	</div>

<?php $this->endWidget(); ?>