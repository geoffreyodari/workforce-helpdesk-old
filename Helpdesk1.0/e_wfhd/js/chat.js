/* by: thinkingstiff.com
license: http://creativecommons.org/licenses/by-nc-sa/3.0/us/ */

var headerUri = 'http://stackoverflow.com/q/8866736/918414',
    headerCaption = 'CSS Speech Bubble with Box Shadow';
    
document.body.insertAdjacentHTML( 
    'afterBegin',
      '<a href="' + headerUri + '" '
    + 'target="_top" '
    + 'onmouseover="this.style.opacity=\'.95\'" '
    + 'onmouseout="this.style.opacity=\'1\'" '
    + 'style="'
        + 'background-color: black;'
        + 'background-image: linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -webkit-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -moz-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -o-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -ms-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'border: 1px solid black;'
        + 'border-radius: 2px;'
        + 'color: white;'
        + 'display: block;'
        + 'font: normal 15px/26px Helvetica, Verdana, Tahoma;'
        + 'height: 26px;'
        + 'left: 0px;'
        + 'opacity: 1;'
        + 'overflow: hidden;'
        + 'padding: 2px 8px;'
        + 'position: fixed;'
        + 'right: 0px;'
        + 'text-decoration: none;'
        + 'text-overflow: ellipsis;'
        + 'text-shadow: -1px -1px black;'
        + 'top: 0px;'
        + 'white-space: nowrap;'
    + '"><img '
    + 'style="' 
        + 'display: block;'
        + 'float: left;'
        + 'margin-right: 8px;" '
    + 'src="http://thinkingstiff.com/images/stackoverflow.png" />'
    + headerCaption
    + '</a>'
    );

document.body.insertAdjacentHTML( 
    'afterBegin', 
    '<a href="http://thinkingstiff.com" '
    + 'target="_top" '
    + 'onmouseover="this.style.opacity=\'.95\'" '
    + 'onmouseout="this.style.opacity=\'1\'" '
    + 'style="'
        + 'background-color: black;'
        + 'background-image: linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -webkit-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -moz-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -o-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'background-image: -ms-linear-gradient( top, rgba( 255, 255, 255, .3), rgba( 255, 255, 255, 0) );'
        + 'border: 1px solid black;'
        + 'border-radius: 2px;'
        + 'bottom: 0;'
        + 'color: white;'
        + 'display: block;'
        + 'font-family: Helvetica, Verdana, Tahoma;'
        + 'opacity: 1;'
        + 'padding: 4px 8px;'
        + 'position: fixed;'
        + 'right: 0;'
        + 'text-decoration: none;'
        + 'text-shadow: -1px -1px black;'
        + 'z-index: 100;'
    + '">thinkingstiff.com</a>' 
    ); 

document.head.insertAdjacentHTML( 'beforeEnd',
    '<style>'
    + 'body { margin-top: 40px; }'
    + '</style>'
    );
    
    
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-23915674-6']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
