<div class="text-block">
    
<?php 
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'userProfile-form',
            'htmlOptions' => array('class' => 'form-horizontal','enctype' => 'multipart/form-data','role'=>'form'), // for inset effect
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
    <div class="row">
        <div>
            <?php 
            if($model->ext_source > 1){
                //echo CHtml::image($model->profile->img, "User Avatar", array("class"=>"user-avatar"));
                // TODO: get Image from socials
                echo "<img src='".$model->profile->img."' style='width:400px;heigth:400px;'/>";
            } else {
                echo Yii::app()->user->getAvatarUrl('mediumSquaredThumb');
            } ?>
        </div>
        <div id="user_img" class="pull-left">
            <?php
                if($model->ext_source == 0 || $model->ext_source == 1){
                    //echo $form->labelEx($model,'photos');
                    $this->widget( 'xupload.XUpload', array(
                        'url' => Yii::app( )->createUrl( "/userProfiles/upload"),
                        //our XUploadForm
                        'model' => $this->upForm,
                        //We set this for the widget to be able to target our own form
                        'htmlOptions' => array('id'=>'userProfile-form','class'=>'btn btn-primary'),
                        'attribute' => 'file',
                        'multiple' => false,
                        'showForm' => false,
                        )    
                    );
                }
            ?>
        </div>
    </div>
        <div class="form-group">
            <?php echo $form->errorSummary($model); ?>
            <?php if($model->user_type_id == Yii::app()->user->userTypes['admin']){ ?>
                <p>Sei un <b>ADMIN!</b></p>
            <?php } else { ?>
                <?php echo $form->hiddenField($model, 'user_type_id'); ?>
                <div class="radio col-sm-6 col-sm-offset-2">
                    <?php $profileTypes = array(1 => 'Privato', 3 => 'Azienda');
//                    echo $form->radioButtonList($model, "user_type_id", $profileTypes, array('id'=>'userTypeRadio','class'=>'radio')); 
                    ?>
                    <?php foreach($profileTypes as $k=>$pt){
                        if($k == $model->user_type_id){
                            echo CHtml::button($pt, array('id'=>$k,'class'=>'utsel btn btn-primary','disabled'=>'disabled'));
                        } else {
                            echo CHtml::button($pt, array('id'=>$k,'class'=>'utsel btn'));
                        }
                    } ?>
                </div>
                
            <?php } ?>
        </div>
        <div id="private-profile" <?php echo ($model->user_type_id == 1 || $model->user_type_id == Yii::app()->user->userTypes['admin'] || !$model->user_type_id) ? "" : 'style="display: none"'; ?>>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($model,'username',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'first_name',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($profile, 'first_name', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'last_name',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($profile, 'last_name', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'gender',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <div class="checkbox">
                        <?php echo $form->errorSummary($profile); ?>
                        <?php $genders = array('M' => 'uomo', 'F' => 'donna');
                        echo $form->radioButtonList($profile, "gender", $genders,array('class'=>'')); 
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2">
                    <?php //echo $form->labelEx($profile,'birthday',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <div class="checkbox">
                        <?php /* echo 
                            $this->widget('ext.EJuiDateTimePicker.EJuiDateTimePicker', array(
                                'id' => 'birthday',
                                'model' => $profile,
                                'attribute' => 'birthday',
                                'htmlOptions' => $htmlDisabled,
                                'options'=>array(
                                        'dateFormat'=>Yii::app()->params['toUserDateFormat'],
                                        'minDate'=>date('d/m/Y'),
                                        'timeFormat'=>Yii::app()->params['toUserTimeFormat'],
                                        'showSecond'=>false,
                                        'showTimezone'=>false,
                                        'language' => 'it',
                                        'ampm' => false,
                                        'showAnim'=>'fold',
                                ),
                                'language' => 'it',
                            ),true);*/
                        ?>
                        <?php //echo $form->error($profile,'birthday'); ?>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'description',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textArea($profile, 'description', array('class' => 'form-control','rows'=>10)); ?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'cod_fisc',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($profile, 'cod_fisc', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            
        </div>
        
        <div id="company-profile" <?php echo ($model->user_type_id == 3) ? "" : 'style="display: none"'; ?>>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'legal_name',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($companyProfile, 'legal_name', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->errorSummary($companyProfile); ?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->radioButtonList($companyProfile, "company_type", Yii::app()->params['companyTypes']); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'category',array('class' => 'control-label')); ?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->dropDownList($companyProfile,'category', PrizeCategories::model()->getPrizeCatCheckbox(),array('class' => 'form-control')); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'description',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textArea($companyProfile, 'description', array('class' => 'form-control','rows'=>10)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'cod_fisc',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($companyProfile, 'cod_fisc', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'vat',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($companyProfile, 'vat', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'ref_name',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($companyProfile, 'ref_name', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($companyProfile,'ref_email',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($companyProfile, 'ref_email', array('class' => 'form-control','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($this->locationForm,'address',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php 
                    /* http://www.yiiframework.com/extension/egmap/ */
                    $this->widget('gmap.EGMapAutocomplete', array(
                        'name' => 'lot_location',
                        'model' => $this->locationForm,
                        'attribute' => 'address',
                        'htmlOptions' => array('class'=>'form-control'),
                    ));
                    ?>
                </div>
            </div>
        </div>

	<div class="form-group buttons">
            <div class="col-sm-2">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva',array('class'=>'btn btn-primary')); ?>
            </div>
            <?php if(!$model->isNewRecord){ ?>
                <div class="col-sm-2">
                    <?php echo CHtml::ajaxButton('Cancella utente',Yii::app( )->createUrl( "/users/deleteMyUser"),
                            array(
                                'beforeSend'=>
                                    'js:function(){
                                        var res = confirm("Sei sicuro di voler cancellare il tuo profilo? L\'operazione non è annullabile");
                                        if(res == true){
                                            return true;
                                        } else {
                                            return false;
                                        }
                                    }'
                            ),
                            array('class'=>'btn btn-danger')); ?>
                </div>
            <?php } ?>
	</div>

<?php $this->endWidget(); ?>
</div>