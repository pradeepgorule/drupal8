<?php

namespace Drupal\mobile\Plugin\Field\FieldWidget;

use Drupal;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'mobileDefaultWidget' widget.
 *
 * @FieldWidget(
 *   id = "mobileDefaultWidget",
 
 *   field_types = {
 *     "mobile"
 *   }
 * )
 */
class mobileDefaultWidget extends WidgetBase {

  /**
   * Define the form for the field type.
   * 
   * Inside this method we can define the form used to edit the field type.
   * 
   * Here there is a list of allowed element types: https://goo.gl/XVd4tA
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta, 
    Array $element, 
    Array &$form, 
    FormStateInterface $formState
  ) {

    // Street

    $element['mobile'] = [
      '#type' => 'textfield',
      '#title' => t('mobile'),

      // Set here the current value for this field, or a default value (or 
      // null) if there is no a value
    

      '#empty_value' => '',
      '#placeholder' => t('mobile'),
    ];

    // City

   

    return $element;
  }

}