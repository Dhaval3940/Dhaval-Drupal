<?php

namespace Drupal\text_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;


/**
 * 'field_text_rot13' Formatter Plugin Implementation.
 *
 * @FieldFormatter(
 *   id = "field_text_rot13",
 *   label = @Translation("ROT13"),
 *   field_types = {
 *     "text",
 *   },
 * )
 */

class ROT13Formatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($items as $delta => $item) {
      $elements[$delta] = array(
        '#type' => 'processed_text',
        '#text' => $this->custom_str_rot13($item->value),
        '#format' => $item->format,
        '#langcode' => $item->getLangcode(),
      );
    }

    return $elements;
  }

  /**
   * Implementing the rotation function for strings.
   */
  public function custom_str_rot13($s) {
    $rot = 13;
    static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
    $rot = (int)$rot % 26;
    $rep = substr($letters, $rot * 2) . substr($letters, 0, $rot * 2);
    return strtr($s, $letters, $rep);
  }
}
