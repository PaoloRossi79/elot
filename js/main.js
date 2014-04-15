// executed after ALL (also after document.ready !!!)
$(window).bind("load", function() {
   $('.isotope').isotope('reLayout');
   $('#show-filter').click(function(){
       if($('#search-column').css('display') == "none"){
           $(this).removeClass('glyphicon-zoom-in');
           $(this).addClass('glyphicon-zoom-out');
           $('#show-search').fadeOut({
               complete: function(){
                   $('#hide-search').fadeIn();
               }
           });
           $('#search-column').fadeIn();
       } else {
           $(this).removeClass('glyphicon-zoom-out');
           $(this).addClass('glyphicon-zoom-in');
           $('#hide-search').fadeOut({
               complete: function(){
                   $('#show-search').fadeIn();
               }
           });
           $('#search-column').fadeOut();
       }
   });
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
   $('#lot_location').keydown(function (e) {
        if (e.which == 13){
            return false;
        } else {
            var t=1;
        }
   });
   $('.cat-list li').click(function(event){
       $('#cat-sel').text(event.target.id);
       $('#SearchForm_Category').val(event.target.dataset.id);
   });
   $("[name='Users[user_type_id]']").change(function(event){
       var userType = $(this).val();
       if(userType == 3){
           $('#private-profile').fadeOut();
           $('#company-profile').fadeIn();
       } else {
           $('#company-profile').fadeOut();
           $('#private-profile').fadeIn();
       }
   });
   
   $('.zocial').click(function(event){
       $('#labelProvider').text($(this).val());
       $('.box-spinner').show();
   });
   
   $('#gift-back').click(function(event){
       $("#gift-modal").modal('hide');
       $('#buy-modal').modal('show');
   });
   
   $('.lot-item').click(function(event){
       $(".ticket-lot").fadeOut();
       $("#ticket-lot-"+this.id).fadeIn();
   });
});
