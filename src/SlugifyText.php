<?php

namespace Drupal\text_field_formatter;

use Cocur\Slugify\Slugify;

/**
 * Class for SlugifyText.
 *
 * @package Drupal\text_field_formatter
 */
class SlugifyText {
  public static function slugifyText($str, $sperator) {
    $slugify = new Slugify();
    $slugify_text = $slugify->slugify($str, $sperator);
    return $slugify_text;
  }
}
