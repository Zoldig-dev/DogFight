<?php

include_once('ability.php');

abstract class RpgEntity {

  protected int $level;
  protected int $hp;
  protected int $hpMax;
  protected int $mana;
  protected int $manaMax;
  protected float $def = 0.0;
  protected float $scoreCritStrike;
  protected float $critDamage;
  protected int $damageMin;
  protected int $damageMax;
  protected ?Ability $ability;
  protected ?float $abilityRatio;
    protected int $turn = 0;
  
  public function dogFight(?RpgEntity $rpgEntity): bool {
    if (0 === $this->turn % 3 && isset($this->ability)) {
      $this->useAbility($rpgEntity);
    } else {
        $damage = rand($this->damageMin, $this->damageMax);
        $baseDamage = $damage;
        if (rand(1, 100) <= $this->scoreCriticalStrike) {
            $damage += $damage * ($this->criticalDamage / 100);
        }

        if ($rpgEntity->defense > 0) {
            $reducedDammages = $damage * $rpgEntity->defense / 100;
            $damage -= $reducedDammages;
        }
        $rpgEntity->hp -= $damage;

        if ($rpgEntity->hp < 0) {
            $rpgEntity->hp = 0;
        }

        echo($this instanceof Hero ? $this->getName() : 'Le '.get_class($this)).' a infligé '.round($damage, 2).' dommages '.($rpgEntity instanceof Hero ? ' a '.$rpgEntity->getName() : ' au '.get_class($rpgEntity)).' .'.($damage > $baseDamage ? ' Coup Critique !' : '').'<br>';
    }

    if (0 === $this->hp || 0 === $rpgEntity->hp) {
        $this->turn = 0;

        return false;
    }

    ++$this->turn;

    return true;
  }

  public function isDead(): bool{
        return $this->getHp() <= 0;
  }

  public function useAbility(RpgEntity $rpgEntity){
      if (isset($this->ability)) {
          if ($this->mana >= $this->ability->getManaCost()) {
              $damage = $this->ability->getDamage();

              $rpgEntity->hp -= $damage;
              $this->mana -= $this->ability->getManaCost();

              if ($rpgEntity->hp < 0) {
                  $rpgEntity->hp = 0;
              }

              echo($this instanceof Hero ? $this->getName() : 'Le '.get_class($this)).' a infligé '.round($damage, 2).' dommages '.($rpgEntity instanceof Hero ? ' a '.$rpgEntity->getName() : ' au '.get_class($rpgEntity))." avec l'abilité ".$this->ability->getName().'<br>';
          } else {
              echo 'Pas assez de Mana !<br>';
          }
      } else {
          echo "Pas d'abilité<br>";
      }
  }

  public function getLevel(){
    return $this->level;
  }

  public function getHp(){
    return $this->hp;
  }

  /**
   * Set the value of hp
   *
   * @return  self
   */ 
  public function setHp($hp)
  {
    $this->hp = $hp;

    return $this;
  }
   /**
   * Get the value of hpMax
   */ 
  public function getHpMax()
  {
    return $this->hpMax;
  }

  /**
   * Set the value of hpMax
   *
   * @return  self
   */ 
  public function setHpMax($hpMax)
  {
    $this->hpMax = $hpMax;

    return $this;
  }

  /**
   * Get the value of mana
   */ 
  public function getMana()
  {
    return $this->mana;
  }

  /**
   * Set the value of mana
   *
   * @return  self
   */ 
  public function setMana($mana)
  {
    $this->mana = $mana;

    return $this;
  }

  /**
   * Get the value of manaMax
   */ 
  public function getManaMax()
  {
    return $this->manaMax;
  }

  /**
   * Set the value of manaMax
   *
   * @return  self
   */ 
  public function setManaMax($manaMax)
  {
    $this->manaMax = $manaMax;

    return $this;
  }
   /**
   * Get the value of def
   */ 
  public function getDef()
  {
    return $this->def;
  }

  /**
   * Set the value of def
   *
   * @return  self
   */ 
  public function setDef($def)
  {
    $this->def = $def;

    return $this;
  }

  /**
   * Get the value of scoreCritStrike
   */ 
  public function getScoreCritStrike()
  {
    return $this->scoreCritStrike;
  }

  /**
   * Set the value of scoreCritStrike
   *
   * @return  self
   */ 
  public function setScoreCritStrike($scoreCritStrike)
  {
    $this->scoreCritStrike = $scoreCritStrike;

    return $this;
  }

  /**
   * Get the value of critDamage
   */ 
  public function getCritDamage()
  {
    return $this->critDamage;
  }

  /**
   * Set the value of critDamage
   *
   * @return  self
   */ 
  public function setCritDamage($critDamage)
  {
    $this->critDamage = $critDamage;

    return $this;
  }

  /**
   * Get the value of damageMin
   */ 
  public function getDamageMin()
  {
    return $this->damageMin;
  }

  /**
   * Set the value of damageMin
   *
   * @return  self
   */ 
  public function setDamageMin($damageMin)
  {
    $this->damageMin = $damageMin;

    return $this;
  }

  /**
   * Get the value of damageMax
   */ 
  public function getDamageMax()
  {
    return $this->damageMax;
  }

  /**
   * Set the value of damageMax
   *
   * @return  self
   */ 
  public function setDamageMax($damageMax)
  {
    $this->damageMax = $damageMax;

    return $this;
  }

  /**
   * Get the value of ability
   */ 
  public function getAbility()
  {
    return $this->ability;
  }
  /**
   * Set the value of ability
   *
   * @return  self
   */ 
  public function setAbility($ability)
  {
    $this->ability = $ability;

    return $this;
  }
}