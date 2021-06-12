<?php

include_once('monstre.php');

class Dragon extends Monstre
{
    public function __construct($level)
    {
        parent::__construct($level, 130, 81, .7, 8.3, 8.6, .33, 1.65, 'Dragon', '../../images/wyvern.svg');
    }
}