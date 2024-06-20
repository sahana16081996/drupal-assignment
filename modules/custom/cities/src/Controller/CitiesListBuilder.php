<?php
namespace Drupal\cities\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for content_entity_manage_inventory entity.
 *
 * @ingroup manage_inventory
 */
class CitiesListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = array(
      '#markup' => $this->t('Content Entity Example implements a Inventory model. These contacts are fieldable entities. You can manage the fields on the <a href="@adminlink">Inventory admin page</a>.', array(
        '@adminlink' => \Drupal::urlGenerator()
          ->generateFromRoute('cities.cities_settings'),
      )),
    );
    $build['table'] = parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the inventory list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
  public function buildHeader() {
    $header['id'] = $this->t('Node Id');
    $header['name'] = $this->t('City Name');
    $header['city_id'] = $this->t('City ID');
    $header['state'] = $this->t('State');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\cities\Entity\cities */
    // dump($entity); die();
    $row['id'] = $entity->id();
    $row['name'] = $entity->name->value;
    $row['city_id'] = $entity->city_id->value;
    $row['state'] = $entity->state->value;
    return $row + parent::buildRow($entity);
  }

}

?>