<?php

namespace Drupal\cities;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Inventory entity.
 *
 * @ingroup cities
 */
interface CitiesInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface
{

}
?>