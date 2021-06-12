<?php 

include_once('rpgEntity.php');
include_once('hero.php');
include_once('mage.php');
include_once('warrior.php');
include_once('rogue.php');
include_once('gobelin.php');
include_once('ogre.php');
include_once('dragon.php');
include_once('race.php');
include_once('ability.php');

$heroes= [];

$race1 = new Race('Murlock');

$mage1 = new Mage('Coper');
$mage1->setRace($race1);
$mage1->setLevel(20);
$mage1->rest(10000, 10000);

$warrior1 = new Warrior('Field');
$warrior1->setRace($race1);
$warrior1->setLevel(20);
$warrior1->rest(10000, 10000);

$rogue = new Rogue('Palazzo');
$rogue->setRace($race1);
$rogue->setLevel(20);
$rogue->rest(10000, 10000);

$heroes[] = $mage1;
$heroes[] = $warrior1;
$heroes[] = $rogue;

$monsters=[];

$gobs1 = new Gobelin(10);
$ogre1 = new Ogre(20);
$drag1 = new Dragon(40);

$monsters[] = $gobs1;
$monsters[] = $ogre1;
$monsters[] = $drag1;

function dragFight($mage1, $warrior1, $rogue, $drag1 ){

  $heros = [$mage1, $warrior1, $rogue];
  $index = rand(0, 2);

  while(
    (
      (!$mage1->isDead()? $mage1->dogFight($drag1): $mage1->isDead())
      && (!$warrior1->isDead()?$warrior1->dogFight($drag1) : $warrior1->isDead())
      && (!$rogue->isDead()?$rogue->dogFight($drag1) : $rogue->isDead())
    ) 
    && !$drag1->isDead()){

    $drag1->dogFight($heros[$index]);
  
    if(count($heros) == 1){
      $index = 0;
    }elseif(count($heros) == 2 ){
      $index = rand(0,1);
    }else{
      $index = rand(0, 2);
    }

    if($mage1->isDead() && $warrior1->isDead() && $rogue->isDead()){
      echo 'You lose'. '</br>';
      break;
    }
  }

  if($mage1->isDead()){
    echo $mage1->getName(). ' est mort' .'</br>';
    array_splice($heros, (array_search('$mage1', $heros)), 1);
  }
  if($warrior1->isDead()){
    echo $warrior1->getName(). ' est mort' .'</br>';
    array_splice($heros, (array_search('$warrior1', $heros)), 1);
  }
  if($rogue->isDead()){
    echo $rogue->getName(). ' est mort' .'</br>';
    array_splice($heros, (array_search('$rogue', $heros)), 1);
  }

  if($drag1->isDead()){
    echo 'You won'. '</br>';
  }

}