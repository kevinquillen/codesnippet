(function ($, Drupal) {
  Drupal.behaviors.codesnippet = {
    attach: function (context, settings) {
      $('pre code').each(function(i, e) {hljs.highlightBlock(e)});
    }
  }
})(jQuery, Drupal);