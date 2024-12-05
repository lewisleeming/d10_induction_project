<?php

namespace Drupal\vehicle_custom\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AutocompleteRouteSubscriber extends RouteSubscriberBase {

  public function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('system.entity_autocomplete')) {
      $route->setDefault('_controller', '\Drupal\vehicle_custom\Controller\EntityAutocompleteController::handleAutocomplete');
    }
  }

}
