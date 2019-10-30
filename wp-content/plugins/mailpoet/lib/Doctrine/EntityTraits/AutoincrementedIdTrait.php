<?php

namespace MailPoet\Doctrine\EntityTraits;

if (!defined('ABSPATH')) exit;


trait AutoincrementedIdTrait {
  /**
   * @Column(type="integer")
   * @Id
   * @GeneratedValue
   * @var int|null
   */
  private $id;

  /** @return int */
  public function getId() {
    return $this->id;
  }
}
