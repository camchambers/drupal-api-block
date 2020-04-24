<?php

namespace Drupal\drupal_api_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DogBlock' block.
 *
 * @Block(
 *  id = "dog_block",
 *  admin_label = @Translation("Dogs"),
 * )
 */
class DogBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {

    return [
      'breed' => 'labrador',
      'number_of_pictures_to_show' => 3,
    ] + parent::defaultConfiguration();
    
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['breed'] = [
      '#type' => 'radios',
      '#title' => $this->t('Breed'),
      '#description' => $this->t('Select a dog breed to list'),
      '#options' => ['labrador' => $this->t('labrador'), 'pug' => $this->t('pug'), 'husky' => $this->t('husky')],
      '#default_value' => $this->configuration['breed'],
      '#weight' => '0',
    ];

    $form['number_of_pictures_to_show'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of pictures to show'),
      '#description' => $this->t('Number of pictures'),
      '#default_value' => $this->configuration['number_of_pictures_to_show'],
      '#weight' => '0',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

    $this->configuration['breed'] = $form_state->getValue('breed');
    $this->configuration['number_of_pictures_to_show'] = $form_state->getValue('number_of_pictures_to_show');
  
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    $build = [];
    $build['#theme'] = 'dog_block';
    $build['#conten'][] = $this->configuration['breed'];
    $build['#conten'][] = $this->configuration['number_of_pictures_to_show'];

    return $build;

  }

}
