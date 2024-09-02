<?php

namespace Drupal\induction_project\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\Attribute\Block;
use Drupal\Core\StringTranslation\TranslatableMarkup;

/**
 * Provides a 'Hello' Block.
 */
#[Block(
  id: "my_custom_block",
  admin_label: new TranslatableMarkup("My Custom Block"),
  category: new TranslatableMarkup("My Custom Block"),
)]
class MyCustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => $this->t('This is a custom block.'),
    ];
  }

}
