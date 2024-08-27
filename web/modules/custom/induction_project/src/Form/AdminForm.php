<?php
/**
 * @file
 * Contains Drupal\welcome\Form\MessagesForm.
 */

namespace Drupal\induction_project\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Drupal\Core\Session\AccountInterface;

class AdminForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'induction_project.adminsettings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'induction_project_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('induction_project.adminsettings');
    //$roles = user_role_names();
    $roles = \Drupal::entityTypeManager()->getStorage('user_role')->loadMultiple();
    $roles_checkboxes = [];
    foreach ($roles as $role_id => $role){
      $roles_checkboxes[$role_id] = $role->label();
    }
    $form['custom_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Some custom text'),
      '#description' => $this->t('Text area for entering any content.'),
      '#default_value' => $config->get('custom_text') ?? 'default test',
    ];
    $form['roles_available'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('What roles can see this page?'),
      '#description' => $this->t('Checkboxes for each role - if unchecked, they can’t see the page.'),
      '#options' => $roles_checkboxes,
      '#default_value' => $config->get('roles_available') ?? [],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {

    $config = $this->config('induction_project.adminsettings');
    $config->setData($form_state->getValues())->save();


    parent::submitForm($form, $form_state);
  }

}
