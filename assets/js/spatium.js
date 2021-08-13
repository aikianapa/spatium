"use strict"

wbapp.loadStyles([
    "https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;500;600;700&subset=latin,cyrillic"
]);

setTimeout(function(){
    $('.parallax').each(function () {
      let img = $(this).attr('data-img');
      if (img !== undefined) $(this).css("background-image", "url(" + img + ")").removeAttr('data-img');
    })

    $('.img-caption').on('mouseover mouseout', function () {
      $(this).find('figcaption').toggleClass('op-0');
    });

    $('#faq-accordion').accordion({
      heightStyle: 'content'
      ,collapsible: true
      ,active: false
    });
    $('loader').hide();
  },1)

  $.fn.lightGallery = function (options) {
    if (!this.length) return;
    $(this).each(function(){
      let lg = lightGallery(this, options);
    })
  }

    wbapp.on('ready',function(){
       
      $('#programs').lightGallery({
        'selector': '[data-iframe]',
        'download': false,
        'counter': false
      });

      $('.gallery').lightGallery({
        'selector': 'div[data-src]',
        'download': false,
        'counter': false,
        'zoom':true
      });
  
      $(document).delegate('.lg-outer','mousewheel', function(e){
        if(e.originalEvent.wheelDelta /120 > 0) {
            $(this).find('.lg-prev').trigger('click');
        }
        else{
            $(this).find('.lg-next').trigger('click');
        }
        e.stopPropagation();
      });

    })
