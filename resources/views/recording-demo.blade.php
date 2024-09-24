<script type="text/javascript">    
    var SITE_URL="{{url('/')}}";
</script>
<script type="text/javascript" src="{{url('/')}}/js/front/flash-recording/js/jquery.js"></script>
<h4>Demo</h4>
<div id="template_form_fields">

</div>
<script type="text/javascript">
    /**
 * Gets the browser name or returns an empty string if unknown. 
 * This function also caches the result to provide for any 
 * future calls this function has.
 *
 * @returns {string}
 */
var browser = function() {
    // Return cached result if avalible, else get result then cache it.
    if (browser.prototype._cachedResult)
        return browser.prototype._cachedResult;

    // Opera 8.0+
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

    // Firefox 1.0+
    var isFirefox = typeof InstallTrigger !== 'undefined';

    // Safari 3.0+ "[object HTMLElementConstructor]" 
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);

    // Internet Explorer 6-11
    var isIE = /*@cc_on!@*/false || !!document.documentMode;

    // Edge 20+
    var isEdge = !isIE && !!window.StyleMedia;

    // Chrome 1+
    var isChrome = !!window.chrome && !!window.chrome.webstore;

    // Blink engine detection
    var isBlink = (isChrome || isOpera) && !!window.CSS;

    return browser.prototype._cachedResult =
        isOpera ? 'Opera' :
        isFirefox ? 'Firefox' :
        isSafari ? 'Safari' :
        isChrome ? 'Chrome' :
        isIE ? 'IE' :
        isEdge ? 'Edge' :
        isBlink ? 'Blink' :
        "Don't know";
};
if(browser() == 'IE')
{   
    var browser = 'IE';
}
else
{
    var browser = 'Other';   
}

if($.trim(browser) != '')
{
    $.ajax({
      url : '{{ url("/load_view/") }}/'+browser,
      type : 'get',
      //data : {  },
      success : function(data)
      {
        $('#template_form_fields').html(data);
      }
    });

}
else
{
    $("#template_form_fields").html('');
}
</script>
