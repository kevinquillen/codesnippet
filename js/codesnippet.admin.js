/**
 * @file
 * CKEditor 'codesnippet' plugin admin behavior.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * Provides the summary for the "codesnippet" plugin settings vertical tab.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches summary behaviour to the "codesnippet" settings vertical tab.
   */
  Drupal.behaviors.ckeditorCodeSnippetSettingsSummary = {
    attach: function () {
      $('[data-ckeditor-plugin-id="codesnippet"]').drupalSetSummary(function (context) {
        var style = 'None selected';
        var selected = $('#edit-editor-settings-plugins-codesnippet-highlight-style').val();

        if (typeof selected !== 'undefined') {
          style = selected;
        }

        var output = '';
        output += Drupal.t('@style active', {'@style': style});
        return output;
      });
    }
  };

})(jQuery, Drupal, drupalSettings);
