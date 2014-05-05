<?php 
    if($model->ext_source > 1){
        //echo CHtml::image($model->profile->img, "User Avatar", array("class"=>"user-avatar"));
        // TODO: get Image from socials
        echo "<img src='".$model->profile->img."' style='width:200px;heigth:200px;'/>";
    } else {
        echo CHtml::image("/images/userProfiles/".Yii::app()->user->id."/boxThumb/".$model->profile->img, "User Avatar", array("class"=>"user-avatar img-thumbnail"));
    } ?>


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
        <div class="form-group">
            <?php if($model->user_type_id == Yii::app()->user->userTypes['admin']){ ?>
                <p>Sei un <b>ADMIN!</b></p>
            <?php } else { ?>
                <?php echo $form->errorSummary($model); ?>
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
        <div id="private-profile" <?php echo ($model->user_type_id == 1 || !$model->user_type_id) ? "" : 'style="display: none"'; ?>>
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
                <div class="col-sm-6 col-sm-offset-2">
                    <?php echo $form->errorSummary($profile); ?>
                    <?php $genders = array('M' => 'uomo', 'F' => 'donna');
                    echo $form->radioButtonList($profile, "gender", $genders,array('class'=>'form-control')); 
                    ?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'description',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textArea($profile, 'description', array('class' => '','rows'=>10)); ?>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2">
                    <?php echo $form->labelEx($profile,'cod_fisc',array('class'=>'control-label'));?>
                </div>
                <div class="col-sm-6">
                    <?php echo $form->textField($profile, 'cod_fisc', array('class' => '','size'=>45,'maxlength'=>45)); ?>
                </div>
            </div>
            
        </div>
        
        <div id="company-profile" <?php echo ($model->user_type_id == 3) ? "" : 'style="display: none"'; ?>>
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'legal_name',array('class'=>'control-label'));?>
                <?php echo $form->textField($companyProfile, 'legal_name', array('class' => '','size'=>45,'maxlength'=>45)); ?>
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
                <?php echo $form->labelEx($companyProfile,'description',array('class'=>'control-label'));?>
                <?php echo $form->textArea($companyProfile, 'description', array('class' => '','rows'=>10)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'cod_fisc',array('class'=>'control-label'));?>
                <?php echo $form->textField($companyProfile, 'cod_fisc', array('class' => '','size'=>45,'maxlength'=>45)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'vat',array('class'=>'control-label'));?>
                <?php echo $form->textField($companyProfile, 'vat', array('class' => '','size'=>45,'maxlength'=>45)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'ref_name',array('class'=>'control-label'));?>
                <?php echo $form->textField($companyProfile, 'ref_name', array('class' => '','size'=>45,'maxlength'=>45)); ?>
            </div>
            
            <div class="form-group">
                <?php echo $form->labelEx($companyProfile,'ref_email',array('class'=>'control-label'));?>
                <?php echo $form->textField($companyProfile, 'ref_email', array('class' => '','size'=>45,'maxlength'=>45)); ?>
            </div>
        </div>

	<div class="form-group">
            <?php echo $form->labelEx($this->locationForm,'address',array('class'=>'control-label'));?>
            <div class="col-sm-6">
            <?php 
                /* http://www.yiiframework.com/extension/egmap/ */
                $this->widget('gmap.EGMapAutocomplete', array(
                    'name' => 'lot_location',
                    'model' => $this->locationForm,
                    'attribute' => 'address',
                ));
                ?>
            </div>
        </div>
	
        <div class="form-group">
            <div id="user_img">
                <?php
                    if($model->ext_source == 0 || $model->ext_source == 1){
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
                    }
                ?>
            </div>
        </div>
        
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crea' : 'Salva'); ?>
	</div>

<?php $this->endWidget(); ?>

<h3><?php echo Yii::t("wonlot","Inserisci i dati di pagamento"); ?></h3>
<div class="text-block">
    <?php $this->widget(payLotteryInfoWidget,array()); ?>
</div>