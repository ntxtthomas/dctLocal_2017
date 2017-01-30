// =============================================================================
// JS/ADMIN/CUSTOMIZER-ADMIN.JS
// -----------------------------------------------------------------------------
// Customizer admin functionality.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Customizer Admin Functionality
// =============================================================================

// Customizer Admin Functionality
// =============================================================================

jQuery(document).ready(function($) {
  $('#customizer-upload').change(function() {
    $('#customizer-submit').removeAttr('disabled');
  });

  $('a[href="customize.php"], a[href*="customize.php?url="]').click( function(e) {
    $('head').prepend('<style type="text/css"> @import url("http://fonts.googleapis.com/css?family=Lato:100,300,700"); body { overflow: hidden !important; } #x-customizer-preloader { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: #fff; z-index: 9999999; } #x-customizer-preloader #x-customizer-preloader-inner { display: table; position: absolute; top: 50%; left: 50%; width: 250px; height: 250px; margin: -125px 0 0 -125px; text-align: center; background-repeat: no-repeat; background-position: center 155px; background-color: #fff; } #x-customizer-preloader #x-customizer-preloader-inner p.status { display: table-cell; vertical-align: middle; padding: 0 0 10px; font-family: Lato, "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 10px; font-weight: 300; letter-spacing: 2px; line-height: 1.1; text-transform: uppercase; color: #333; } #x-customizer-preloader #x-customizer-preloader-inner p.status span { position: relative; display: block; z-index: 99999999; } #x-customizer-preloader #x-customizer-preloader-inner p.status > span.brand { position: absolute; top: -8px; left: 0; right: 0; font-size: 248px; font-weight: 100; line-height: 1; color: #f2f2f2; z-index: 9999999; } #x-customizer-preloader #x-customizer-preloader-inner p.status > span.customizer { margin: 8px 0; font-size: 36px; font-weight: 300; letter-spacing: -3px; } #x-customizer-preloader #x-customizer-preloader-inner p.status > span.progress { position: absolute; left: 0; right: 0; bottom: 75px; font-weight: 700; } </style>');
    $('body').prepend('<div id="x-customizer-preloader"><div id="x-customizer-preloader-inner"><p class="status"><span class="brand">X</span><span class="loading-the">Loading The</span><span class="customizer">Customizer</span><span class="step">Initializing Controls</span><span class="progress"></span></p></div></div>');
    var progress = $('.progress');
    var timesRun = 0;
    var interval = setInterval( function() {
      timesRun += 1;
      if (progress.html().length > 8) {
        progress[0].innerHTML = '';
      } else {
        progress[0].innerHTML += ' . ';
      }
      if (timesRun === 51) { clearInterval(interval); }
    }, 500);
  });
});