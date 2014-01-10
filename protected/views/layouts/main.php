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
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/main.css');
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
                    <table cellpadding="0" cellspacing="0" border="0">
                       <tr>
                          <td class="cart-label">
                              <a href="/">
                                <i><?php echo CHtml::encode(Yii::app()->name); ?></i>
                              </a>
                          </td>
                          <td style="width:100%;text-align:left;vertical-align:top;">
                             <div style="position:relative">
                                <!--<a href="<?php echo Yii::app()->baseUrl; ?>">-->
                                <a href="/">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/logo.png", "E-Lot",array("class"=>"site-main-logo")); ?>
                                </a>
                             </div>
                          </td>
                          <?php if(!Yii::app()->user->isGuest){ ?>
                            <td class="cart-label">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/users/myProfile" class="tooltip-down" title="<?php echo Yii::t('elot','profile') ?>"><i class="icon-user"></i></a>
                            </td>
                            <td class="cart-label">
                               <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/tickets/index" class="tooltip-down" title="<?php echo Yii::t('elot','my tickets') ?>"><i class="icon-ticket"></i></a>
                            </td>
                            <td class="cart-label">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/userIndex" class="tooltip-down" title="<?php echo Yii::t('elot','my lotteries') ?>"><i class="icon-heart"></i></a>
                            </td>
                            <td class="cart-label">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','search lotteries') ?>"><i class="icon-legal"></i></a>
                            </td>
                            <td class="cart-label">
                                <a href="#" class="tooltip-down" title="<?php echo Yii::t('elot','help') ?>"><i class="icon-question"></i></a>
                            </td>
                            <td class="cart-label">
                                <?php 
                                $controller = Yii::app()->getController();
                                $originUrl = $controller->getId() . '/' . $controller->getAction()->getId();
                                ?>
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/logout?origin=<?php echo $originUrl; ?>" class="tooltip-down" title="<?php echo Yii::t('elot','logout') ?>"><i class="icon-signout"></i></a>
                            </td>
                          <?php } else { ?>
                            <td class="cart-label">
                               <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/register" class="tooltip-down" title="<?php echo Yii::t('elot','register') ?>"><i class="icon-user"></i></a>
                            </td>
                            <td class="login-block cart-label">
                              <!--<a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/login" class="tooltip-down" title="<?php echo Yii::t('elot','login') ?>"><i class="icon-signin"></i></a>-->
                              <a id="login-button" class="tooltip-down" title="<?php echo Yii::t('elot','login') ?>"><i class="icon-signin"></i></a>
                              <div class="login-panel">
                                  <?php $this->renderPartial('/site/login'); ?>
                                  <p>TEST</p>
                              </div>
                            </td>
                            <td class="cart-label">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index" class="tooltip-down" title="<?php echo Yii::t('elot','search lotteries') ?>"><i class="icon-legal"></i></a>
                            </td>
                            <td class="cart-label">
                                <a href="#" class="tooltip-down" title="<?php echo Yii::t('elot','help') ?>"><i class="icon-question"></i></a>
                            </td>
                          <?php }  ?>
                       </tr>
                    </table>
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
