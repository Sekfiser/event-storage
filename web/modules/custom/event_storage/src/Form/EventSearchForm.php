<?php declare(strict_types=1);

namespace Drupal\event_storage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Event Storage Module form.
 */
final class EventSearchForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string
  {
    return 'event_storage_event_search';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array
  {
    $title = \Drupal::request()->query->get('title') ?? null;
    $description = \Drupal::request()->query->get('description') ?? null;
    $searchType = \Drupal::request()->query->get('type') ?? null;
    $tags = \Drupal::request()->query->get('tags') ?? null;
    $searchTags = [];
    $event_types_array = [];
    $event_tags_array = [];

    $event_types = \Drupal::database()->select('event_types', 'evt_type')
      ->fields('evt_type', ['event_type', 'event_type_translation'])
      ->execute()->fetchAll();

    foreach ($event_types as $type) {
      $event_types_array[$type->event_type] = t($type->event_type_translation);
    }

    $event_types_array[''] = 'Нет типа события';

    $tags_query = \Drupal::database()->select('events_tags', 'tags');
    $tags_query->fields('tags', ['tag_name']);
    $event_tags = $tags_query->distinct()->execute()->fetchAll();

    foreach ($event_tags as $tag) {
      $event_tags_array[$tag->tag_name] = $tag->tag_name;
    }

    if($tags){
        $searchTags = unserialize($tags);
    }

    $form['search_collapse'] = [
      '#type' => 'details',
      '#title' => t('Search'),
    ];

    $form['search_collapse']['event_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Заголовок'),
      '#size' => 120,
      '#default_value' => $title
    ];

    $form['search_collapse']['event_description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Описание события'),
      '#default_value' => $description
    ];

    $form['search_collapse']['event_tags'] = [
      '#type' => 'select2',
      '#title' => $this->t('Тэги события'),
      '#multiple' => true,
      '#options' => $event_tags_array,
      '#default_value' => $searchTags,
    ];

    $form['search_collapse']['event_type'] = [
      '#type' => 'radios',
      '#title' => $this->t('Тип события'),
      '#options' => $event_types_array,
      '#default_value' => $searchType,
    ];

    $form['search_collapse']['actions'] = [
      '#type' => 'actions',
      'submit' => [
        '#type' => 'submit',
        '#value' => $this->t('Поиск'),
      ],
    ];

    $form_state->set('page', \Drupal::request()->query->get('page'));

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
    $formFields['event_tags'];

    $searchForm = [
      'page' => 1,
      'title' => $formFields['event_title'],
      'description' => $formFields['event_description'],
      'type' => $formFields['event_type'],
      'tags' => serialize($formFields['event_tags']),
    ];

    $form_state->setRedirect('event_storage.main_page', $searchForm);
  }

}
