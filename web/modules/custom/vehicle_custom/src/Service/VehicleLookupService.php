<?php

declare(strict_types=1);

namespace Drupal\vehicle_custom\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Provides vehicle lookup services.
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
   * Constructs a VehicleLookupService object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager service.
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager, LoggerInterface $logger) {
    $this->entityTypeManager = $entityTypeManager;
    $this->logger = $logger;
  }

  /**
   * Gets title of vehicle node by node ID.
   *
   * @param int $node_id
   *   The node ID.
   *
   * @return string
   *   The title of the vehicle node.
   */
  public function getNodeTitle($node_id){
    $node = $this->entityTypeManager->getStorage('node')->load($node_id);
    $title = $node->label();
    // Log message to 'recent log messages'.
    $this->logger->info('The following nid: @n_id was requested, and the following output returned: @n_title',[
      '@n_id' => $node_id,
      '@n_title' => $title,
    ]);
    return $title;
  }
}
