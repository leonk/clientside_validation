<?php
/**
 * @file
 * Contains \Drupal\clientside_validation\Plugin\CvValidator\Max.
 */

namespace Drupal\clientside_validation\Plugin\CvValidator;

use Drupal\clientside_validation\CvValidatorBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'max' validator.
 *
 * @CvValidator(
 *   id = "max",
 *   name = @Translation("Maximum"),
 *   supports = {
 *     "attributes" = {"max"}
 *   }
 * )
 */
class Max extends CvValidatorBase {

  /**
   * {@inheritdoc}
   */
  protected function getRules($element, FormStateInterface $form_state) {
    // Drupal already adds the required attribute, so we don't need to set the
    // required rule.
    if (isset($element['#max'])) {
      return [
        'messages' => [
          'max' => t('The value in @title has to be greater than @max.', ['@title' => $element['#title'], '@max' => $element['#max']]),
        ],
      ];
    }
  }

}
