## INTRODUCTION

The induction_project module is a DESCRIBE_THE_MODULE_HERE.

The primary use case for this module is:

- Use case #1
- Use case #2
- Use case #3

## REQUIREMENTS

DESCRIBE_MODULE_DEPENDENCIES_HERE

## INSTALLATION

Install as you would normally install a contributed Drupal module.
See: https://www.drupal.org/node/895232 for further information.

## CONFIGURATION
- Configuration step #1
- Configuration step #2
- Configuration step #3

## MAINTAINERS

Current maintainers for Drupal 10:

- FIRST_NAME LAST_NAME (NICKNAME) - https://www.drupal.org/u/NICKNAME

<?php
/**
 * @file
 * Contains Drupal\welcome\Form\MessagesForm.
 */

namespace Drupal\welcome\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class AdminFormController extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'welcome.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'welcome_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('welcome.adminsettings');

    $form['welcome_message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Welcome message'),
      '#description' => $this->t('Welcome message display to users when they login'),

      '#default_value' => $config->get('welcome_message'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    parent::submitForm($form, $form_state);

    $this->config('welcome.adminsettings')
      ->set('welcome_message', $form_state->getValue('welcome_message'))
      ->save();
  }

}
