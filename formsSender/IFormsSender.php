<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:08
 */
namespace formsSender;

use formsSender\dto\IFormSendResult;
use formsSender\dto\ISendObject;

interface IFormsSender
{

    /**
     * @param ISendObject $sendObject
     * @param string $url
     * @param string $method
     * @param $origin
     * @param $referer
     * @return IFormSendResult $formSendResult
     */
    public function send(ISendObject $sendObject, $url, $method, $origin, $referer);

    /**
     * @param ICookiesParser $cookies
     */
    public function setCookiesParser(ICookiesParser $cookiesParser);
}