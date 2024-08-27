<?php

namespace Drupal\induction_project\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;


class VehicleController extends ControllerBase {

  public function access(AccountInterface $account) {
    // Check permissions and combine that with any custom access checking needed. Pass forward
    // parameters from the route and/or request as needed.
    //    return AccessResult::allowedIf($account->hasPermission('Vehicle Editor') && $this->someOtherCustomCondition());
    $roles = $account->getRoles();
    //Here I need to access form data to get the roles selected
    $config = \Drupal::config('induction_project.adminsettings');
    $roles_from_form = array_filter($config->get('roles_available') ?: []);
//    $selected_form_roles = [];
//    foreach($roles_from_form as $role_id => $role) {
//      if($role != 0) {
//        $selected_form_roles[$role_id] = $role;
//      }
//    }
    //get selected valid roles from form

    // Check if the user has any of the roles that are allowed access.
    foreach ($roles as $role) {
      if (in_array($role, $roles_from_form)) {
        return AccessResult::allowed();
      }
    }

    if (in_array('administrator', $roles)) {
      return AccessResult::allowed();
    }
    return AccessResult::forbidden();
  }

  //  public function access(AccountInterface $account) {
  //    return $account->hasPermission('Vehicle Editor');
  //  }
  public function content(): array {
    return [
      '#theme' => 'vehicle_template',
      '#hello_world' => $this->t('Test Value'),
    ];
  }

  public function viewVehicle(NodeInterface $vehicle_nid): array {
    // Get the title of the vehicle.
    $vehicle_title = $vehicle_nid->label();

    // Get the author's name.
    $author_name = $vehicle_nid->getOwner()->label();
    // Return a render array.
    return [
      '#theme' => 'vehicle_template',
      '#hello_world' => $this->t('Test Value'),
      '#vehicle_title' => $vehicle_title,
      '#author_name' => $author_name,
    ];

    //    return [
    //      '#markup' => $this->t('Hello World<br/>Title: @title<br/>Author: @author', [
    //        '@title' => $vehicle_title,
    //        '@author' => $author_name,
    //      ]),
    //    ];
  }
}
