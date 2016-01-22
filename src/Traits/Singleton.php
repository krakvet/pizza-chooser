<?php

namespace Krakvet\PizzaChooser\Traits;

trait Singleton
{
    protected static $instance;
    final public static function getInstance() {
        if(!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
    final private function __construct() {
        $this->init();
    }
    protected function init() {
    }
    final private function __wakeup() {
    }
    final private function __clone() {
    }
}