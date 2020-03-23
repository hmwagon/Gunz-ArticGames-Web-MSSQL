// TABS
function tabsInit() {
    var tabs = jQuery('ul.tabs');

    tabs.each(function(i) {

        //Get all tabs
        var tab = jQuery(this).find('> li > a');
        tab.click(function(e) {

            //Get Location of tab's content
            var contentLocation = jQuery(this).attr('href');

            //Let go if not a hashed one
            if(contentLocation.charAt(0)=="#") {

                e.preventDefault();

                //Make Tab Active
                tab.removeClass('active');
                jQuery(this).addClass('active');

                //Show Tab Content & add active class
                jQuery(contentLocation).fadeIn().addClass('active').siblings().hide().removeClass('active');

            }
        });
    }); 
}

// START FUNCTIONS

$(document).ready(function() {
	$(".zoom_thumb").elevateZoom({
        zoomWindowFadeIn: 100,
        zoomWindowFadeOut: 100,
        borderSize: 0,
        showLens: false
	});
	
	$('#slider').nivoSlider({
		effect: "boxRandom",
		animSpeed: 500,
		pauseTime: 4000,
		directionNav: false
	});

    $('article').readmore({
        maxHeight: 20,
        heightMargin: 16
    });

	tabsInit();

	Shadowbox.init({
		handleOversize:     "resize",
		handleUnsupported:  "remove",
		counterType:        "skip",
		continuous:         "true" 
	});
});

$('#minipanel > form > select').change(function () {
    var Emblem = $('#minipanel > form > img');
    var ClanList = $('#minipanel > form > select');
    var ClanLink = $('#minipanel > form > a');
    var ClanData = ClanList.val();
    var CData = ClanData.split("-|-");

    if (CData[3] == "")
        CData[3] = "noemblem.jpg";

    Emblem.attr("src", "/emblems/" + CData[3]);
    ClanLink.attr("href", "/clan/settings/" + CData[2]);
});

