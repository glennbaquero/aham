$(document).ready(function() {
  app.init();
});

var app = {

  init: function() {
    var setup = this.setup;

    switch(pageID) {
      case 'home':
        setup.home();
        case 'pages.product':
          setup.products();
        case 'pages.about':
          setup.about();
        break;
        default:
          setup.contact();
        break;
    }

    setup.bindEvents();
    setup.vendors();
    setup.alertStatusMessage();
    setup.menu();
    setup.animation();
    setup.defaultForm();
    setup.about();
    setup.products();
    // setup.initFlatPickr();


  },

  setup: {

    controller: new ScrollMagic.Controller(),

    defaultForm: function()
    {
      initForms();

      function initForms() {
          app.form.init({
              form:$('#contactForm'),
              url:$('#contactForm').data('action'),
              // message: '#form-message',
              button: '#contactBtn'
          });
      }
    },

    menu: function(){

        //Mobile Navigation 
        var mblnav = $('.mbl-menu');
        mblnav.on('click',function(){
          $('.mbl-menu__link-holder').addClass("show");
        });

        var mblnav = $('.mbl-menu-close');
        mblnav.on('click',function(){
          $('.mbl-menu__link-holder').removeClass("show");
        });

        //Dropdown arrow
        $('.dropdown-icon').on('click', function() {
          var id = $(this).data('dropdown-id');
          $('#'+id).toggle();
        });

        // Mobile Accordion
        $(".mbl-menu__acc-menu").on("click", function() {
            if ($(this).hasClass("active")) {
              $(this).removeClass("active");
              $(this)
                .siblings(".mbl-menu__acc-item")
                .slideUp(200);
              $(".mbl-menu__acc-menu i")
                .removeClass("fa-angle-down")
                .addClass("fa-angle-right");
            } else {
              $(".mbl-menu__acc-menu i")
                .removeClass("fa-angle-down")
                .addClass("fa-angle-right");
              $(this)
                .find("i")
                .removeClass("fa-angle-right")
                .addClass("fa-angle-down");
              $(".mbl-menu__acc-menu").removeClass("active");
              $(this).addClass("active");
              $(".mbl-menu__acc-item").slideUp(200);
              $(this)
                .siblings(".mbl-menu__acc-item")
                .slideDown(200);
            }
        });

        $(".mbl-footer__acc-menu").on("click", function() {
            if ($(this).hasClass("active")) {
              $(this).removeClass("active");
              $(this)
                .siblings(".mbl-footer__acc-item")
                .slideUp(200);
              $(".mbl-footer__acc-menu i")
                .removeClass("fa-sort-up")
                .addClass("fa-sort-down");
            } else {
              $(".mbl-footer__acc-menu i")
                .removeClass("fa-sort-up")
                .addClass("fa-sort-down");
              $(this)
                .find("i")
                .removeClass("fa-sort-down")
                .addClass("fa-sort-up");
              $(".mbl-footer__acc-menu").removeClass("active");
              $(this).addClass("active");
              $(".mbl-footer__acc-item").slideUp(200);
              $(this)
                .siblings(".mbl-footer__acc-item")
                .slideDown(200);
            }
        });

        // $('.selected').on('click', function() {
        //   $(this).next().toggleClass('opened');
        // });

        $('.items').on('click', function() {
          // var txt = $(this).find('.dropdown-content > div:first-child b').text();
          // $(this).parent().parent().parent().find('.selected div').html(txt);
          $(this).parent().parent().parent().find('.opened').removeClass('opened');
        });

    },

    animation: function() {
      $('.animate-up').each(function() {
        var tl = new TimelineMax()
        .fromTo(this, 0.5,
          { y: "3%", opacity: "0", ease:Power0.easeIn },
          { y: "0%", opacity: "1", ease:Power0.easeIn })

        var fadeScene = new ScrollMagic.Scene({
          triggerElement: this,
          triggerHook: .7,
          reverse:true,
          })
          .setTween(tl)
          .addTo(app.setup.controller);
      });
    },

    initFlatPickr: function(){

      flatpickr(".datePicker", {});  
    },
    alertStatusMessage: function() {
      if(systemVars.status.title !== '') {

        swal({
          title: systemVars.status.title,
          text: systemVars.status.message,
          type: systemVars.status.type,
          confirmButtonColor: '#ec6104',
        });

      }
    },

    bindEvents: function() {
      
    },
    
    vendors: function() {},

    home: function(){

        $('.h__slider-holder').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            speed: 500,
            arrows: false,
            fade: false,
            dots: true
        });


        $('.top_slider').slick({
            dots: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            speed: 500,
        }); 

    },

    about: function(){

      $('.banner__slider-holder').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        speed: 500,
        arrows: false,
        fade: false,
        dots: true
      });

      var slider = $('.a-partners__slider'),
        sliderHolder = $('.a-partners__sliderHolder');
        slider.slick(app.slick.byFour($('#prev', sliderHolder), $('#next', sliderHolder)));
        app.slickArrows.init(slider, sliderHolder, 4);
        

        $(".a__question").on("click", function() {
          if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this)
              .siblings(".a__answer")
              .slideUp(200);
            $(".a__question i")
              .removeClass("fa-arrow-up")
              .addClass("fa-arrow-down");
          } else {
            $(".a__question i")
              .removeClass("fa-arrow-up")
              .addClass("fa-arrow-down");
            $(this)
              .find("i")
              .removeClass("fa-arrow-down")
              .addClass("fa-arrow-up");
            $(".a__question").removeClass("active");
            $(this).addClass("active");
            $(".a__answer").slideUp(200);
            $(this)
              .siblings(".a__answer")
              .slideDown(200);
          }
      });
    },

    products: function() {
      
      $('.sp__slider-holder').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        speed: 500,
        arrows: false,
        fade: true,
        dots: true
      });

    },

    contact: function() {
      // app.form.init({ 
      //   form: $('#contactForm'),
      //   url: baseHref + 'contact',
      //   button: '.submitBtn',
      //   message: '.alert',
      // });
    },
  },

  slick: {
    default: function(arrowsBool, dotsBool, prev, next) {
      return {
        arrows: arrowsBool,
        dots: dotsBool,
        infinite: true,
        fade:true,
        cssEase: 'linear',
        speed: 800,
        autoplay: true,
        autoplaySpeed: 5000,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: prev,
          nextArrow: next,
      }
    },

    byThree: function(prev, next, centerBool, centerPaddingVal) {
      return {
        centerMode: centerBool,
        centerPadding: centerPaddingVal,
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
                autoplay: true,
                autoplaySpeed: 5000,
        slidesToShow: 3,
        slidesToScroll: 1,
        focusOnSelect: true,
        pauseOnFocus: true,
        prevArrow: prev,
          nextArrow: next,
                responsive: [
                    {
                        breakpoint: 1001,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 695,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }   
                    }
                ]
      }
    },

    byFour: function(prev, next) {
      return {
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
                autoplay: true,
                autoplaySpeed: 5000,
        slidesToShow: 4,
        slidesToScroll: 1,
        focusOnSelect: true,
        pauseOnFocus: true,
        prevArrow: prev,
          nextArrow: next,
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 801,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 401,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }   
                    }
                ]
      }
    },

    byFive: function(prev, next) {
      return {
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
                autoplay: true,
                autoplaySpeed: 5000,
        slidesToShow: 5,
        slidesToScroll: 1,
        focusOnSelect: true,
        pauseOnFocus: true,
        prevArrow: prev,
          nextArrow: next,
                responsive: [
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 801,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 401,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }   
                    }
                ]
      }
    },

    bySix: function(prev, next) {
      return {
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
                autoplay: true,
                autoplaySpeed: 5000,
        slidesToShow: 6,
        slidesToScroll: 1,
        focusOnSelect: true,
        pauseOnFocus: true,
        prevArrow: prev,
          nextArrow: next,
                responsive: [
                  {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 1100,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 801,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }   
                    },
                    {
                        breakpoint: 401,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }   
                    }
                ]
      }
    },
  },

  // hide arrows if less than items
  slickArrows: {
    init: function($slider, $container, $length) {
      if ($('.slick-slide', $slider).length > $length) {
        $('.slider-arrows > *', $container).css('display', 'block');
      } else {
        $('.slider-arrows > *', $container).css('display', 'none');
      }
    }
  },

  form: {
    /* Default Values */
    button: 'button',
    message: '.message',
    isLoading: false,

    successValue: 1,
    failValue: 0,

    onClick: null,

    onStart: null,
    onEnd: null,

    onSuccess: null,
    onFail: null,

    clearForm: true,

    init: function(settings) {

      var $form = settings['form'],
        url = settings['url'],
        _settings = [],
        _inputs = [];

      /* !important */
      _settings['url'] = url;
      /* Set components */
      _settings['button'] = ('button' in settings) ? $form.find(settings['button']) : $form.find(this.button);
      _settings['message'] = ('message' in settings) ? $form.find(settings['message']) : $form.find(this.message);
      _settings['isLoading'] = this.isLoading;
      /* Set Values */
      _settings['successValue'] = ('successValue' in settings) ? settings['successValue'] : this.successValue;
      _settings['failValue'] = ('failValue' in settings) ? settings['failValue'] : this.failValue;
      /* Set functions */
      _settings['onClick'] = ('onClick' in settings) ? settings['onClick'] : this.onClick;
      _settings['onStart'] = ('onStart' in settings) ? settings['onStart'] : this.onStart;
      _settings['onEnd'] = ('onEnd' in settings) ? settings['onEnd'] : this.onEnd;
      _settings['onSuccess'] = ('onSuccess' in settings) ? settings['onSuccess'] : this.onSuccess;
      _settings['onFail'] = ('onFail' in settings) ? settings['onFail'] : this.onFail;
      /* Set options */
      _settings['clearForm'] = ('clearForm' in settings) ? settings['clearForm'] : this.clearForm;

      _settings['inputs'] = this.getInputs($form);
      _settings['vars'] = [];

      $form.settings = _settings;

      /* Events */
      submitHandler();

      bindEvents();
      bindCallableFunctions();

      return $form;

      /* Methods */
      function bindEvents() {

        $form.settings['button'].on('click', function(e) {
          e.preventDefault();

          if($form.settings['onClick']) { $form.settings['onClick']($(this)); }

          $form.submit();
        });
      }

      function bindCallableFunctions() {

        /* Set callable functions */
        $form.on = function(name, value) {
          switch(name) {
            case 'onClick': $form.settings['onClick'] = value; break;
            case 'onStart': $form.settings['onStart'] = value; break;
            case 'onEnd': $form.settings['onStart'] = value; break;
            case 'onSuccess': $form.settings['onClick'] = value; break;   
            case 'onFail': $form.settings['onStart'] = value; break;                  
            default: break;
          }
        }

        $form.set = function(name, value) {
          return $form.settings[name] = value;
        }

        $form.addPostVars = function(name, value) {
          return $form.settings['vars'].push({name: name, value: value });
        }
      }

      function submitHandler() {


        $form.validate({
          submitHandler: function() {

            
            if(!$form.settings['isLoading']) {

              if($form.settings['onStart']) { $form.settings['onStart'](); }

              disable();

              $('.spinner-holder').show();
              
              /* Get all post vars */
              var vars = $form.serializeArray();
              // console.log(vars);
              /* Add the settings['vars'] on the post vars */
              $.post($form.settings['url'], vars.concat($form.settings['vars']), function(data) {

                $('.spinner-holder').hide();

                switch(data.response) {
                  case $form.settings['failValue']:

                    setMessage(true, data.errors);
                    enable();

                    if($form.settings['onFail']) { $form.settings['onFail'](data); }

                  break;
                  case $form.settings['successValue']:

                    setMessage(false, data.message);
                    enable();

                    toastr.success('Sending successful!', 'Say Hello');

                    if($form.settings['clearForm']) { clearForm(); }
                    if($form.settings['onSuccess']) { $form.settings['onSuccess'](data); }

                  break;
                }

                if($form.settings['onEnd']) { $form.settings['onEnd'](data); }

              }, 'json');
            }
          },
        });
      }

      function setMessage(hasError, data) {
        var text = data;

        if(hasError) {

          for(var i = 0; i < $form.settings['inputs'].length; i++) {
            if(data[$form.settings['inputs'][i]] != null) {
              
              var inputName = $form.settings['inputs'][i].name,
                inputType = $form.settings['inputs'][i].type;

              $obj = $form.find(inputType + '[name="' + inputName + '"]');

              $obj.focus();
              $obj.addClass('error');
              
              $($form.settings['message']).addClass('error');

              text = data[$form.settings['inputs'][i]];

              break;
            }
          }
        } else {
          $form.settings['message'].addClass('success');
        }
        
        $form.settings['message'].html(text);
      }

      function enable() {
        $form.settings['isLoading'] = false;
      }

      function disable() {
        $form.settings['message'].removeClass('success');
        $form.settings['isLoading'] = true;
      }

      function clearForm() {
        $form.trigger('reset');
      }
    },

    getInputs: function(form) {
      var inputs = [];

      $(form).find('input, textarea, select').each(function() {
          inputs.push({ name: $(this).attr('name'), type: '' });
      });

      return inputs;
    }
  },


};