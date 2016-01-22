<?php

use Krakvet\PizzaChooser\Exception\PizzaChooserException;
use Krakvet\PizzaChooser\PizzaChooser;

require 'vendor/autoload.php';

try {
    $chooser = PizzaChooser::getInstance();
    if($chooser instanceof PizzaChooser) {
        $chooser->selectPizzeria('PodLasem');
    }
}
catch(PizzaChooserException $e) {
    echo $e->getMessage();
}
catch(Exception $e) {
    echo $e->getMessage();
}