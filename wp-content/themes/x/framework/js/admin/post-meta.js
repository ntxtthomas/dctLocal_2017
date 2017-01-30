// =============================================================================
// JS/ADMIN/POST-META.JS
// -----------------------------------------------------------------------------
// Show/hide Post Format meta boxes as needed, as well as meta boxes for Icon.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Show/Hide Post Format Meta Boxes
//   02. Show/Hide Icon Meta Boxes
// =============================================================================

// Show/Hide Post Format Meta Boxes
// =============================================================================

jQuery(document).ready(function($) {

  var quoteOptions = $('#x-meta-box-quote');
  var quoteTrigger = $('#post-format-quote');

  var linkOptions = $('#x-meta-box-link');
  var linkTrigger = $('#post-format-link');

  var audioOptions = $('#x-meta-box-audio');
  var audioTrigger = $('#post-format-audio');

  var videoOptions = $('#x-meta-box-video');
  var videoTrigger = $('#post-format-video');

  var group = $('#post-formats-select input');

  xHideAll(null);

  group.change( function() {
    xHideAll(null);
    if ($(this).val() == 'quote') {
      quoteOptions.css('display', 'block');
    } else if ($(this).val() == 'link') {
      linkOptions.css('display', 'block');
    } else if ($(this).val() == 'audio') {
      audioOptions.css('display', 'block');
    } else if ($(this).val() == 'video') {
      videoOptions.css('display', 'block');
    }
  });

  if (quoteTrigger.is(':checked'))
    quoteOptions.css('display', 'block');

  if (linkTrigger.is(':checked'))
    linkOptions.css('display', 'block');

  if (audioTrigger.is(':checked'))
    audioOptions.css('display', 'block');

  if (videoTrigger.is(':checked'))
    videoOptions.css('display', 'block');

  function xHideAll(notThisOne) {
    videoOptions.css('display', 'none');
    quoteOptions.css('display', 'none');
    linkOptions.css('display', 'none');
    audioOptions.css('display', 'none');
  }

});



// Show/Hide Icon Meta Boxes
// =============================================================================

jQuery(document).ready(function($) {

  var iconOptions = $('#x-meta-box-page-icon');
  var iconTrigger = $('#page_template option[value*="template-blank"]');
  var group       = $('#page_template');

  if ( iconTrigger.is(':checked') ) {
    iconOptions.css('display', 'block');
  } else {
    iconOptions.css('display', 'none');
  }

  group.change( function() {
    if ( iconTrigger.is(':checked') ) {
      iconOptions.css('display', 'block');
    } else {
      iconOptions.css('display', 'none');
    }
  });

});