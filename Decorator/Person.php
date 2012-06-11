<?php

class Person {

    private $fullname;
    private $age;

    public function __construct ($fullname, $age) {
        $this->fullname = $fullname;
        $this->age      = $age;
    }

    public function getFullName() {
        return $this->fullname;
    }

    public function getAge() {
        return $this->age;
    }
}

class PersonFullNameDecorator {
    
    private $person;

    protected $fullname;

    public function __construct (Person $person) {
        $this->person = $person;
        $this->retrievingFullname();
    }
       
    public function retrievingFullname() {
        $this->fullname = $this->person->getFullName();
    }

    public function showFullName() {
        return $this->fullname;
    }
}


class PersonFullNameToUpperDecorator extends PersonFullNameDecorator {
    private $pfd;

    public function __construct (PersonFullNameDecorator $decorator) {
        $this->pfd = $decorator;
    }

    public function toUpper() {
        $this->pfd->fullname = strtoupper($this->pfd->fullname);
    }
}

class PersonFullNameAddCommasDecorator extends PersonFullNameDecorator {
    private $pfd;

    public function  __construct (PersonFullNameDecorator $decorator) {
        $this->pfd = $decorator;
    }
    
    public function addCommas() {
        $this->pfd->fullname = '"' . $this->pfd->fullname . '"';
    }
}

$person = new Person('Bruno Agutoli', 25);
$decorator = new PersonFullNameDecorator($person);
$toUpperDecorator = new PersonFullNameToUpperDecorator($decorator);
$addCommasDecorator = new PersonFullNameAddCommasDecorator($decorator);

echo 'Before: ' . $decorator->showFullName() . '<br/>';
$toUpperDecorator->toUpper();
echo 'After: ' . $decorator->showFullName() . '<br/>';

$addCommasDecorator->addCommas();
$addCommasDecorator->addCommas();
$addCommasDecorator->addCommas();
echo 'Added commas: ' . $decorator->showFullName() . '<br />';

$decorator->retrievingFullname();
echo 'Retrieving fullname: ' . $decorator->showFullName();

/**
output 
=======================


Before: Bruno Agutoli
After: BRUNO AGUTOLI
Added commas: """BRUNO AGUTOLI"""
Retrieving fullname: Bruno Agutoli


*/

