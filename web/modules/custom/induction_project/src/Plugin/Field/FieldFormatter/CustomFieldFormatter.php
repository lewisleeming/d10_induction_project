<?php

namespace Drupal\induction_project\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FormatterInterface;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'custom_text_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "custom_text_formatter",
 *   label = @Translation("Custom Text Formatter"),
 *   field_types = {
 *     "string",
 *     "text",
 *     "text_long"
 *   }
 * )
 */
class CustomFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays the field with a custom text.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    //items is user input as whole, delta is single text data we want
    foreach ($items as $item_id => $item) {
      // Generate the custom output string.
      //$output = $this->t('THIS IS USING A CUSTOM FIELD FORMATTER: @field', ['@field' => $item->value]);

      // Add the output to the render array.
      //$element[$delta] = ['#markup' => $output];
      $element[$item_id] = [
        '#theme' => 'custom_field_formatter',
        '#field_value' => $item->value,
      ];

      //      return [
      //        '#theme' => 'custom_field_formatter',
      //        '#hello_world' => $this->$output,
      //      ];

    }
    return $element;
  }

}
