<?php declare(strict_types=1);

namespace Drupal\event_storage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a Event Storage Module form.
 */
final class EventForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string
  {
    return 'event_storage_event';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array
  {
    $userId = \Drupal::currentUser()->id();

    $event_types_array = [];
    $event_tags_array = [];
    $event_types = \Drupal::database()->select('event_types', 'evt_type')
      ->fields('evt_type', ['event_type', 'event_type_translation'])
      ->execute()->fetchAll();

    foreach ($event_types as $type) {
      $event_types_array[$type->event_type] = t($type->event_type_translation);
    }

    $tags_query = \Drupal::database()->select('events_tags', 'tags');
    $tags_query->fields('tags', ['tag_name']);
    $event_tags = $tags_query->distinct()->execute()->fetchAll();

    foreach ($event_tags as $tag){
      $event_tags_array[$tag->tag_name] = t($tag->tag_name);
    }

    $form['event_title'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Название события'),
      '#required' => TRUE,
      '#maxlenght' => 255,
    ];

    $form['event_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Описание события'),
      '#required' => TRUE,
    ];

    $form['event_type'] = [
      '#type' => 'radios',
      '#title' => $this->t('Тип события'),
      '#required' => TRUE,
      '#options' => $event_types_array,
    ];

    $form['event_tags'] = [
      '#type' => 'select2',
      '#title' => $this->t('Тэги события'),
      '#multiple' => TRUE,
      '#attributes' => ['class' => ['tags-select']],
      '#validated' => TRUE,
      '#exclude' => TRUE,
      '#options' => $event_tags_array,
    ];

    $form['event_start'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Дата начала события'),
      '#required' => TRUE,
    ];

    $form['event_end'] = [
      '#type' => 'datetime',
      '#title' => $this->t('Дата конца события'),
    ];

    $form['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Создать событие'),
      ],
    ];

    $form['#attached'] = ['library' => [
      'event_storage/event-form'
    ]];

    $form_state->set('created_by', $userId);
    $form_state->set('updated_by', $userId);

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
    $eventId = 0;
    $formFields = $form_state->getValues();
    $tags = $formFields['event_tags'];

    $insertFields = [
      'event_title' => $formFields['event_title'],
      'event_description' => $formFields['event_description'],
      'event_type' => $formFields['event_type'],
      'created_by' => $form_state->get('created_by'),
      'updated_by' => null,
      'event_start_at' => $formFields['event_start']->format('Y-m-d H:i:s'),
      'event_end_at' => $formFields['event_end']->format('Y-m-d H:i:s'),
    ];

    try {
      $eventId = \Drupal::database()->insert('event_storage')->fields(
        $insertFields
      )->execute();

      foreach ($tags as $tag) {
        \Drupal::database()->insert('events_tags')->fields(
          ['event_id' => $eventId, 'tag_name' => $tag]
        )->execute();
      }
    } catch (\Exception $e) {
      $this->messenger()->addError($this->t('Произошла ошибка при создании.'));
    }

    if ($eventId > 0) {
      $this->messenger()->addStatus($this->t('Событие успешно создано.'));
    }

    $form_state->setRedirect('event_storage.main_page');
  }

}
