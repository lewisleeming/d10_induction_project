<?php

/**
 * @file
 * Run using: drush scr modules/custom/oi_core/update-url-patterns.php.
 */

/**
 * Set new aliases and update redirects to avoid unnecessary chains.
 */
function read_from_csv(): void{
  /** @var \Drupal\Core\Database\Connection $connection */
  $connection = \Drupal::service('database');

  // File containing a list of alias suggestions.
  $csv = file('../vehicle_custom_data.csv');//keep
  $data = [];
  foreach ($csv as $line_id => $line) {
    $data[] = str_getcsv($line);
    if ($line_id === 0) {
      continue;
    }
    // Insert data into the table.
    $connection->insert('vehicle_custom_table')
      ->fields([
        'custom_id' => $data[$line_id][0],
        'vehicle_name' => $data[$line_id][1],
        'vehicle_colour' => $data[$line_id][2],
        'owner_id' => $data[$line_id][3],
      ])
      ->execute();
  }
}

read_from_csv();
