<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 14.01.2017
 * Time: 13:30
 */
namespace formsSender;

interface ICookiesParser
{

    /**
     * @return array
     */
    public function parseUtm();
}