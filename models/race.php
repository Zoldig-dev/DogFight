<?php
class Race {
  private string $name;

  public function __construct($name) {
    $this->name = $name;
  }
  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }
}