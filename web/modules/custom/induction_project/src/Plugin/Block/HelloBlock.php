<?php

namespace Drupal\induction_project\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Provides a 'Hello' Block.
 */

/**
 * Provides a block module example block.
 *
 * @Block(
 *   id = "block_module_block_module_example",
 *   admin_label = @Translation("Block Module Example"),
 *   category = @Translation("Custom")
 * )
 */
#[Block(
  id: "hello_block",
  admin_label: new TranslatableMarkup("Hello block"),
  category: new TranslatableMarkup("Hello World")
)]
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('Hello, World!'),
    ];
  }

}
