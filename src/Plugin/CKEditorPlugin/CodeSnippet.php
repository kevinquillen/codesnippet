<?php

/**
 * @file
 * Contains \Drupal\codesnippet\Plugin\CKEditorPlugin\CodeSnippet.
 */

namespace Drupal\codesnippet\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\ckeditor\CKEditorPluginConfigurableInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\editor\Entity\Editor;
use Drupal\Core\Url;

/**
 * Defines the "codesnippet" plugin.
 *
 * @CKEditorPlugin(
 *   id = "codesnippet",
 *   label = @Translation("CodeSnippet"),
 *   module = "ckeditor"
 * )
 */
class CodeSnippet extends CKEditorPluginBase implements CKEditorPluginConfigurableInterface {
  /**
   * {@inheritdoc}
   */
  public function getFile() {
    return drupal_get_path('module', 'codesnippet') . '/js/plugins/codesnippet/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return array(
      'CodeSnippet' => array(
        'label' => t('CodeSnippet'),
        'image' => drupal_get_path('module', 'codesnippet') . '/js/plugins/codesnippet/icons/codesnippet.png',
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state, Editor $editor) {
    $settings = $editor->getSettings();
    $styles = $this->getStyles();

    $form['highlight_style'] = array(
      '#type' => 'select',
      '#title' => 'highlight.js Style',
      '#description' => t('Select a style to apply to all highlighted code snippets. You can preview the styles at !link.', array('!link' => \Drupal::l('https://highlightjs.org/static/demo', Url::fromUri('https://highlightjs.org/static/demo/')))),
      '#options' => $styles,
      '#default_value' => !empty($settings['plugins']['codesnippet']['highlight_style']) ? $settings['plugins']['codesnippet']['highlight_style'] : 'arta.css',
    );

    return $form;
  }

  /**
   * Returns available stylesheets to use for code syntax highlighting.
   */
  private function getStyles() {
    $styles = preg_grep('/\.css/', scandir(drupal_get_path('module', 'codesnippet') . '/js/plugins/codesnippet/lib/highlight/styles'));
    $style_options = array();

    foreach ($styles as $stylesheet) {
      $style_options[$stylesheet] = $stylesheet;
    }

    return $style_options;
  }
}