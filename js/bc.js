/*!
 * Additional JS
 * 
 */


$( document ).ready(function() {
    console.log( "ready!" );
    // Closes the Responsive Menu on Menu Item Click
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    // Removes fixed width from .wp-caption div for images
    $(".wp-caption").removeAttr('style');

    resize();

    window.onresize = function() {
        resize();
    };
});

function resize()
{
    if ( document.getElementById("home_banner") !== null ) {
        var heights = window.innerHeight - 55;
        document.getElementById("home_banner").style.height = heights + "px";
    }
}

tSetThisCookie = function (name, days) {
    var d = new Date();
    d.setTime(d.getTime() + 1000 * 60 * 60 * 24 * days);
    document.cookie = name + "=true;path=/;expires=" + d.toGMTString() + ';';
};

tCheckForThisCookie = function (name) {
    if (document.cookie.indexOf(name) === -1) {
        return false;
    } else {
        return true;
    }
};

$(document).ready(function () {

    $(function () {
        if (!tCheckForThisCookie("dontShowCookieNotice")) {
            $('<div class="cookieNotice">We use cookies to improve services and ensure they work for you. Read our <a title="Our cookie policy" href="https://theatrelab.co.uk/privacy-policy/">cookie policy</a>. <a title="Close cookie policy notice" href="#" id="cookieCutter">Close</a></div>').css({
                padding: '5px',
                "text-align": "center",
                backgroundColor: '#FCE45C',
                position: 'fixed',
                bottom: 0,
                'font-size': '14px',
                width: '100%',
                display: 'none'
            }).appendTo('body');

            setTimeout(function () {
                $('.cookieNotice').slideDown(1000);
            }, 1000);
        }
    });

    $(document).on('click', '#cookieCutter', function (e) {
        e.preventDefault();
        tSetThisCookie('dontShowCookieNotice', 365);
        $('.cookieNotice').hide();
    });

});

