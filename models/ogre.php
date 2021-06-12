<?php

include_once('monstre.php');

class Ogre extends Monstre
{
    public function __construct($level)
    {
        parent::__construct($level, 112, 71, .5, 6.4, 6.8, .28, 1.5,'Ogre', '../../images/ogre.svg');
    }
}