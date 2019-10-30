<?php

namespace MailPoet\Util\pQuery;

if (!defined('ABSPATH')) exit;


// extend pQuery class to use UTF-8 encoding when getting elements' inner/outer text
class pQuery extends \pQuery {
  public static function parseStr($html) {
    $parser = new Html5Parser($html);
    return $parser->root;
  }
}
