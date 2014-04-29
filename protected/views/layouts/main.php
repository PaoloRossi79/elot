<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        
        <?php 
        header("Access-Control-Allow-Origin: facebook.com");
        header("Access-Control-Allow-Origin: google.com");
        ?>
        
        <?php 
            //Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/screen.css','screen, projection');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/print.css','print');
        ?>
        <?php 
            Yii::app()->getClientScript()->registerCssFile('//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css','screen');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/form.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/stile.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/homepage.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/main-slider.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/js/tooltip/tipsy.css');
            Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl.'/css/isotope.css');
            
            Yii::app()->getClientScript()->registerCoreScript('jquery'); 
            Yii::app()->getClientScript()->registerCoreScript('jquery.ui'); 
            Yii::app()->getClientScript()->registerScriptFile('//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.galleriffic.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/ie-fade.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main-js.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/slimscroll.min.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/main-slider.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/tooltip/tipsy.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.isotope.min.js',CClientScript::POS_HEAD);
            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.slides.min.js',CClientScript::POS_HEAD);
//            Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl.'/js/galleria/galleria-1.3.5.min.js',CClientScript::POS_HEAD);
        ?>
        
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header" class='row'>
		<div id="fixed-cart">
                    <div id="header-logo-div">
                        <a href="/">
                            <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/logo.png", "WonLot", array("class"=>"site-main-logo img-responsive")); ?>
                        </a>
                    </div>
                    <div id="header-icons">
                        <?php if(!Yii::app()->user->isGuest){ ?>
                            <div class="header-icon">
                                <?php 
                                $controller = Yii::app()->getController();
                                $originUrl = $controller->getId() . '/' . $controller->getAction()->getId();
                                ?>
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/logout?origin=<?php echo $originUrl; ?>">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-logout.png", "Logout", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <a href="#">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-help.png", "Help", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/users/myProfile">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-profile.png", "My Profile", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>
<!--                            <div class="header-icon">
                               <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/tickets/index">
                                   <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-ticket.png", "My Tickets", array("class"=>"img-responsive")); ?>
                               </a>
                            </div>-->
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/userIndex">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-mylottery.png", "My Lotteries", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>
                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-lottery.png", "Lotteries", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>
                          <?php } else { ?>
                            <div class="header-icon">
                                <a href="#">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-help.png", "Help", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>
<!--                            <div class="header-icon">
                                <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/lotteries/index">
                                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-lottery.png", "Lotteries", array("class"=>"img-responsive")); ?>
                                </a>
                            </div>-->
                            <div class="header-icon">
                               <a href="<?php echo Yii::app()->getBaseUrl();?>/index.php/site/register">
                                   <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-register.png", "Register", array("class"=>"img-responsive")); ?>
                               </a>
                            </div>
                            <div class="login-block header-icon">
                              <a href="" data-toggle="modal" data-target="#loginModal">
                                  <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-login.png", "Login", array("class"=>"img-responsive")); ?>
                              </a>
                            </div>
                          <?php }  ?>
                    </div>
                 </div>
	</div><!-- header -->
        <?php // if(Yii::app()->user->isGuest) { ?>
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" id='loginModalContent'>
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <div class="login-block">
                    <?php echo CHtml::image(Yii::app()->baseUrl."/images/site/icon-login.png", "Login", array("class"=>"img")); ?>
                    <div class="modal-title inline upper-label" id="myModalLabel">Login</div>
                  </div>
                </div>
                <?php $this->renderPartial('/site/login'); ?>
              </div>
            </div>
        </div>
        <?php //} ?>
            
        <div id="body-container" class="row">
            <?php echo $content; ?>
        </div>

	<div class="clear"></div>

	<div class="footer row">
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