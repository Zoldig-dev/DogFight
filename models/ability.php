<?php

class Ability {
  protected string $name;
  protected int $manaCost;
  protected int $damage;
  protected string $logo;

  public function __construct(string $name, int $manaCost, int $damage, string $logo) {
    
    $this->name = $name;
    $this->manaCost = $manaCost;
    $this->damage =$damage;
    
    $this->logo = $logo;
  }

  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Get the value of logo
   */ 
  public function getLogo()
  {
    return $this->logo;
  }

  /**
   * Get the value of manaCost
   */ 
  public function getManaCost()
  {
    return $this->manaCost;
  }

  /**
   * Get the value of damage
   */ 
  public function getDamage()
  {
    return $this->damage;
  }

  /**
   * Set the value of damage
   *
   * @return  self
   */ 
  public function setDamage($damage)
  {
    $this->damage = $damage;

    return $this;
  }
}