<?php

namespace Drupal\mobile\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal;

/**
 * Plugin implementation of the 'mobileDefaultFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "mobileDefaultFormatter",
 *   label = @Translation("mobile"),
 *   field_types = {
 *     "mobile"
 *   }
 * )
 */
class mobileDefaultFormatter extends FormatterBase {

  /**
   * Define how the field type is showed.
   * 
   * Inside this method we can customize how the field is displayed inside 
   * pages.
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {

    $elements = [];
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'markup',
        '#markup' => $item->mobile
      ];
    }

    return $elements;
  }
  
} // class