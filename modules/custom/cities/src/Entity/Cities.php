<?php
/**
 * @file
 * Contains \Drupal\cities\Entity\Contact.
 */

namespace Drupal\cities\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\cities\CitiesInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Cities entity.
 *
 * The following construct is the actual definition of the entity type which
 * is read and cached. Don't forget to clear cache after changes.
 *
 * @ContentEntityType(
 *   id = "content_entity_cities",
 *   label = @Translation("Cities"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\cities\Controller\CitiesListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\cities\Form\CitiesForm",
 *       "edit" = "Drupal\cities\Form\CitiesForm",
 *       "delete" = "Drupal\cities\Form\CitiesDeleteForm",
 *     },
 *     "access" = "Drupal\cities\CitiesAccessControlHandler",
 *   },
 *   base_table = "cities",
 *   admin_permission = "administer cities entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/content_entity_cities/{content_entity_cities}",
 *     "edit-form" = "/content_entity_cities/{content_entity_cities}/edit",
 *     "delete-form" = "/cities/{content_entity_cities}/delete",
 *     "collection" = "/content_entity_cities/list"
 *   },
 *   field_ui_base_route = "cities.cities_settings",
 * )
 */

class Cities extends ContentEntityBase implements CitiesInterface
{

    /**
     * {@inheritdoc}
     */
    public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
    {
        parent::preCreate($storage_controller, $values);
        $values += array(
        'user_id' => \Drupal::currentUser()->id(),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedTime()
    {
        return $this->get('created')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getChangedTime()
    {
        return $this->get('changed')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setChangedTime($timestamp)
    {
        $this->set('changed', $timestamp);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getChangedTimeAcrossTranslations()
    {
        $changed = $this->getUntranslated()->getChangedTime();
        foreach ($this->getTranslationLanguages(false) as $language) {
            $translation_changed = $this->getTranslation($language->getId())
                ->getChangedTime();
            $changed = max($translation_changed, $changed);
        }
        return $changed;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->get('user_id')->entity;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwnerId()
    {
        return $this->get('user_id')->target_id;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwnerId($uid)
    {
        $this->set('user_id', $uid);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner(UserInterface $account)
    {
        $this->set('user_id', $account->id());
        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * Define the field properties here.
     *
     * Field name, type and size determine the table structure.
     *
     * In addition, we can define how the field and its content can be manipulated
     * in the GUI. The behaviour of the widgets used can be determined here.
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {

        // Standard field, used as unique if primary index.
        $fields['id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('ID'))
            ->setDescription(t('The ID of the cities entity.'))
            ->setReadOnly(true);

        // Standard field, unique outside of the scope of the current project.
        $fields['uuid'] = BaseFieldDefinition::create('uuid')
            ->setLabel(t('UUID'))
            ->setDescription(t('The UUID of the cities entity.'))
            ->setReadOnly(true);

        $fields['city_id'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('City Id'))
            ->setDescription(t('The Id of the city.'))
            ->setSettings(
                array(
                'default_value' => '',
                )
            )
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'integer',
                'weight' => -5,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'integer',
                'weight' => -5,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);

        // Name field for the contact.
        // We set display options for the view as well as the form.
        // Users with correct privileges can change the view and edit configuration.

        $fields['name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Name'))
            ->setDescription(t('The name of the city entity.'))
            ->setSettings(
                array(
                'default_value' => '',
                'max_length' => 255,
                'text_processing' => 0,
                )
            )
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'string',
                'weight' => -6,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'string',
                'weight' => -6,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);

        $fields['pop'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Population'))
            ->setDescription(t('The population of the city.'))
            ->setSettings(
                array(
                'default_value' => '',
                )
            )
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'integer',
                'weight' => -5,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'integer',
                'weight' => -5,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);

        $fields['lat'] = BaseFieldDefinition::create('float')
            ->setLabel(t('Latitude'))
            ->setDescription(t('The Latitude of the city.'))
            ->setSettings(
                array(
                'default_value' => '',
                )
            )
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'float',
                'weight' => -5,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'float',
                'weight' => -5,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);

        $fields['lan'] = BaseFieldDefinition::create('float')
            ->setLabel(t('Longitude'))
            ->setDescription(t('The Longitude of the city.'))
            ->setSettings(
                array(
                'default_value' => '',
                )
            )
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'float',
                'weight' => -5,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'float',
                'weight' => -5,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);



        $fields['state'] = BaseFieldDefinition::create('string')
            ->setLabel(t('State'))
            ->setDescription(t('The State of the city.'))
            ->setSettings(
                array(
                'default_value' => '',
                'max_length' => 255,
                'text_processing' => 0,
                )
            )
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'string',
                'weight' => -5,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'string',
                'weight' => -5,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);


        // Owner field of the contact.
        // Entity reference field, holds the reference to the user object.
        // The view shows the user name field of the user.
        // The form presents a auto complete field for the user name.
        $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('User Name'))
            ->setDescription(t('The Name of the associated user.'))
            ->setSetting('target_type', 'user')
            ->setSetting('handler', 'default')
            ->setDisplayOptions(
                'view', array(
                'label' => 'above',
                'type' => 'entity_reference',
                'weight' => -3,
                )
            )
            ->setDisplayOptions(
                'form', array(
                'type' => 'entity_reference_autocomplete',
                'settings' => array(
                'match_operator' => 'CONTAINS',
                'size' => 60,
                'autocomplete_type' => 'tags',
                'placeholder' => '',
                ),
                'weight' => -3,
                )
            )
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);


        $fields['created'] = BaseFieldDefinition::create('created')
            ->setLabel(t('Created'))
            ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
            ->setLabel(t('Changed'))
            ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }
}

?>