// executed after ALL (also after document.ready !!!)
$(window).bind("load", function() {
   $('.isotope').isotope('reLayout');
   $('#login-button').click(function(){
       $('.login-panel').toggle("fast");
   });
   $('#lotSearchForm').bind('keypress keydown keyup', function(e){
       if(e.keyCode == 13) { e.preventDefault(); }
   });
      
   /*$('body').on('click','.buyButton',function(elem){
       var id=elem.srcElement.id;
       var ajaxOptButton={'url':'/index.php/lotteries/buyTicket/'+id,'cache':false,'success':function(html){$("#data-"+id).html(html)}};
       $.ajax(ajaxOptButton);return false;
   });*/
});
