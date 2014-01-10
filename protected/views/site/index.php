<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

   <div class="hidden-top"></div>
   <div class="main-inserzioni-container">
      <div class="main-inserzioni">
         <ul>
            <li style="background-image: url(<?php echo $this->getImageUrl("lottery","Mercedes-SL63-AMG.jpg",'mediumSquaredThumb'); ?>);">
               <div class="main-width" align="right">
                  <div class="main-to-align">
                     <div class="main-box">
                        <div class="main-padding">
                           <h2>Vinci una Mercedes SL!</h2>
                           <div class="main-box-subtitle">
                              Lotteria da 5000 biglietti
                           </div>
                           <div class="main-box-text">
                             In premio una splendida Mercedes SL nuova...tutta da vincere!!!
                           </div>
                           <div class="main-box-price">Costo: 3 <span class="euro">eeMoney</span></div>
                           <div class="main-more-details"><a href="#" class="button medium white">Dettagli</a></div>
                           <div class="clear"></div>
                        </div>
                     </div> 
                  </div>
               </div>
              </li>
          </ul>
         <a href="#" class="slider-arrow prev icon-chevron-left tooltip-right" title="Inserzione precedente"></a>
         <a href="#" class="slider-arrow next icon-chevron-right tooltip-left" title="Inserzione successiva"></a>
      </div>
   </div>
   <div class="inserzioni-side main-width">
         
         <center>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Quelli mostrati sono le lotterie più seguite su <i><?php echo CHtml::encode(Yii::app()->name); ?></i>
            </div>
         </center>
         
         <div class="side-single-box">
            <div class="inserzioni-margin">
               <img src="img/prova-side.jpg" alt="Foto Premio" class="side-img"/>
               <div class="side-fix-height">
                  <div class="side-box-title">
                     Camicia "Emporio Armani"
                  </div>
                  <div class="side-box-subtitle">
                     Padova
                  </div>
                  <div class="side-box-text">
                    Camicia da uomo di "Emporio Armani"
                  </div>
               </div>
               <div class="side-box-price">78,00<span class="euro">eeMoney</span></div>
               <div class="side-more-details"><a href="#" class="button small white">Dettagli</a></div>
               <div class="clear"></div>
            </div>
         </div>
         
         <div class="clear"></div>
         <!--
         <div class="loading-more-container">
            <span class="loading-more">Caricamento altre offerte. Per favore attendi...</span>
         </div>
         -->
      </div>
      
   