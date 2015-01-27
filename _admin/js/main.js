browserWidth = $( window ).outerWidth(); 
$(window).resize(function() {
    browserWidth = $(window).outerWidth();
});

$(document).ready(function() {
    $navToggle = $('.nav-toggle');
    $nav = $('#navigation');
    $page = $('#page');
    function hideNavMobile() {
        if (browserWidth < 993) {
            // reset values on browser resizes
            $nav.addClass('mobile-hidden').removeClass('narrow').addClass('expanded');  
            $page.removeClass('nav-narrow').removeClass('nav-expanded');
            $navToggle.removeClass('nav-hidden nav-visible');
            hideNav();
        } else {
            $page.addClass('nav-expanded');
        }
    }
    function showNav() {
        $nav.removeClass('mobile-hidden').addClass('mobile-visible');
        $navToggle.addClass('nav-visible').removeClass('nav-hidden');
        $page.addClass('nav-visible').removeClass('nav-hidden');
        $("#navigation-block").removeClass('mobile-hidden').addClass('mobile-visible');
    }

    function hideNav() {
        $nav.removeClass('mobile-visible').addClass('mobile-hidden');
        $navToggle.addClass('nav-hidden').removeClass('nav-visible');
        $page.addClass('nav-hidden').removeClass('nav-visible');
        $("#navigation-block").removeClass('mobile-visible').addClass('mobile-hidden');
    }
    $navToggle.on('click', function() {
        if ($nav.hasClass('mobile-hidden')) {
            showNav();
            return false;
        }
        if ($nav.hasClass('mobile-visible')) {
            hideNav();
            return false;
        }
    });
    $page.on('click', function() {
        if (browserWidth < 993) 
            hideNav();
    });
    hideNavMobile();
    $(window).resize(function() {
        hideNavMobile();
    });

    $("#thumbnail").change(function(){
        thumbnailUploadReadUrl(this);
    });
    function thumbnailUploadReadUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#thumbnail-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            $("#thumbnail-img").css("display", "block");
        }
    }

    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove();
      });
    }, 5000);

    $("html, body").css("height", $( document ).height());
    $("#navigation-block").css("height", $("#page").height());

    $('.datetimepicker').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
        language: 'nl'
    });
});