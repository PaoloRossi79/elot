//Togliamo gli effetti fade da IE
(function($) {
   var m = /(MSIE) ([\w.]+)/.exec( navigator.userAgent );
   var patch = m && m[1] && m[2] < 9;

   if (patch) {
       $.fn.fadeIn = function(speed, callback) {
           /*return this.animate({opacity: 'show'}, speed, function() {
               this.style.removeAttribute('filter');
               callback && callback();
           });*/
          return this.show();
       };

       $.fn.fadeOut = function(speed, callback) {
           /*return this.animate({opacity: 'hide'}, speed, function() {
               this.style.removeAttribute('filter');
               callback && callback();
           });*/
          return this.hide();
       };

       $.fn.fadeTo = function(speed,to,callback) {
           return this.animate({opacity: to}, speed, function() {
               to == 1 && this.style.removeAttribute('filter');
               callback && callback();
           });
       };
   }
})(jQuery);
