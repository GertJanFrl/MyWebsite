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
        locale: 'nl',
        calendarWeeks: true,
        showClose: true,
        toolbarPlacement: 'top'
    });

    var fixHelper = function(e, ui) {
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };

    $('.sortable').sortable({
        helper: fixHelper,
        axis: 'y',
        cancel: '.disabled',
        update: function (event, ui) {
            var pageOrder = '';
            $('.sortable tr').not('.child').each(function(i) {
                if (pageOrder == '')
                    pageOrder = $(this).data('id');
                else
                    pageOrder += ',' + $(this).data('id');
            });

            $.post('/_admin/page/ajax', { order: pageOrder });
            // .success(function(data) {
            //     alert('saved');
            // })
            // .error(function(data) { 
            //     alert('Error: ' + JSON.stringify(data)); 
            // }); 

            $('#sortState').addClass('updated');
        }
    }).disableSelection();

    $('#sortState').click(function() {
        if($(this).hasClass('updated')) {
            location.reload();
        }
        if ($(this).hasClass('enabled')) {
            $(this).removeClass('enabled');
            $(this).html('<a><i class="fa fa-sort"></i> Sorteren uitschakelen</a>');
            $('table.table.table-sort tbody').removeClass('disabled');
            $('.table-sort tbody tr.child').css('display', 'none');
        } else { 
            $(this).addClass('enabled');
            $(this).html('<a><i class="fa fa-sort"></i> Sorteren inschakelen</a>');
            $('.table-sort tbody').addClass('disabled');
            $('.table-sort tbody tr.child').css('display', 'table-row');
        }
    });

    $("#id_parent").change(function () {
        $( "#id_parent option:selected" ).each(function() {
            if ($(this).val() > 0) {
                $('#page form').attr('action', '/_admin/page/sub');
            } else {
                $('#page form').attr('action', '/_admin/page/edit');
            }
        });
    }).change();


    var sections = ['systeem', 'article', 'pages', 'portfolio', 'user', 'inlog'];
    $.each(sections, function (index, value) {
        console.log(value);
        var ip_addresses = [];
        // for each span with data-label="ip"
        $("div.tab-content #" + value + " span[data-label=ip]").each(function() {
            // push into the array an object containing our query
            ip_addresses.push({
                query: $(this).text()
            });
        });
        // convert the array to JSON and send it to the server
        $.post('http://ip-api.com/batch?fields=country,city,status,message#' + value, JSON.stringify(ip_addresses), function(responseArray) {
            // for each span with data-label="location"
            $("div.tab-content #" + value + " span[data-label=location]").each(function() {
                // remove the first object from the response array and use it
                var responseObject = responseArray.shift();
                if (responseObject.status == "success") {
                    // populate the span with city and country
                    $(this).text(responseObject.city + ", " + responseObject.country + " ");
                } else {
                    $(this).text("error: " + responseObject.message);
                }
            });
        }, 'json');
    });

});