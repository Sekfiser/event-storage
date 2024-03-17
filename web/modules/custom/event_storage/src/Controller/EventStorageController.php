<?php

namespace Drupal\event_storage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\PageCache\ResponsePolicy\KillSwitch;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bridge\Twig\Extension\RoutingExtension;

/**
 * Provides route responses for the Example module.
 */
class EventStorageController extends ControllerBase
{
  protected $killSwitch;
  protected $items_per_page = 5;
  /**
   * Returns a simple page.
   *
   * @return array
   *   A simple renderable array.
   */

  /**
   * {@inheritdoc}
   */
  public function __construct(KillSwitch $kill_switch)
  {
    $this->killSwitch = $kill_switch;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container)
  {
    return new static(
      $container->get('page_cache_kill_switch')
    );
  }

  public function content()
  {
    $page = \Drupal::request()->query->get('page');

    $currentPage = $page > 0 ? $page : 1;

    return $this->eventPage($currentPage, \Drupal::request()->query->all());
  }

  public function deleteEvent($eventId = null)
  {
    \Drupal::database()->delete('events_tags')->condition('event_id', $eventId)->execute();
    \Drupal::database()->delete('event_storage')->condition('event_id', $eventId)->execute();

    $this->messenger()->addStatus($this->t('Событие удалено.'));

    return $this->redirect('event_storage.main_page', \Drupal::request()->query->all());
  }

  /**
   * @param int $currentPage
   * @return array
   */
  private function eventPage(int $currentPage, array $currentFilters = []): array
  {
    $title = \Drupal::request()->query->get('title') ?? null;
    $description = \Drupal::request()->query->get('description') ?? null;
    $type = \Drupal::request()->query->get('type') ?? null;
    $tags = \Drupal::request()->query->get('tags') ?? null;

    $query = \Drupal::database()->select('event_storage', 'e');
    $query->leftJoin('event_types', 'et', 'e.event_type = et.event_type');
    $query->fields('e', ['event_id', 'event_title', 'event_description', "event_created_at", 'event_type', 'event_start_at', 'event_end_at']);
    $query->fields('et', ['event_type_translation']);
    $query->orderBy('event_id', 'ASC');

    if ($title) {
      $query->condition('e.event_title', '%' . $query->escapeLike($title) . '%', 'LIKE');
    }
    if ($description) {
      $query->condition('e.event_description', '%' . $query->escapeLike($description) . '%', 'LIKE');
    }
    if ($type) {
      $query->condition('e.event_type', $type);
    }
    if(unserialize($tags)){
      $query->leftJoin('events_tags', 'etag', 'e.event_id = etag.event_id');
      $query->condition('etag.tag_name', array_values(unserialize($tags)), 'IN');
    }

    $rows_count = $query->countQuery()->execute()->fetchField();

    $events = $query->range(($currentPage - 1) * $this->items_per_page, $this->items_per_page)->execute()->fetchAll();

    foreach ($events as $event){
      $query_tags = \Drupal::database()->select('events_tags', 'et');
      $query_tags->fields('et', ['tag_name']);
      $query_tags->condition('et.event_id', $event->event_id);
      $tags = $query_tags->execute()->fetchAll();
      $event->tags = $tags;
    }

    $lastPage = ceil($rows_count / $this->items_per_page);

    $searchForm = '\Drupal\event_storage\Form\EventSearchForm';
    $form = \Drupal::formBuilder()->getForm($searchForm);

    $this->killSwitch->trigger();

    return [
      '#theme' => 'event_storage',
      '#events' => $events,
      '#lastPage' => $lastPage,
      '#paginationPath' => 'event_storage.main_page',
      '#currentFilters' => $currentFilters,
      '#currentPage' => $currentPage,
      '#searchForm' => $form,
      '#showAlwaysFirstAndLast' => false,
      '#attached' => [
        'library' => [
          'event_storage/main-content'
        ]
      ]
    ];
  }

}
