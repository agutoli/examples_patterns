<?php
/**
 * Chain of Responsibility
 * =======================
 *
 * A method called in one object will move up a chain 
 * of objects until one is found that can properly handle the call. 
 */

abstract class AbstractAnimals {
    abstract public function makeSound($sound);
    abstract public function nextAnimal($animalReceptor);
}

class Cat extends AbstractAnimals {

    private $animal;

    public function makeSound($sound) {
        if ($sound->isEqual() == 'miau') {
            echo 'cat!';
        } else {
            $this->animal->makeSound($sound);
        }
    }

    public function nextAnimal($animalReceptor) {
        $this->animal = $animalReceptor;
    }
}

class Dog extends AbstractAnimals {

    private $animal;

    public function makeSound($sound) {
        if ($sound->isEqual() == 'auau') {
            echo 'dog!';
        } else {
            $this->animal->makeSound($sound);
        }
    }

    public function nextAnimal($animalReceptor) {
        $this->animal = $animalReceptor;
    }

}

class Cow extends AbstractAnimals {

    private $animal;

    public function makeSound($sound) {
        if ($sound->isEqual() == 'muuh') {
            echo 'cow!';
        } else {
            $this->animal->makeSound($sound);
        }
    }

    public function nextAnimal($animalReceptor) {
        $this->animal = $animalReceptor;
    }

}


class Sound {
    private $sound;

    public function __construct($sound) {
        $this->sound = $sound;
    }

    public function isEqual() {
        return $this->sound;
    }
}

class Client {
    public function __construct() {
        $cat    = new Cat();
        $dog    = new Dog();
        $cow    = new Cow();

        $cat->nextAnimal($dog);
        $dog->nextAnimal($cow);

        $cat->makeSound(new Sound('auau'));
    }
}


$client = new Client();
/**
autput
================

dog!

*/

