<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

        <?php 
            //Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/screen.css','screen, projection');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/print.css','print');
        ?>
        <!--[if lt IE 8]>
        <?php 
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/ie.css','screen, projection');
        ?>
	<![endif]-->
        <!--[if IE 7]>
        <?php 
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/media/font-awesome/css/font-awesome-ie7.min.css');
        ?>
	<![endif]-->
        <?php 
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/boostrap3/css/bootstrap.min.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/form.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/stile.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/homepage.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/checkbox.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/main-slider.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/js/tooltip/tipsy.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/stile-pulsanti.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/geocode.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/isotope.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/media/font-awesome/css/font-awesome.min.css','screen');
            
            Yii::app()->getClientScript()->registerCoreScript('jquery'); 
            Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); 
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.galleriffic.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/ie-fade.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main-js.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/slimscroll.min.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main-slider.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/tooltip/tipsy.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.isotope.min.js',CClientScript::POS_HEAD);
        ?>
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="fixed-cart">
                    <div id="header-logo-div">
                        <a href="/">
                            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/logo.png", "E-Lot",array("class"=>"site-main-logo")); ?>
                        </a>
                    </div>
                    <div id="header-icons">
                        <?php if(!Yii::app()->user->isGuest){ ?>
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/users/myProfile" class="tooltip-down" title="<?php echo Yii::t('elot','profile') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-profile.png", "My Profile"); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                               <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/tickets/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>">
                                   <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-ticket.png", "My Tickets"); ?>
                               </a>
                            </div>
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/userIndex" class="tooltip-down" title="<?php echo Yii::t('elot','my lotteries') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-mylot.png", "My Lotteries"); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','search lotteries') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-lot.png", "Lotteries"); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <a href="#" class="tooltip-down" title="<?php echo Yii::t('elot','help') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-help.png", "Help"); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <?php 
                                $controller = Yii::app()->getController();
                                $originUrl = $controller->getId() . '/' . $controller->getAction()->getId();
                                ?>
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/logout?origin=<?php echo $originUrl; ?>" class="tooltip-down" title="<?php echo Yii::t('elot','logout') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-logout.png", "Logout"); ?>
                                </a>
                            </div>
                          <?php } else { ?>
                            <div class="header-icon">
                               <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/register" class="tooltip-down" title="<?php echo Yii::t('elot','register') ?>">
                                   <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-register.png", "Register"); ?>
                               </a>
                            </div>
                            <div class="login-block header-icon">
                              <a id="login-button" class="tooltip-down" title="<?php echo Yii::t('elot','login') ?>">
                                  <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-login.png", "Login"); ?>
                              </a>
                              <div class="">
                                  <?php $this->renderPartial('/site/login'); ?>
                              </div>
                            </div>
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','search lotteries') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-lot.png", "Lotteries"); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <a href="#" class="tooltip-down" title="<?php echo Yii::t('elot','help') ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-help.png", "Help"); ?>
                                </a>
                            </div>
                          <?php }  ?>
                    </div>
                 </div>
	</div><!-- header -->
        
<!--        <div id="mainmenu">
		<?php /*$this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Register', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Lotterie', 'url'=>array('/lotteries'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		)); */?>
	</div> mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div class="footer row-fluid">
         <div class="main-width">
            <div class="footer-left">
               <div class="footer-subtitle" style="float:left;">
                  <a href="#" class="tooltip-down" title="Twitter"><i class="icon-twitter"></i></a>
                  <a href="#" class="tooltip-down" title="Facebbok"><i class="icon-facebook"></i></a>
                  <a href="#" class="tooltip-down" title="Instagram"><i class="icon-instagram"></i></a>
               </div>
            </div>
            <div class="footer-middle">
               <h3>Come funziona?</h3>
               <p>
                   <b><?php echo CHtml::encode(Yii::app()->name); ?></b> è un portale che ti permette di partecipare e vincere ad un mondo di lotterie create dagli utenti.
               </p>
               <p>
                  Hai bisogno di aiuto per usare <?php echo CHtml::encode(Yii::app()->name); ?>? Puoi trovare tutte le risposte alla sezione "Come Funziona".
               </p>
               <p class="footer-link">
                  <a href="#">Scopri come funziona &raquo;</a>
               </p>
            </div>
            <div class="footer-right">
               <p>
                  <a href="#">Informativa sulla privacy</a><br/>
                  <a href="#">Termini & Condizioni</a><br/>
               </p>
            </div>
            <div class="clear"></div>
         </div>
      </div>
      <div class="gototop-fixed"><a href="#" class="icon-circle-arrow-up tooltip-left gototop" title="Torna a inizio pagina"></a></div>
</div><!-- page -->
<?php Yii::app()->clientScript->registerCoreScript('jquery', CClientScript::POS_HEAD);?>
</body>
</html>
