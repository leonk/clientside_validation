<?php
/**
 * @file
 * Contains \Drupal\clientside_validation\Plugin\CvValidator\Required.
 */

namespace Drupal\clientside_validation\Plugin\CvValidator;

use Drupal\clientside_validation\CvValidatorBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'required' validator.
 *
 * @CvValidator(
 *   id = "required",
 *   name = @Translation("Required")
 * )
 */
class Required extends CvValidatorBase {

  /**
   * {@inheritdoc}
   */
  public function supports(array $element, FormStateInterface $form_state) {
    return isset($element['#required']) && $element['#required'];
  }

  /**
   * {@inheritdoc}
   */
  protected function getRules($element, FormStateInterface $form_state) {
    return [
      'messages' => [
        'required' => t('@title is required.', ['@title' => $element['#title']]),
      ],
    ];
  }

}
