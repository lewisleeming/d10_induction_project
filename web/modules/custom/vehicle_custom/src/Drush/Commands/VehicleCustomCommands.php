<?php

namespace Drupal\vehicle_custom\Drush\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drupal\Core\Utility\Token;
use Drush\Attributes as CLI;
use Drush\Commands\AutowireTrait;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 */
final class VehicleCustomCommands extends DrushCommands {

  use AutowireTrait;

  /**
   * Constructs a VehicleCustomCommands object.
   */
  public function __construct(
    private readonly Token $token,
  ) {
    parent::__construct();
  }

  /**
   * Command description here.
   */
  #[CLI\Command(name: 'vehicle_custom:command-name', aliases: ['foo'])]
  #[CLI\Argument(name: 'arg1', description: 'Argument description.')]
  #[CLI\Option(name: 'option-name', description: 'Option description')]
  #[CLI\Usage(name: 'vehicle_custom:command-name foo', description: 'Usage description')]
  public function commandName($arg1, $options = ['option-name' => 'default']) {
    $this->logger()->success(dt('Achievement unlocked.'));
  }

  /**
   * An example of the table output format.
   */
  #[CLI\Command(name: 'vehicle_custom:token', aliases: ['tokenator'])]
  #[CLI\FieldLabels(labels: [
    'group' => 'Group',
    'token' => 'Token',
    'name' => 'Name',
  ])]
  #[CLI\DefaultTableFields(fields: ['group', 'token', 'name'])]
  #[CLI\FilterDefaultField(field: 'name')]
  public function token($options = ['format' => 'table']): RowsOfFields {
    $all = $this->token->getInfo();
    foreach ($all['tokens'] as $group => $tokens) {
      foreach ($tokens as $key => $token) {
        $rows[] = [
          'group' => $group,
          'token' => $key,
          'name' => $token['name'],
        ];
      }
    }
    return new RowsOfFields($rows);
  }

  #[CLI\Command(name: 'vehicle_custom:populatetable', aliases: ['table-populator'])]
  #[CLI\Option(name: 'option-name', description: 'Option description')]
  #[CLI\Usage(name: 'vehicle_custom:command-name foo', description: 'Usage description')]
  public function populatetable($options = ['option-name' => 'default']) {
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

}
