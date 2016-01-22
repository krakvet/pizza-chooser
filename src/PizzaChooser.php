<?php

namespace Krakvet\PizzaChooser;

use Krakvet\PizzaChooser\Exception\PizzaChooserException;
use Krakvet\PizzaChooser\Pizzeria\Pizzeria;
use Krakvet\PizzaChooser\Traits\Singleton;

class PizzaChooser
{
    use Singleton;

    private $_pizzerias = array();
    private $_pizzeria = null;

    public function init() {
        $dir = scandir(__DIR__.'/Pizzeria/');

        foreach($dir as $file) {
            if(is_dir($file) || !preg_match('/^Pizzeria\_(.*)\.php$/', $file)) {
                continue;
            }

            $className = $this->getClassName($file);
            $Pizzeria = "Krakvet\\PizzaChooser\\Pizzeria\\$className";
            $pizzeria = new $Pizzeria();

            if($pizzeria instanceof Pizzeria) {
                $name = $pizzeria->getName();
                $this->_pizzerias[$name] = $pizzeria;
            }
        }
    }

    public function selectPizzeria($name) {
        if(!isset($this->_pizzerias[$name])) {
            throw new PizzaChooserException("Pizzeria not found.");
        }

        $pizzeria = $this->_pizzerias[$name];
        if($pizzeria instanceof Pizzeria) {
            $pizzeria->getPizzas();
            $this->_pizzeria = $pizzeria;
        }
    }

    private function getClassName($file) {
        $fileInfo = pathinfo($file);
        return $fileInfo['filename'];
    }
}