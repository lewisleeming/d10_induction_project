<?php

declare(strict_types=1);

namespace Drupal\vehicle_custom\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * @todo Add class description.
 */
final class VehicleLookupService {

  /**
   * @var \Psr\Log\LoggerInterface
   */
  private LoggerInterface $logger;
  /**
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  private EntityTypeManagerInterface $entityTypeManager;

  /**
   * @todo Add method description.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, LoggerInterface $logger) {
    $this->entityTypeManager = $entityTypeManager;
    $this->logger = $logger;
  }
  public function getVehicleTitleByNid($node_id){
    // @todo Place your code here.
    $node = $this->entityTypeManager->getStorage('node')->load($node_id);
    $title = $node->label();

    \Drupal::logger('vehicle_custom')->info('The following nid: @nodeid was requested, and the following output returned: @node_title',[
      '@nodeid' => $node_id,
      '@node_title' => $title,
    ]);
    //doesnt work
//    $this->logger->warning('The following nid: @nodeid was requested, and the following output returned: @node_title',[
//      '@nodeid' => $node_id,
//      '@node_title' => $title,
//    ]);

    return $title;

  }

}
