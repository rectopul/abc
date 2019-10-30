<?php

namespace MailPoet\Cron\Triggers;

if (!defined('ABSPATH')) exit;


use MailPoet\Cron\Supervisor;

class MailPoet {
  static function run() {
    $supervisor = new Supervisor();
    return $supervisor->checkDaemon();
  }
}
