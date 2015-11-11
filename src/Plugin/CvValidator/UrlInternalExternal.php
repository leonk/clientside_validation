<?php
/**
 * @file
 * Contains \Drupal\clientside_validation\Plugin\CvValidator\UrlInternalExternal.
 */

namespace Drupal\clientside_validation\Plugin\CvValidator;

use Drupal\clientside_validation\CvValidatorBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'url' validator for internal url.
 *
 * @CvValidator(
 *   id = "url_internal_external",
 *   name = @Translation("Url - Internal/External"),
 *   supports = {
 *     "types" = {
 *       "entity_autocomplete"
 *     }
 *   }
 * )
 */
class UrlInternalExternal extends CvValidatorBase {

  /**
   * {@inheritdoc}
   */
  protected function getRules($element, FormStateInterface $form_state) {
    return [
      'messages' => [
        'pattern' => $this->t('@title does not contain a valid url.', ['@title' => $element['#title']]),
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function addValidation(array &$element, FormStateInterface $form_state) {
    parent::addValidation($element, $form_state);
  // @todo detect type of url reference.
    $element['#attributes']['pattern'] = '\<front\>|\/.*|\?.*|#.*|[hH][tT][Tt][pP][sS]?://.+|.*\(\d+\)';
  }

}
