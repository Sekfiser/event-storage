<?php

namespace Drupal\event_storage\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Url;

class Event extends ContentEntityBase implements ContentEntityInterface
{

  public static function baseFiledDefinitions(EntityTypeInterface $entity_type): array
  {
    $fields['event_id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('Primary identifier for event.'))
      ->setReadOnly(TRUE);

    $fields['event_title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Event title'))
      ->setDescription(t('Title of the event.'))
      ->setSettings([
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ]);

    return $fields;
  }

  public function toUrl($rel = 'canonical', array $options = []): Url
  {
    return Url::fromUri('base:entity/event/' . $this->id(), $options);
  }

}
