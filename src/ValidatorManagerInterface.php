<?php

/**
 * @file
 * Contains \Drupal\clientside_validation\ValidatorManagerInterface.
 */

namespace Drupal\clientside_validation;

use Drupal\Component\Plugin\PluginManagerInterface;
use Drupal\Component\Plugin\Discovery\CachedDiscoveryInterface;
use Drupal\Core\Form\FormStateInterface;

interface ValidatorManagerInterface extends PluginManagerInterface, CachedDiscoveryInterface {

  /**
   * Get validators for a form element.
   *
   * @param array $element
   *   The form element to get the validators for.
   */
  public function getValidators($element, FormStateInterface $form_state);

}
