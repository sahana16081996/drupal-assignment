<?php

namespace Drupal\cities;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Inventory entity.
 *
 * @ingroup cities
 */
interface CitiesInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
