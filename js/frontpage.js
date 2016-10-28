   $(document).ready(function() {
        var mobileCheck = false;
        var width = $(window).width();
        removeTitle();
        if(width < 960){
            minRecs();
            minFooBar();
            hideInfo();
            removeMobile();
        }
        if(width < 650){
            makeTitle();
            minFooBar();
            hideSides();
            //$('.recommend').hide();
            minRecs();
            mobile();
            //filterSearchMobile();
        }

        $(window).resize(function(){
            if($(this).width() < 650){
                //filterSearchMobile();
                makeTitle();
                hideInfo();
                hideSides();
                minFooBar();
                mobile();
                //$('.recommend').hide();
            } 
            else if($(this).width() < 960){
                removeTitle();
                minFooBar();
                minRecs();
                showSides();
                hideInfo();
               removeMobile();
            }
            else{
                removeTitle();
                showInfo();
                maxFooBar();
                showSides();
                maxRecs();
                removeMobile();
            }
        });
    });

    $(".first").click(function(){
        window.location = "home.html";
    });
    $(".second").click(function(){
        window.location = "home.html";
    })
    $(".third").click(function(){
        window.location = "data.html"
    });
    $(".fourth").click(function(){
        window.location = "auth.html";
    });
    function mobile(mobileCheck){
        $('.navbar-header').addClass('mobileRight');
        if($('.navbar-header').find('a').length < 1){
            var logo=$('<span class="left"><a href="home.html" class="navbar-brand">Duke     <span class="smaller">EXCHANGE</span></a></span>');
            $('.navbar-header').css("width", "100%");
            $('.left').css("float", "left");
            $('.navbar-header').append(logo);


        }
    }
    function removeMobile(){
        $('.navbar-header').removeClass('mobileRight');
        $('.navbar-header').find("a").remove();
    }
    function makeTitle(){
        $(".small-title").show();
    }
    function removeTitle(){
        $(".small-title").hide();
    }
    function showSides(){
        $('.search-filter').show();
        $('.filter-message').show();
        $('.filter').show();
    }
    function showInfo(){
        $('.right').show();
    }
    function hideInfo(){
        $('.right').hide();
    }
    function hideSides(){
        $('.search-filter').hide();
        $('.filter-message').hide();
        $('.filter').hide();
    }
    function minFooBar(){
        $('.foobar').css("margin-top", "30px");
        $('.foobar').css("margin-left", "0px");
        $('.foobar').css("width", "100%");
    }
    function maxFooBar(){
        $('.foobar').css("margin-top", "20px");
        $('.foobar').css("width", "72%");
        $('.foobar').css("margin-left", "40px");
    }
    function minRecs(){
        //$('.recommend').show();
        $('.recommend').css("margin-left", "0px");
        $(".recommend").css("width", "100%");
    }
    function maxRecs(){
        $('.recommend').css("margin-left", "40px");
        $('.recommend').css("width", "72%");
        //$('.recommend').show();
    }
    function filterSearchMobile(){
        var filter = $('.filter-message').clone();
        filter.appendTo($('#wrapper'));
    }
     $('.list1 .check-link').on('click', function () {
        var button = $(this).find('i');
        var label = $(this).next('span');
        var curr = ($('.list1 .check-link').index($(this)));
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        $('.list1').children().each(function(index){
            if(index != curr && $(this).find("i").hasClass("fa-check-square")){
                $(this).find("i").toggleClass('fa-check-square').toggleClass('fa-square-o');
            }
        });
        //label.toggleClass('todo-completed');
        return false;
    });
    $('.list2 .check-link').on('click', function () {
        var button = $(this).find('i');
        var label = $(this).next('span');
        var curr = ($('.list2 .check-link').index($(this)));
        button.toggleClass('fa-check-square').toggleClass('fa-square-o');
        $('.list2').children().each(function(index){
            if(index != curr && $(this).find("i").hasClass("fa-check-square")){
                $(this).find("i").toggleClass('fa-check-square').toggleClass('fa-square-o');
            }
        });
        //label.toggleClass('todo-completed');
        return false;
    });
   
    text = false;
    showbar = false;
    mout = "#5E5E5E"    
    back = "#F0F0F0"
    topbar = $("#topbar");
    $("#listing").mouseover(function(){
        $("#listing").css("background-color", "#001A57");
        $("#listing").css("color", "white");
    })
    $("#listing").mouseout(function(){
        $("#listing").css("background-color", "#FAFAFA");
        $("#listing").css("color", "#001A57");
    })
/*    function showSearch(){
        if(!showbar){
            var searchBar = $("<form></form>");
            searchBar.addClass("navbar-form-custom");
            searchBar.attr("action", "search_results.html");
            var group = $("<div></div>");
            group.addClass("form-group");

            var input = $("<input></input>");
            input.attr({
                type: "search",
                placeholder: "Search your account...",
                id: "topbar",
                name: "top-search"
            });
            input.addClass("form-control");
            input.css("max-width", "0px");
            group.css("max-width", "0px");
            group.append(input);
            searchBar.append(group);
            //searchBar.hide();
            $("#appendbar").append(searchBar);
            input.css("min-width", "300px");
            searchBar.show();
            searchBar.animate({ width: "300px" }, 500);

        }
        else{
            if($(".form-control").val().length == 0){
                $("#appendbar").find(".navbar-form-custom").remove();
            }
            else
                window.location = "search_results.html";
        }
        showbar = !showbar;
    }*/
/*
    topsearch = $(".topbutt");

    topsearch.mouseout(function(){
        topsearch.css("background-color", back);
        topsearch.css("border", "solid #D1D1D1 1px");
    });
    topsearch.mouseover(function(){
        topsearch.css("background-color", back);
        topsearch.css("border", "solid #B3B3B3 1px");
    });


    topbar.focus(function(){
        topsearch.css("border", "solid #B3B3B3 1px");
    });
    topbar.focusout(function(){
        topsearch.css("border", "solid #D1D1D1 1px");
    });*/

    //$('.dropdown-toggle')
    a = $(".classes");
    a.mouseout(function(){
        a.css("background-color", "#F5F5F5");
    });
    b = $(".add-class");
    
    b.on("click", function(){
    });
    prim = $(".clicker");

    prim.mouseover(function(){
        prim.css("border", "solid #B3B3B3 1px")
        prim.css("color", "black");
        prim.css("background-color", back);
    });
    prim.mouseout(function(){
        prim.css("border", "none");
        prim.css("color", mout);
        prim.css("background-color", back);
        prim.css("border", "solid #D1D1D1 1px");
    });    
    prim.click(function(){
        $(".logo a").toggleClass("logo-toggle");
        $(".logo-element").toggleClass("netid-toggle");
        if(!text){
            $(".smaller").text("");        }
        else{

            $(".smaller").text("EXCHANGE");
        }
        text = !text;
    });
    keep = $(".space");
    keep.mouseout(function(){
        keep.css("background-color", "#001A57");
        keep.css("color", "white"); 
    });

    keep.mouseover(function(){
        keep.css("background-color", "#001A45");
        keep.css("color", "white"); 
        keep.css("height", "44px");
    }); 
    $("#home").click(function(){

        window.location = "home.html";
    });