(function($){
  jQuery.fn.cover = function(options){

    var defaults = {
      'container': '.container',
      'cover': 'a'
      
    }; 

    var settings = jQuery.extend({}, defaults, options);


    jQuery(this).each(function(){

    var $container = jQuery(this).find(settings.container);
    var $flipper = $container.find(settings.cover);
    var $cur_top = $flipper.position().top;
    var $height = $flipper.height();
    $flipper.hide();
    $container.hover(function(){
   
    $flipper.fadeIn();

    },function(){
    $flipper.fadeOut();

    });
    });
}

})(jQuery);