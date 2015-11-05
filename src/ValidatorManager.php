<?php

/**
 * @file
 * Contains \Drupal\clientside_validation\ValidatorManager.
 */

namespace Drupal\clientside_validation;

use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Validator plugin manager.
 */
class ValidatorManager extends DefaultPluginManager implements ValidatorManagerInterface {

  /**
   * Constructs an ValidatorManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations,
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct('Plugin/CvValidator', $namespaces, $module_handler, 'Drupal\clientside_validation\CvValidatorInterface', 'Drupal\clientside_validation\Annotation\CvValidator');
    $this->alterInfo('clientside_validation_validator_info');
    $this->setCacheBackend($cache_backend, 'clientside_validation_validators');
  }

  /**
   * {@inheritdoc}
   */
  public function getValidators($element, FormStateInterface $form_state) {
    // TODO: Investigate how ContextAware plugins or plugin mappers work and
    // whether we can use them for this?
    $validator_instances = array();
    $validators = $this->getDefinitions();
    foreach ($validators as $validator) {
      $instance = $this->createInstance($validator['id']);
      if ($instance->supports($element, $form_state)) {
        $validator_instances[] = $instance;
      }
    }
    return $validator_instances;
  }

}
