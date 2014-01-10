<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/stile.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/homepage.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/checkbox.css"/>
        <link rel="stylesheet" type="text/css" href="css/main-slider.css"/>
        <link rel="stylesheet" type="text/css" href="js/tooltip/tipsy.css"/>
        <link rel="stylesheet" type="text/css" href="css/stile-pulsanti.css"/>
        <link rel="stylesheet" type="text/css" href="css/geocode.css"/>
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/media/font-awesome/css/font-awesome.min.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/media/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        
        <?php 
            Yii::app()->getClientScript()->registerCoreScript('jquery'); 
            Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); 
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.galleriffic.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/ie-fade.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main-js.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/slimscroll.min.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main-slider.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/tooltip/tipsy.js',CClientScript::POS_HEAD);
        ?>
    	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="fixed-cart">
                    <table cellpadding="0" cellspacing="0" border="0">
                       <tr>
                          <td style="width:100%;text-align:left;vertical-align:top;">
                             <div style="position:relative">
                                <a href="#"><img src="images/site/logo.png" alt="Sezione Regalo" class="site-main-logo"/></a>
                                <p>E-Lot</p>
                             </div>
                          </td>
                          <td class="cart-label">
                             <a href="#" class="tooltip-down" title="Carrello">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-elements">0</span>
                             </a>
                          </td>
                          <td class="cart-label">
                             <a href="#" class="tooltip-down" title="Profilo personale"><i class="icon-user"></i></a>
                          </td>
                          <td class="cart-label">
                             <a href="#" class="tooltip-down" title="Voucher acquistati"><i class="icon-ticket"></i></a>
                          </td>
                          <td class="cart-label">
                              <a href="#" class="tooltip-down" title="Lista dei desideri"><i class="icon-heart"></i></a>
                          </td>
                          <td class="cart-label">
                              <a href="#" class="tooltip-down" title="Serve aiuto?"><i class="icon-question"></i></a>
                          </td>
                          <td class="cart-label">
                              <a href="#" class="tooltip-down" title="Logout"><i class="icon-signout"></i></a>
                          </td>
                       </tr>
                    </table>
                 </div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Register', 'url'=>array('/site/register'), 'visible'=>Yii::app()->user->isGuest),
//                                array('label'=>'Login', 'url'=>'#','linkOptions'=>array( 'onclick'=>'$("#userloginwidget").dialog("open"); return false;'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Lotterie', 'url'=>array('/lotteries'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div class="footer">
         <div class="main-width">
            <div class="footer-left">
               <img src="img/logo-blu.png" alt="Sezione Regalo" style="float:left;"/>
               <div class="footer-subtitle" style="float:left;">
                  <a href="#" class="tooltip-down" title="Twitter"><i class="icon-twitter"></i></a>
                  <a href="#" class="tooltip-down" title="Facebbok"><i class="icon-facebook"></i></a>
                  <a href="#" class="tooltip-down" title="Instagram"><i class="icon-instagram"></i></a>
               </div>
            </div>
            <div class="footer-middle">
               <h3>Come funziona?</h3>
               <p>
                  <?php echo SITE_NAME;?> è un portale che ti aiuta a scoprire le attività migliori nella tua zona, nella tua città o nelle località che visiti.
               </p>
               <p>
                  Hai bisogno di aiuto ad acquistare o non sai come utilizzare il voucher una volta acquistato? Puoi trovare tutte le risposte alla sezione "Come Funziona".
               </p>
               <p class="footer-link">
                  <a href="#">Scopri come funziona &raquo;</a>
               </p>
            </div>
            <div class="footer-right">
               <p>
                  <a href="#">Informativa sulla privacy</a><br/>
                  <a href="#">Termini & Condizioni</a><br/>
                  <a href="#">Diventa partner</a>
               </p>
               <p>
                  <a href="#">Il mio profilo personale</a><br/>
                  <a href="#">I miei voucher</a>
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
