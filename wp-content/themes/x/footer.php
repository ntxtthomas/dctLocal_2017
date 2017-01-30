<?php

// =============================================================================
// FOOTER.PHP
// -----------------------------------------------------------------------------
// The site footer. Consists of the top footer area for widgets and the bottom
// footer area for secondary information. Includes wp_footer() hook as well.
//
// Content is output based on which Stack has been selected in the Customizer.
// To view and/or edit the markup of your Stack's index, first go to "views"
// inside the "framework" subdirectory. Once inside, find your Stack's folder
// and look for a file called "wp-footer.php," where you'll be able to find the
// appropriate output.
// =============================================================================

?>
<script>
var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-37625170-1']);
    _gaq.push(['_setDomainName', 'dentoncommunitytheatre.com']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();</script>
<?php x_get_view( x_get_stack(), 'wp', 'footer' ); ?>