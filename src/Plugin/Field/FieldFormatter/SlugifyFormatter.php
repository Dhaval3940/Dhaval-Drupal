<?php

namespace Drupal\text_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * 'field_text_slugify' Formatter Plugin Implementation.
 *
 * @FieldFormatter(
 *   id = "field_text_slugify",
 *   label = @Translation("Slugify"),
 *   field_types = {
 *   "text",
 *   },
 *  )
 */

class SlugifyFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();
    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $slugify_text = \Drupal::service('text_field_formatter.slugifytext')
                            ->slugifyText($item->value, $this->getSetting('text_separator'));
      $elements[$delta] = array(
        '#type' => 'processed_text',
        '#text' => $slugify_text,
        '#format' => $item->format,
        '#langcode' => $item->getLangcode(),
      );
    }
    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'text_separator' => '-',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['text_separator'] = [
      '#title' => t('Text Separator'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('text_separator'),
    ];
    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();
    $summary[] = t('Text Separator: @text_separator', array('@text_separator' => $this->getSetting('text_separator')));
    return $summary;
  }
}
