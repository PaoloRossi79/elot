//Fa lo scroll ad un certo elemento, se offset è true si ferma 60px prima
function scrollTo(element, offset){
   var offset_n = 0;
   if (offset) var offset_n = 60;
   $('html,body').animate({scrollTop: $(element).offset().top - offset_n},'slow');
};

//Cambia la grafica di checkbox e radio
function setupLabel() {
  if ($('.label_check input').length) {
      $('.label_check').each(function(){ 
          $(this).removeClass('c_on');
      });
      $('.label_check input:checked').each(function(){ 
          $(this).parent('label').addClass('c_on');
      });                
  };
  if ($('.label_radio input').length) {
      $('.label_radio').each(function(){ 
          $(this).removeClass('r_on');
      });
      $('.label_radio input:checked').each(function(){ 
          $(this).parent('label').addClass('r_on');
      });
  };
};

//Mette un div a fixed al raggiungimento di un certo valore di scroll h
function fixDiv(divclass,h) {
  if (divclass === '.gototop-fixed') h = $('#fixed-cart').height()+$('.main-inserzioni').height()-150;
  if ($(window).scrollTop() > h) 
    $(divclass).css({'display': 'block'}); 
  else
    $(divclass).css({'display': 'none'});
};

$(window).resize(function(){
   
});

$(window).scroll(function(){
   fixDiv('.gototop-fixed',0);
   //fixDiv('#fixed-cart',$('.header').height());
});

$(document).ready(function() {
   
   //Inizializza l'autocomplete Google Maps
//   geoInitialize();
   
   $('.label_check, .label_radio').click(function(){
      setupLabel();
   });
   setupLabel();
});

$(function() {
   
   $(".nogo").click(function(e){
     e.preventDefault();
     return false;
  });
  
  $(".gototop").click(function(e){
     e.preventDefault();
     $('.tipsy').hide();
     scrollTo('.hidden-top',0);
  });

   //Inserzioni a scorrimento in main (+ i click sulle frecce)
   var mainslider = $('.main-inserzioni').unslider({
      fluid: true,
      speed: 500,
      complete: function() { }
   });
   $('.slider-arrow').click(function(e){
      e.preventDefault();
      var fn = this.className.split(' ')[1];
      mainslider.data('unslider')[fn]();
   });
   
   //Inizializziamo i tooltip
   $('.tooltip').tipsy();
   $('.tooltip-down').tipsy({gravity: 'n', html: true});
   $('.tooltip-up').tipsy({gravity: 's', html: true}); 
   $('.tooltip-right').tipsy({gravity: 'w', html: true});
   $('.tooltip-left').tipsy({gravity: 'e', html: true}); 
   
   //Filtri
   
   $('.filter-categories').mouseenter(function(){
      $('#fc-list-box').stop(true,true).fadeIn();
      $('.fc-list').slimScroll({
         height: '200px',
         railVisible: true,
         alwaysVisible: true,
         allowPageScroll: false,
         disableFadeOut: true
      });
   }).mouseleave(function(){
      $('#fc-list-box').delay(600).fadeOut();
   });
   $('.select-all').click(function(){
      $("#fc-list-box input").prop('checked', true);
      setupLabel();
   });
   $('.deselect-all').click(function(){
      $("#fc-list-box input").prop('checked', false);
      setupLabel();
   });
   
   fixDiv('.gototop-fixed',0);
   //fixDiv('#fixed-cart',$('.header').height());

});
