var $ = jQuery;

$(function(e){
    //alert('hi');
    $('.nav > div').meanmenu({
        meanMenuContainer: '.meanbar',
        meanScreenWidth: "767"
    });
    
    /*$(".menusection").sticky({topSpacing:0});*/
    
    $('.lwa-username td').attr('colspan', 2);
    $('.lwa-username td input').attr('placeholder', 'Email');

    $('.lwa-password td').attr('colspan', 2);
    $('.lwa-password td input').attr('placeholder', 'Passwrod');
});

