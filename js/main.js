// executed after ALL (also after document.ready !!!)
$(window).bind("load", function() {
   var giftBoxActive;
   $('.profile-tab-item a').on('click', function (e) {
       $.each($(this).parent().parent().children('.profile-tab-item'), function(i,item){
           $(item).children().removeClass('btn-info');
       });
       $(this).addClass('btn-info');
   });
   //Bootstrap Tabs-Url Trick 
   var url = document.location.toString();
   if (url.match('#')) {
//        $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
        $('.nav-tabs a[href=#'+url.split('#')[1]+']').click();
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
   $('#show-ticket-filter').click(function(){
       $('#ticket-search').fadeIn(50);
       $('#show-ticket-button').hide();
   });
   $('#hide-ticket-filter').click(function(){
       $('#ticket-search').fadeOut(50);
       $('#show-ticket-button').show();
   });
   $('#login-button').click(function(){
       $('.login-panel').toggle("fast");
   });
   $('#lotSearchForm').bind('keypress keydown keyup', function(e){
       if(e.keyCode == 13) { e.preventDefault(); }
   });
   jQuery('body').on('click','.ticket-list-btn',function(){
        $('#myTickets'+this.id).click();
        if(!$("#ticket-lot-"+this.id).is(":visible")){
             $(".ticket-block").fadeOut();
             $("#ticket-lot-"+this.id).fadeIn();
        }
   });
   $.updatePagination = function(page){
       if(page == 0){
           
       }
   }
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
   
   
   
   $(".small-row-scroll").slimScroll({
        height: '120px',
        size: '5px',
   }); 
   
   $(".long-col-scroll").slimScroll({
        height: '200px',
        size: '5px',
   }); 
   
   $.checkDate = function(selDate){
       alert(selDate);
       alert(new Date(selDate,"dd/mm/yy hh:mm"));
   }
   
   $.checkMinDate = function(selDate){
        if(!$("#lot_start").datepicker("getDate")){
            $("#lot_start").datepicker("option","maxDate",selDate);
        }
   }
   $.checkMaxDate = function(selDate){
        if(!$("#lot_end").datepicker("getDate")){
            $("#lot_end").datepicker("option","minDate",selDate);
        }
   }
   
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
   $(".follUserBtn").click(function(event){
       var btnClick = $(this);
       var url;
       url = "/users/setFavorite";
       
       $.post( url , { userId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    btnClick.hide();
                    btnClick.parent().children(".unfollUserBtn").show();
                }
       });
   });
   $(".unfollUserBtn").click(function(event){
       var btnClick = $(this);
       var url;
       url = "/users/unsetFavorite";
       
       $.post( url , { userId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    btnClick.hide();
                    btnClick.parent().children(".follUserBtn").show();
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
       giftBoxActive = $(this).attr('name');
       $('input[name="GiftForm[provider]"]').val($(this).attr('value'));
       $('.gift-ticket-box').filter('[name='+boxActive+']').fadeIn();
       $('.gift-ticket-box').not('[name='+boxActive+']').fadeOut();
       $('.box-spinner').hide();
       $('.friend-box').fadeIn();
       $('.gift-panel-ok').hide();
       $('.gift-panel-err').hide();
   });
   jQuery('body').on('click','.gift-ticket-social-btn',function(){
       $('input[name="GiftForm[provider]"]').val($(this).val());
       $('.labelProvider').text($(this).val());
       $('.gift-ticket-box').not('[name=0]').fadeOut();
       $('.gift-ticket-box').filter('[name=0]').fadeIn();   
       $('.box-spinner').show();
       $('.friend-box').fadeIn();
       $('.gift-panel-ok').hide();
       $('.gift-panel-err').hide();
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
       $('input[name=ticketId]').val($('#ticketIdForGift').val());
   });
   jQuery('body').on('click','.user-small-ticket-box',function(event){
       var id=$(this).children("input[name=id]").val();
       var username=$(this).children("input[name=username]").val();
       $('.user-small-ticket-box').removeClass('selected-box');
       $(this).addClass('selected-box');
       console.log(id);
       console.log(username);
       $('input[name="GiftForm[giftToUserId]"]').val(id);
       $('input[name="GiftForm[giftToUsername]"]').val(username);
       $('#gift-to-header').text(" a: "+username);
       if(giftBoxActive == "fb"){
         $.feedShare("fb",id);
       } else if(giftBoxActive == "gp"){
         $.feedShare("gp",id);  
       }
   });
   
   $.updateBuySuccess = function(data){
        if(data.res == "1"){
          $("#alert-box").removeClass("alert-error");
          $("#alert-box").addClass("alert-success");
          $("#alert-box").fadeIn();
        } else {
          $("#alert-box").removeClass("alert-success");
          $("#alert-box").addClass("alert-error");
          $("#alert-box").fadeIn();
        }
        $("#alert-msg").text(data.msg);  
        if(data.isWinning && !data.newWinnerUser){
                $("#win-strong").text("Sei già in testa!");
                $("#win-msg").text("Sei già in testa con "+res.actWinnerValue);
                $("#alert-box").fadeIn();
        } else if(data.isWinning && data.newWinnerUser){
                $("#win-strong").text("Sei passato in testa");
                $("#win-msg").text("Sei passato in testa con "+res.newWinnerValue);
                $("#alert-box").fadeIn();
        } 
   }
   
   
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
            $(this).find('.ticket-gift-text').text("Regalato a "+$('input[name="gift-username"]').val());
            setTimeout(function() {
                $("#gift-modal").modal('hide');
                $("#buy-modal").modal('show');
//                $.resetTicketGift();
            }, 3000);
       } else {
            $(".giftErrorText").text(res.msg);
            $(".giftErrorText").show();
       }
   };
   
   $.addTabUrl = function(){
       alert("tab");
       return true;
   }
   /*$.resetTicketGift = function(){
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
   };*/
   
   // load notifications every timer
   $.getUnreadNotifications = function(){
       $.post( '/users/getNumUnreadNotifications')
            .done(function( data ) {
                if(data > 0){
                    $('.notify-unread-count').html(data); 
                    $('.float-circle').show(); 
                }
                setTimeout(function(){
                    $.getUnreadNotifications();
                },30000);
       });
   };
   
   $.getUnreadNotifications();
   
   // update lottery modals -> call inside modals
   $.updateAuctionModal = function(lotId){
        if(lotId){
            $.updateAuctionWinning(lotId);
        }
        setTimeout(function(){
            $.updateAuctionModal(lotId);
        },3000);
   };
   
   jQuery('body').on('click','.notify-pop-btn',function(event){
      $.post( '/users/markNewNotifyRead' , { notifyId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    $('.notify-unread-count').html(0); 
                    $('.float-circle').hide(); 
                }
       });
   });
   jQuery('body').on('click','.notify-row',function(event){
       var sender = $(this);
       $.post( '/users/markNotifyRead' , { notifyId: $(this).attr('name')})
            .done(function( data ) {
                if(data){
                    sender.removeClass('notify-unread');
                    sender.addClass('notify-read');
                }
       });
   });
  
   $.feedShare = function(provider,id){
        if(provider == "fb"){
            FB.ui({method: 'feed',
                message: baseGiftMsg,
                //link: '<?php echo $this->createAbsoluteUrl('auctions/getGift?tid='); ?>'+$("#ticketIdForGift").val(),
                link: baseTicketUrl,
    //                                to: $(this).attr('id');
                to: '100004725912341',
            }, function(response){
                if(!response){
                    return false;
                } else if(response.error_code){
                    alert(response.error_msg);
                    return false;
                } else {
                    $('#giftBtn').click();
                }
            });
        } else if(provider == "gp"){
            gapi.client.load('plus','v1', function(){
                var shareLink = baseTicketUrl;
                var baseLink = baseUrl;
                var shareMsg = baseGiftMsg;
                gpInviteBtnOptions.recipients=id;
                gpInviteBtnOptions.prefilltext=shareMsg;
                gpInviteBtnOptions.contenturl=baseLink;
                gpInviteBtnOptions.calltoactionurl=shareLink;
                gpInviteBtnOptions.gapiattached=true;
                gpInviteBtnOptions.class="g-interactivepost";
                gpInviteBtnOptions.onShare=function(response){
                    console.log("SHARE");
                    console.log(JSON.stringify(response));
                    if(response.status=="completed" && response.action=="cancelled"){

                    } else if(response.status=="completed" && response.action=="shared"){
                        $('#giftBtn').click();
                    }
                };
                gapi.interactivepost.render('gpshare-lot', gpInviteBtnOptions); 
                setTimeout(function(){
                    $('#gpshare-lot').click();
                },300); 
            });
            /*gapi.client.load('plus','v1', function(){
    
                var shareLink = baseTicketUrl;
                var baseLink = baseUrl;
                var shareMsg = baseGiftMsg;
                gpInviteBtnOptions.recipients=id;
                gpInviteBtnOptions.cookiepolicy="single_host_origin";
                gpInviteBtnOptions.prefilltext=shareMsg;
                gpInviteBtnOptions.contenturl=baseLink;
                gpInviteBtnOptions.calltoactionlabel="Vieni su Wonlot.com!";
                gpInviteBtnOptions.calltoactionurl=shareLink;
                gpInviteBtnOptions.gapiattached=true;
                gpInviteBtnOptions.class="g-interactivepost";
                gpInviteBtnOptions.onSuccess=function(response){
                    console.log("SUCCESS");
                    console.log(JSON.stringify(response));
                    if(response.status=="completed" && response.action=="cancelled"){

                    } else if(response.status=="completed" && response.action=="shared"){
                        $('#giftBtn').click();
                    }
                };
                gpInviteBtnOptions.onShare=function(response){
                    console.log("SHARE");
                    console.log(JSON.stringify(response));
                };
                gpInviteBtnOptions.onClick=function(response){
                    console.log("CLICK");
                    console.log(JSON.stringify(response));
                };
    //            gapi.interactivepost.render('gpshare-'+$("#ticketIdForGift").val(), gpInviteBtnOptions); 
                gapi.interactivepost.render('gpshare-gift', gpInviteBtnOptions); 
    //            gapi.plus.render('gpshare-'+entityType+'-'+entityId, gpShareBtnOptions);
                setTimeout(function(){
                    $('#gpshare-gift').click();
                },300);
            });*/
        }
   };
    
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
                giftBoxActive = "gp";
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
               giftBoxActive = "fb";
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
        var width  = 575,
            height = 400,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            url    = this.href,
            opts   = 'status=1' +
                     ',width='  + width  +
                     ',height=' + height +
                     ',top='    + top    +
                     ',left='   + left;

        window.open(url, 'twitter', opts);

        return false;
   });
   
   jQuery('body').on('input','#UserWithdraw_creditValue',function(event) {
   //$('#UserWithdraw_creditValue').change(function(event){
        var newVal = event.srcElement.value;
        if(newVal){
            //var commValue = parseInt(newVal) + (parseInt(newVal) / 100);
            var commValue = parseInt(newVal) - (parseInt(newVal) / 100);
            $('#valueWithoutCommission').text(commValue);
            $('#valueWithCommissionBlock').show();
        } else {
            $('#valueWithCommissionBlock').hide();
        }
   });
   
   $.updateRating = function(event){
       alert("RATE!");
   };
   
   $.selectProviderAndUser = function(provider,user){
       var providerObj;
       var userObj;
       $.each($('.gift-ticket-btn'), function(i, item){
           if($(this).val() == provider){
               providerObj = $(this);
           }
       });
       $.each($('.user-small-ticket-box'), function(i, item){
           if($(this).children('input[name=id]').val() == user){
               userObj = $(this);
           }
       });
       $('.gift-panel-ok').show();
       providerObj.click();
       setTimeout(function(){
           userObj.click();
       },200);
   };
   
   var modalHasBeenUpdated = false;
   $.modalHasUpdated = function(val){
       modalHasBeenUpdated = val;
   };
   $.updateModal = function(view,lotId,force){
     var main = "";
     var doHttp = false;
     if(view == "gift"){
         main = '#gift-main';
         doHttp = true;
     } else if(view == "buy"){
         main = '#buy-main';
         doHttp = true;
     }
     if(doHttp){
         if(modalHasBeenUpdated || force){
            jQuery.ajax({
               // The url must be appropriate for your configuration;
               // this works with the default config of 1.1.11
               url: '/auctions/getPartialView',
               type: "POST",
               data: {view: view, lotId: lotId},  
               error: function(xhr,tStatus,e){
                   if(!xhr){
                       alert("Error");
                       alert(tStatus+"   "+e.message);
                   }else{
                       alert("else: "+e.message); // the great unknown
                   }
               },
               success: function(resp){
                   $(main).html(resp);
               }
            });
         } 
      }
   };
   $.updateAuctionWinning = function(lotId){
    var winningUser = $('.winningUserHidden').get(0).value;
    var winningVal = $('.winningValHidden').get(0).value;
    jQuery.ajax({
       // The url must be appropriate for your configuration;
       // this works with the default config of 1.1.11
       url: '/auctions/getPartialArray',
       type: "POST",
       data: {lotId: lotId, winnerId: winningUser, winnerVal : winningVal},  
       success: function(resp){
           if(resp){
               $('.winningBox').html(resp);
           } else {
               var nochange = true;
           }
       }
    });
   };
   
   $('#openConfirmGiftPanel').click(function(event){
       //$("#giftDialog").dialog("open");
       $("#buttonGiftCreditPanel").hide();
       $("#confirmGiftCreditPanel").fadeIn();
       $("#giftCreditFooter").addClass("redBox");
   });
   
   $('.onlyOne').on('change',function(event){
       var newStatus;
       if($(this).attr('checked')){
           newStatus = 'checked';
       } else {
           newStatus = false;
       }
       $('.onlyOne').attr('checked',false);
       $(this).attr('checked',newStatus);
   });
   
   $.goBank = function(){
        setTimeout(function(){
            //$("#goBank").click();  
            window.location.href = $('#goBank').attr('href');
        },1000);
   };
   
});
