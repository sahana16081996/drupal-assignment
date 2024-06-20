<?php


namespace Drupal\cities\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a form for deleting a cities entity.
 *
 * @ingroup cities
 */
class CitiesDeleteForm extends ContentEntityConfirmFormBase
{

    /**
     * {@inheritdoc}
     */
    public function getQuestion()
    {
        return $this->t('Are you sure you want to delete entity %name?', array('%name' => $this->entity->label()));
    }

    /**
     * {@inheritdoc}
     *
     * If the delete command is canceled, return to the contact list.
     */
    public function getCancelURL()
    {
        return new Url('entity.content_entity_cities.collection');
    }

    /**
     * {@inheritdoc}
     */
    public function getConfirmText()
    {
        return $this->t('Delete');
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $entity = $this->getEntity();
        $entity->delete();

        \Drupal::logger('cities')->notice(
            '@type: deleted %title.',
            array(
            '@type' => $this->entity->bundle(),
            '%title' => $this->entity->label(),
            )
        );
        $form_state->setRedirect('entity.content_entity_cities.collection');
    }

}

?>