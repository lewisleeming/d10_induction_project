<?php

/**
 * Implements hook_views_data().
 */
function vehicle_custom_views_data() {
  $data['vehicle_custom_table'] = [
    'table' => [
      'group' => t('Vehicle Data'),
      'provider' => 'vehicle_custom',
      'base' => [
        'field' => 'custom_id',  // Primary key of the table
        'title' => t('Vehicle Data'),
      ],
    ],
    'custom_id' => [
      'title' => t('Custom ID'),
      'help' => t('The unique identifier for the vehicle.'),
      'field' => [
        'id' => 'numeric',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ],
    'vehicle_name' => [
      'title' => t('Vehicle Name'),
      'help' => t('The name of the vehicle.'),
      'field' => [
        'id' => 'standard',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'string',
      ],
      'argument' => [
        'id' => 'string',
      ],
    ],
    'vehicle_colour' => [
      'title' => t('Vehicle Colour'),
      'help' => t('The color of the vehicle.'),
      'field' => [
        'id' => 'standard',
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'string',
      ],
      'argument' => [
        'id' => 'string',
      ],
    ],
    'owner_id' => [
      'title' => t('Owner ID'),
      'help' => t('The ID of the vehicle owner.'),
      'relationship' => [
        'base' => 'users_field_data',
        'base field' => 'uid',
        'id' => 'standard',
        'label' => t('User who owns the vehicle'),
      ],
      'sort' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
    ],
  ];
  return $data;
}
