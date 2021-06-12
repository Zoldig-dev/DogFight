<?php 
include_once('ability.php');


class Rogue extends Hero {
  public function __construct($name) {
    parent::__construct(14, 11, 30, $name, 2, 5, 1, 'Voleur', '../images/sly.svg');
    $this->setDamage($this->agility);
    $this->critDamage = 1.75;
    $this->setDamage(($this->agility));
    $this->abilityRatio = 1.9;
    $ability = new Ability('Embuscade',  160, $this->firstCarac * $this->abilityRatio,  '../../images/embuscade.svg');
    $this->setAbility($ability);
  }
}