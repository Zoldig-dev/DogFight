<?php

include_once('race.php');
include_once('rpgEntity.php');

abstract class Monstre extends RpgEntity {

  protected string $class;
  protected string $logo;

  public function __construct($level, $hpRatio, $manaRatio, $defRatio, $damageMinRatio, $damageMaxRatio, $scoreCriticalStrikeRatio, $criticalDamageRatio, string $class, string $logo)
  {
      $this->level = $level;
      $this->hp = $hpRatio * $level;
      $this->hpMax = $hpRatio * $level;
      $this->mana = $manaRatio * $level;
      $this->manaMax = $manaRatio * $level;
      $this->def = $defRatio * $level;
      $this->damageMin = $damageMinRatio * $level;
      $this->damageMax = $damageMaxRatio * $level;
      $this->scoreCritStrike = $scoreCriticalStrikeRatio * $level;
      $this->critDamage = $criticalDamageRatio * $level;
      $this->class = $class;
      $this->logo = $logo;
  }

  public function displayHtml(){

    echo <<<HTML
    <div class="hero">
     <div class="hero-head">
        <div class="hero-info">
            <h3 class="hero-name">{$this->class}</h3>
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
                <h4>Stat du monstre</h4>
                <span><img src="../../images/shield.svg" alt="Def" class="carac-img">   {$this->def} </span>
                <span><img src="../../images/piercing-sword.svg" alt="attaque min" class="carac-img">  {$this->damageMin}</span>
                <span><img src="../../images/pointy-sword.svg" alt="attaque max" class="carac-img">  {$this->damageMax}</span>
            </div>
         </div>
     </div>
   </div>
HTML;

  }
}