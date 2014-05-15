// executed after ALL (also after document.ready !!!)
$(window).bind("load", function() {
    
   //Bootstrap Tabs-Url Trick 
   var url = document.location.toString();
   if (url.match('#')) {
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
//        window.scrollTo(0, 0);
   } 

   // Change hash for page-reload
   $('.nav-tabs a').on('click', function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
   })
   //end Bootstrap Tabs-Url Trick 
    
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
       $('.labelProvider').text($(this).val());
       $('.box-spinner').show();
   });
   
   $('.lot-item').click(function(event){
       if(!$("#ticket-lot-"+this.id).is(":visible")){
            $(".ticket-block").fadeOut();
            $("#ticket-lot-"+this.id).fadeIn();
       }
   });
   
   $(".small-row-scroll").slimScroll({
        height: '120px',
        size: '5px',
   }); 
   
   $(".long-col-scroll").slimScroll({
        height: '200px',
        size: '5px',
   }); 
   
   $(".lot-box-int").mouseenter(
      function(){
        var hiddenDiv = $(this).parent().children('.lot-box-hover');
        hiddenDiv.filter(':not(:animated)').fadeIn();
      // This only fires if the row is not undergoing an animation when you mouseover it
      }
   );
   $(".lot-box-hover").mouseleave(
       function(){
        $(this).fadeOut();
      // This only fires if the row is not undergoing an animation when you mouseover it
      }
   );
   $(".favLotBtn").click(function(event){
       var btnClick = $(this);
       var url;
       if(btnClick.hasClass("unsetFav")){
           url = "/lotteries/unsetFavorite";
       } else if(btnClick.hasClass("setFav")){
           url = "/lotteries/setFavorite";
       }
       $.post( url , { lotId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    if(btnClick.hasClass("unsetFav")){
                        btnClick.removeClass("glyphicon-star");
                        btnClick.addClass("glyphicon-star-empty");
                        btnClick.removeClass("unsetFav");
                        btnClick.addClass("setFav");
                    } else if(btnClick.hasClass("setFav")){
                        btnClick.removeClass("glyphicon-star-empty");
                        btnClick.addClass("glyphicon-star");
                        btnClick.removeClass("setFav");
                        btnClick.addClass("unsetFav");
                    }
                }
       });
   });
   $(".follUserBtn").click(function(event){
       var btnClick = $(this);
       var url;
       if(btnClick.hasClass("unsetFav")){
           url = "/users/unsetFavorite";
       } else if(btnClick.hasClass("setFav")){
           url = "/users/setFavorite";
       }
       $.post( url , { userId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    if(btnClick.hasClass("unsetFav")){
                        btnClick.removeClass("glyphicon-star");
                        btnClick.addClass("glyphicon-star-empty");
                        btnClick.removeClass("unsetFav");
                        btnClick.addClass("setFav");
                    } else if(btnClick.hasClass("setFav")){
                        btnClick.removeClass("glyphicon-star-empty");
                        btnClick.addClass("glyphicon-star");
                        btnClick.removeClass("setFav");
                        btnClick.addClass("unsetFav");
                    }
                }
       });
   });
   $('.utsel').click(function(){
        var utid = $(this).attr('id');
        console.log(utid);
        console.log($(this).val());
        $('.utsel').removeClass('btn-primary');
        $('.utsel').removeAttr('disabled');
        $(this).attr('disabled','disabled');
        $(this).addClass('btn-primary');
        $('#Users_user_type_id').val(utid);
        if(utid == 3){
            $('#private-profile').fadeOut();
            $('#company-profile').fadeIn();
        } else {
            $('#company-profile').fadeOut();
            $('#private-profile').fadeIn();
        }
   });
   
   jQuery('body').on('click','.gift-ticket-btn',function(){
       var boxActive = $(this).attr('name');
       $('.labelProvider').text($(this).val());
       $('.gift-ticket-box').filter('[name='+boxActive+']').fadeIn();
       $('.gift-ticket-box').not('[name='+boxActive+']').fadeOut();
       $('.box-spinner').hide();
   });
   jQuery('body').on('click','.gift-ticket-social-btn',function(){
       var boxActive = $(this).attr('name');
       $('.labelProvider').text($(this).val());
       $('input[name=gift-provider]').val($(this).val());
       $('.gift-ticket-box').not('[name=0]').fadeOut();
       $('.gift-ticket-box').filter('[name=0]').fadeIn();   
       $('.box-spinner').show();
   });
   jQuery('body').on('click','.setFollow',function(event){
       if($(this).attr('id') == 1){
           if(!$('.following-box').is(":visible")){
               $('.following-box').fadeIn();
               $('.follower-box').fadeOut();
           }
       } else if($(this).attr('id') == 2){
           if(!$('.follower-box').is(":visible")){
               $('.follower-box').fadeIn();
               $('.following-box').fadeOut();
           }
       }
   });
   jQuery('body').on('click','.user-small-box',function(event){
       var id=$(this).children("input[name=id]").val();
       var username=$(this).children("input[name=username]").val();
       $('.user-small-box').removeClass('selected-box');
       $(this).addClass('selected-box');
       console.log(id);
       console.log(username);
       /*$('#gift-userid').val(id);
       $('#gift-username').val(username);*/
       $('input[name="gift-userid"]').val(id);
       $('input[name="gift-username"]').val(username);
       $('#gift-userid').val(id);
       $('#gift-username').val(username);
       $('input[name=ticketId]').val($('#ticketIdForGift').val());
   });
   jQuery('body').on('click','.user-small-ticket-box',function(event){
       var id=$(this).children("input[name=id]").val();
       var username=$(this).children("input[name=username]").val();
       $('.user-small-ticket-box').removeClass('selected-box');
       $(this).addClass('selected-box');
       console.log(id);
       console.log(username);
       $('input[name="gift-userid"]').val(id);
       $('input[name="gift-username"]').val(username);
       $('input[name=ticketId]').val($('#ticketIdForGift').val());
   });
   
   
   $.updateTicketGift = function(data){
       var res = $.parseJSON(data);
       if(res.exit){
            $(".giftSuccessText").show();
            $("input[name=giftBtn]").attr("disabled","disabled");
            $(".feedShare").attr("disabled","disabled");
            $(".giftText").append("<span class=\"bg-success\">Regalato!</span>");
            $("#ticket-lot-"+$("#ticketIdForGift").val()).append("<span class=\"ticket-gift-text bg-success\">Regalato!</span>");
            $("#"+$("#ticketIdForGift").val()).hide();
            $("#emailFormGroup").removeClass("has-error");
            $("#emailFormGroup").addClass("has-success");
            $(".giftErrorText").hide();
            $(".giftSuccessText").show();
            setTimeout(function() {
                $("#gift-modal").modal('hide');
                $("#buy-modal").modal('show');
                $.resetTicketGift();
            }, 3000);
       } else {
            $(".giftErrorText").text(res.msg);
            $(".giftErrorText").show();
       }
   };
   $.resetTicketGift = function(){
       $("#gift-ticket-follower-form").get(0).reset();
       $("#gift-ticket-following-form").get(0).reset();
       $('.user-small-ticket-box').removeClass('selected-box');
       $('.gift-ticket-box').fadeOut();
       $('input[name="gift-userid"]').val("");
       $('input[name="gift-username"]').val("");
       $('input[name=ticketId]').val("");
       $('#giftEmail').val("");
       $('.giftSuccessText').hide();
       $('.giftErrorText').hide();
   };
   
   jQuery('body').on('click','.notify-pop-btn',function(event){
      $.post( 'users/markNewNotifyRead' , { notifyId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    $('.notify-unread-count').html(0); 
                    $('.float-circle').hide(); 
                }
       });
   });
   jQuery('body').on('click','.notify-row',function(event){
       var sender = $(this);
       $.post( 'users/markNotifyRead' , { notifyId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    sender.removeClass('notify-unread');
                    sender.addClass('notify-read');
                }
       });
   });
   jQuery('body').on('click','#gift-back',function(event){
       try {
            $("#gift-modal").modal('hide');
       } catch(err) {
            //Handle errors here
       }
       $('#buy-modal').modal('show');
   });
   jQuery('body').on('click','.feedShare',function(){
        var button = $(this);
        var provider = $('input[name=gift-provider]').val();
        if(!$('input[name=gift-userid]').val()){
            $(".giftErrorText").text(noUserErrorMsg);
            $(".giftErrorText").show();
            return false;
        } else {
            $(".giftErrorText").hide();
        }
        if(provider == "Facebook"){
            FB.ui({method: 'feed',
                message: 'Ti ho regalato un biglietto su Wonlot.com!',
                //link: '<?php echo $this->createAbsoluteUrl('lotteries/getGift?tid='); ?>'+$("#ticketIdForGift").val(),
                link: baseTicketUrl+$("#ticketIdForGift").val(),
    //                                to: $(this).attr('id');
                to: '100004725912341'
            }, function(response){
                if(!response){
                    return false;
                } else if(response.error_code){
                    alert(response.error_msg);
                    return false;
                } else {
                    $.ajax({
                        'type':'POST',
                        'url':'/lotteries/gift',
                        'cache':false,
                        'data':{'provider': provider, 'userId': $('input[name=gift-userid]').val(), 'ticketId': $("#ticketIdForGift").val()},
                        'success':function(result){
                            $.updateTicketGift(result);
                        }
                    });
                }
            });
        } else if(provider == "Google"){
//            var shareLink = '<?php echo $this->createAbsoluteUrl('lotteries/getGift?tid='); ?>'+$("#ticketIdForGift").val();
            var shareLink = baseTicketUrl+$("#ticketIdForGift").val();
//            var baseLink = '<?php echo $this->createAbsoluteUrl(''); ?>';
            var baseLink = baseUrl;
            var shareMsg = "Ecco un Ticket in regalo per te su WonLot!";
            gpInviteBtnOptions.recipients=$('input[name="gift-userid"]').val();
            gpInviteBtnOptions.prefilltext=shareMsg;
            gpInviteBtnOptions.contenturl=baseLink;
            gpInviteBtnOptions.calltoactionurl=shareLink;
            gpInviteBtnOptions.gapiattached=true;
            gpInviteBtnOptions.class="g-interactivepost";
            gpInviteBtnOptions.onshare=function(response){
                if(response.status=="completed" && response.action=="cancelled"){
                    
                } else if(response.status=="completed" && response.action=="shared"){
                    $.ajax({
                        'type':'POST',
                        'url':'/lotteries/gift',
                        'cache':false,
                        'data':{'provider': provider, 'userId': $('input[name=gift-userid]').val(), 'ticketId': $("#ticketIdForGift").val()},
                        'success':function(result){
                            $.updateTicketGift(result);
                        }
                    });
                }
            };
//            gapi.interactivepost.render('gpshare-'+$("#ticketIdForGift").val(), gpInviteBtnOptions); 
            gapi.interactivepost.render('gpshare-gift', gpInviteBtnOptions); 
//            gapi.plus.render('gpshare-'+entityType+'-'+entityId, gpShareBtnOptions);
            setTimeout(function(){
                $('#gpshare-gift').click();
            },300);
        }
   });
    
   jQuery('body').on('click','.gp-gift',function() {
        var newParams = $.extend(gpdefaults, {'callback': $.gpGetFriends});
        gapi.auth.signIn(gpdefaults);
   });
   
   $.gpGetFriends = function(authResult){
       gapi.client.load('plus','v1', function(){
        if (authResult['access_token']) {
          var request = gapi.client.plus.people.list({
                'userId': 'me',
                'collection': 'visible'
            });
            request.execute(function(data) {
                console.log('gp-People', data);
                $('#social-friend-box').loadTemplate($("#gp-template"),data.items);
                $('.box-spinner').hide();
            });
        } else if (authResult['error']) {
          alert("Error Google Login");
        }
        console.log('authResult', authResult);
      });
   }
   
   jQuery('body').on('click','.fb-gift',function() {
       FB.getLoginStatus(function(response) {
            var shareLink = baseTicketUrl;
            var shareMsg = baseGiftMsg;
            if (response.status === 'connected') {
                $.fbGetFriends();
            } else {
                //user is not connected.
                FB.login(function(response) {
                    if (response.authResponse) {
                        $.fbGetFriends();
                    } else {
                        alert("Facebook Error");
                    }
                },fbScope);
            }
        });
   });
   
   $.fbGetFriends = function(){
       FB.api('/me/friends',function(response) {
           if (response && !response.error) {
               $.addTemplateFormatter("FbImageFormatter",
                    function(value, template) {
                        return "https://graph.facebook.com/"+value+"/picture";
               });
               $('#social-friend-box').loadTemplate($("#fb-template"),response.data);
               $('.box-spinner').hide();
           }
       });
   }   
   
   $.fbShare = function(){
       FB.ui({
            method: 'feed',
            link: link,
            caption: msg,
//                    actions: {'name': 'test', 'link': 'http://www.google.it'},
        }, function(response){
            alert('ok');
            alert(JSON.stringify(response));
        });
   }
   
   jQuery('body').on('click','.lot-btn-copy',function() {
       window.prompt("Copia negli appunti: Ctrl+C", $('#lot-txt-copy').val());
   });
   
   // PROFILE -> GIFT CREDIT
   $('#retrive-credit-show').click(function(event){
       $('#retrive-credit-panel').fadeIn();
       $('#retrive-credit-show').hide();
   });
   
   // share 
   jQuery('body').on('click','.fb-share',function(event) {
        FB.ui({
            method: 'feed',
            link: $('input[name=link]').val(),
        });
   });
   jQuery('body').on('click','.gp-share',function(event) {
        gapi.client.load('plus','v1', function(){
            var shareLink = $('input[name=link]').val();
            var baseLink = baseUrl;
            var shareMsg = "Vinci con WonLot!";
            gpInviteBtnOptions.prefilltext=shareMsg;
            gpInviteBtnOptions.contenturl=baseLink;
            gpInviteBtnOptions.calltoactionurl=shareLink;
            gpInviteBtnOptions.gapiattached=true;
            gpInviteBtnOptions.class="g-interactivepost";
            gapi.interactivepost.render('gpshare-lot', gpInviteBtnOptions); 
            setTimeout(function(){
                $('#gpshare-lot').click();
            },300); 
        });
   });
   jQuery('body').on('click','.tw-share',function(event) {
        FB.ui({
            method: 'feed',
            link: $('input[name=link]').val(),
        });
   });
});
