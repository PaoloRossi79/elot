// executed after ALL (also after document.ready !!!)
$(window).bind("load", function() {
   $('.isotope').isotope('reLayout');
   $('#login-button').click(function(){
       $('.login-panel').toggle("fast");
   });
   $('#lotSearchForm').bind('keypress keydown keyup', function(e){
       if(e.keyCode == 13) { e.preventDefault(); }
   });
   $("#slideshow-container").slidesjs({
       width: 960,
       height: 380,
       navigation: {
            active: false,
            effect: "fade",
       },
       play: {
            active: false,
              // [boolean] Generate the play and stop buttons.
              // You cannot use your own buttons. Sorry.
            effect: "fade",
              // [string] Can be either "slide" or "fade".
            interval: 5000,
              // [number] Time spent on each slide in milliseconds.
            auto: true,
              // [boolean] Start playing the slideshow on load.
            swap: false,
              // [boolean] show/hide stop and play buttons
            pauseOnHover: true,
              // [boolean] pause a playing slideshow on hover
            restartDelay: 2500
              // [number] restart delay on inactive slideshow
          }
   });
      
   /*$('body').on('click','.buyButton',function(elem){
       var id=elem.srcElement.id;
       var ajaxOptButton={'url':'/index.php/lotteries/buyTicket/'+id,'cache':false,'success':function(html){$("#data-"+id).html(html)}};
       $.ajax(ajaxOptButton);return false;
   });*/
});
