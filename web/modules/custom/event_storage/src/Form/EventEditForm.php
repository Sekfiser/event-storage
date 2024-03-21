<?php declare(strict_types=1);

namespace Drupal\event_storage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
/**
 * Provides a Event Storage Module form.
 */
final class EventEditForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string
  {
    return 'event_storage_event_edit';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $eventId = NULL): array
  {

    $event = \Drupal::database()->select('event_storage', 'evt')
      ->fields('evt', ['event_title', 'event_description', 'event_type', 'event_start_at', 'event_end_at'])
      ->condition('event_id', $eventId)->execute()->fetch();

    $event_types_array = [];
    $event_types = \Drupal::database()->select('event_types', 'evt_type')
      ->fields('evt_type', ['event_type', 'event_type_translation'])
      ->execute()->fetchAll();

    foreach ($event_types as $type) {
      $event_types_array[$type->event_type] = t($type->event_type_translation);
    }

    $event_types_array[''] = 'Нет типа события';

    $tags_array = [];
    $event_tags_array = [];

    $event_tags_query = \Drupal::database()->select('events_tags', 'tags');
    $event_tags_query->fields('tags', ['tag_name']);
    $event_tags = $event_tags_query->condition('event_id', $eventId)->execute()->fetchAll();

    foreach ($event_tags as $tag) {
      $event_tags_array[$tag->tag_name] = $tag->tag_name;
    }

    $tags_query = \Drupal::database()->select('events_tags', 'tags');
    $tags_query->fields('tags', ['tag_name']);
    $tags = $tags_query->distinct()->execute()->fetchAll();

    foreach ($tags as $tag) {
      $tags_array[$tag->tag_name] = $tag->tag_name;
    }

    $form['event_title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Заголовок события'),
      '#required' => TRUE,
      '#maxlenght' => 255,
      '#default_value' => $event->event_title,
    ];

    $form['event_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Описание события'),
      '#required' => TRUE,
      '#default_value' => $event->event_description,
    ];

    $form['event_tags'] = [
      '#type' => 'select2',
      '#title' => $this->t('Тэги события'),
      '#multiple' => TRUE,
      '#attributes' => ['class' => ['tags-select']],
      '#validated' => TRUE,
      '#exclude' => TRUE,
      '#options' => $tags_array,
      '#default_value' => $event_tags_array,
    ];

    $form['event_type'] = [
      '#type' => 'radios',
      '#title' => $this->t('Тип события'),
      '#required' => TRUE,
      '#options' => $event_types_array,
      '#default_value' => $event->event_type,
    ];

    $form['event_start'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Дата начала события'),
      '#required' => TRUE,
      '#default_value' => $event->event_start_at ? new DrupalDateTime($event->event_start_at) : null,
    ];

    $form['event_end'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Дата конца события'),
      '#default_value' => $event->event_end_at ? new DrupalDateTime($event->event_end_at) : null,
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Сохранить событие'),
      ],
    ];

    $form['#attached'] = ['library' => [
      'event_storage/event-form'
    ]];

    $form_state->set('event_id', $eventId);
    $form_state->set('updated_by', \Drupal::currentUser()->id());

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void
  {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if (mb_strlen($form_state->getValue('message')) < 10) {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('Message should be at least 10 characters.'),
    //     );
    //   }
    // @endcode
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void
  {
    $formFields = $form_state->getValues();
    $rowCount = 0;
    if ($form_state->get('event_id') > 0) {
      $tags = $formFields['event_tags'];
      $eventId = $form_state->get('event_id');
      $insertForm = [
        'updated_by' => $form_state->get('updated_by'),
        'event_title' => $formFields['event_title'],
        'event_description' => $formFields['event_description'],
        'event_type' => $formFields['event_type'],
        'event_start_at' => $formFields['event_start']->date,
        'event_end_at' => $formFields['event_end']->date,
      ];

      try {
        $rowCount = \Drupal::database()->update('event_storage')->fields(
          $insertForm
        )->condition('event_id', $eventId)->execute();

        \Drupal::database()->delete('events_tags')->condition('event_id', $eventId)->execute();

        foreach ($tags as $tag) {
          \Drupal::database()->insert('events_tags')->fields(
            ['event_id' => $eventId, 'tag_name' => $tag]
          )->execute();
        }

      } catch (\Exception $e) {
        $this->messenger()->addError($this->t('Произошла ошибка при редактировании.'));
      }

      if ($rowCount == 1) {
        $this->messenger()->addStatus($this->t('Событие успешно изменено.'));
      } else {
        $this->messenger()->addWarning($this->t('Произошла ошибка при обновлении.'));
      }

      $form_state->setRedirect('event_storage.main_page');
    } else {
      $this->messenger()->addError($this->t('Произошла ошибка при редактировании.'));
      $form_state->setRedirect('event_storage.main_page');
    }
  }

}
