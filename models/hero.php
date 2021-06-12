<?php

include_once('race.php');
include_once('rpgEntity.php');

abstract class Hero extends RpgEntity {
  protected string $name;
  protected string $class;
  protected string $logo;
  protected Race $race;
  protected int $strength;
  protected int $agility;
  protected int $intel;
  protected int $lvlStrength;
  protected int $lvlAgility;
  protected int $lvlIntel;

  protected int $firstCarac;

  public function __construct(int $strength,int $intel,int $agility,string $name, int $lvlStrength, int $lvlAgility, int $lvlIntel, string $class, string $logo) {

    $this->level = 1;
    $this->scoreCritStrike = 12;
    $this->critDamage = 1.5;
    $this->name = $name;

    $this->setStrength($strength);
    $this->hp = $strength*19;

    $this->setAgility($agility);

    $this->setIntel($intel);
    $this->mana = $intel*17;

    $this->lvlStrength = $lvlStrength;
    $this->lvlAgility = $lvlAgility;
    $this->lvlIntel = $lvlIntel;
    
    $this->class = $class;
    $this->logo = $logo;
  }

  public function setDamage(int $caracFirst){
    $this->firstCarac = $caracFirst;
    $this->damageMin = round($caracFirst*1.2);
    $this->damageMax = round($caracFirst*1.4);
    $this->scoreCritStrike += $caracFirst*0.08;
  }

  public function lvlUp(){
    $this->level++;
    $this->setStrength($this->strength + $this->lvlStrength);
    $this->setAgility($this->agility + $this->lvlAgility);
    $this->setIntel($this->intel + $this->lvlIntel);
    $this->setDamage($this->firstCarac);
  }

  public function cura($hp){
    $this->hp += $hp;

    if ($this->hp > $this->hpMax) {
        $this->hp = $this->hpMax;
    }
  }

  public function rest($hp , $mana){
    $this->hp += $hp;
    $this->mana += $mana;

    if ($this->hp > $this->hpMax) {
      $this->hp = $this->hpMax;
    }
    if ($this->mana > $this->manaMax) {
      $this->mana = $this->manaMax;
    }
  }


  public function displayHtml(){

    echo <<<HTML
    <div class="hero">
     <div class="hero-head">
        <div class="hero-info">
            <h3 class="hero-name"> {$this->class} {$this->name}</h3>
            <p class="hero-race">{$this->race->getName()}</p>
        </div>
        <div class="hero-logo"><img src="{$this->logo}" /></div>
        <div class="hero-lvl">LV :{$this->level}</div>
     </div>
     <div class="hero-stat">
        <div class="hero-bar">
            <div class="test">
                <span class="liquid" style="--hp-top:calc(({$this->hp} / {$this->hpMax} * -100%) - 20%)"></span>
                <span class="liquid-info"> $this->hp / $this->hpMax</span>
            </div>
            <div class="test">
                <span class="liquid" style="--mana-top:calc(({$this->mana} / {$this->manaMax} * -100%) - 20%)"></span>
                <span class="liquid-info"> $this->mana / $this->manaMax</span>
            </div>
        </div>
        <div class="hero-caracs">
            <div class="hero-carac">
                <h4>Stat du héro</h4>
                <span><img src="../../images/force.svg" alt="Force" class="carac-img">  {$this->strength}</span>
                <span><img src="../../images/agility.svg" alt="Agility" class="carac-img">  {$this->agility}</span>
                <span><img src="../../images/intel.svg" alt="Intel" class="carac-img">  {$this->intel}</span>
            </div>
            <div class="hero-carac">
                <h4>Dégats du héro</h4>
                <span><img src="../../images/piercing-sword.svg" alt="attaque min" class="carac-img"> {$this->damageMin}</span>
                <span><img src="../../images/pointy-sword.svg" alt="attaque max" class="carac-img">  {$this->damageMax}</span>
                <span><img src="../../images/sabers-choc.svg" alt="attaque crit" class="carac-img">  {$this->scoreCritStrike}</span>
            </div>
         </div>
     </div>
   </div>
HTML;

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

  /**
   * Get the value of race
   */ 
  public function getRace()
  {
    return $this->race;
  }

  /**
   * Set the value of race
   *
   * @return  self
   */ 
  public function setRace($race)
  {
    $this->race = $race;

    return $this;
  }

  /**
   * Set the value of level
   *
   * @return  self
   */ 
  public function setLevel($level){
    $this->level = $level;
    $this->setStrength($this->strength + ($level - 1) * $this->lvlStrength);
    $this->setAgility($this->agility + ($level - 1) * $this->lvlAgility);
    $this->setIntel($this->intel + ($level - 1) * $this->lvlIntel);
    $this->setDamage($this->firstCarac);

    return $this;
  }

  /**
   * Get the value of strengh
   */ 
  public function getStrength()
  {
    return $this->strength;
  }

  /**
   * Set the value of strengh
   *
   * @return  self
   */ 
  public function setStrength($strength){
      if (isset($this->strength, $this->firstCarac)) {
          if ($this->strength === $this->firstCarac) {
              $this->strength = $strength;
              $this->hpMax = $strength * 19;
              $this->firstCarac = $this->strength;
          } else {
              $this->strength = $strength;
              $this->hpMax = $strength * 19;
          }
      } else {
          $this->strength = $strength;
          $this->hpMax = $strength * 19;
      }

      return $this;
  }

  /**
   * Get the value of agility
   */ 
  public function getAgility()
  {
    return $this->agility;
  }

  /**
   * Set the value of agility
   *
   * @return  self
   */ 
  public function setAgility($agility){
      if (isset($this->agility, $this->firstCarac)) {
          if ($this->agility === $this->firstCarac) {
              $this->agility = $agility;
              $this->def = $agility / 6;
              $this->firstCarac = $this->agility;
          } else {
              $this->agility = $agility;
              $this->def = $agility / 6;
          }
      } else {
          $this->agility = $agility;
          $this->def = $agility / 6;
      }

      return $this;
  }

  /**
   * Get the value of intel
   */ 
  public function getIntel()
  {
    return $this->intel;
  }

  /**
   * Set the value of intel
   *
   * @return  self
   */ 
  public function setIntel($intel){
      if (isset($this->intel, $this->firstCarac)) {
          if ($this->intel === $this->firstCarac) {
              $this->intel = $intel;
              $this->manaMax = $intel * 17;
              $this->firstCarac = $this->intel;
          } else {
              $this->intel = $intel;
              $this->manaMax = $intel * 17;
          }
      } else {
          $this->intel = $intel;
          $this->manaMax = $intel * 17;
      }

      return $this;
  }

  /**
   * Get the value of lvlStrength
   */ 
  public function getLvlStrength()
  {
    return $this->lvlStrength;
  }

  /**
   * Get the value of lvlAgility
   */ 
  public function getLvlAgility()
  {
    return $this->lvlAgility;
  }

  /**
   * Get the value of lvlIntel
   */ 
  public function getLvlIntel()
  {
    return $this->lvlIntel;
  }

  /**
   * Get the value of class
   */ 
  public function getClass()
  {
    return $this->class;
  }
  /**
   * @return int
   */
  public function getFirstCarac()
  {
      return $this->firstCarac;
  }

  /**
  * @param int $firstCarac
  */
  public function setFirstCarac($firstCarac)
  {
      $this->firstCarac = $firstCarac;
  }
}