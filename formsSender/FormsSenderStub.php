<?php
/**
 * Created by PhpStorm.
 * User: berz
 * Date: 02.05.2017
 * Time: 21:40
 */

namespace formsSender;


use formsSender\dto\FormSendResult;
use formsSender\dto\IFormSendResult;
use formsSender\dto\ISendObject;

class FormsSenderStub implements IFormsSender
{
    private $cookiesParser;

    /**
     * @param ISendObject $sendObject
     * @param string $url
     * @param string $method
     * @param $origin
     * @param $referer
     * @return IFormSendResult $formSendResult
     */
    public function send(ISendObject $sendObject, $url, $method, $origin, $referer)
    {
        $utm = $this->getCookiesParser()->parseUtm();
        $data = $sendObject->getFormData()->getData();

        $f = fopen("..\\logs\\log_" . time() . ".txt", "a");
        fputs($f, json_encode($data, JSON_PRETTY_PRINT));
        fputs($f, "\n and utm: \n");
        fputs($f, json_encode($utm, JSON_PRETTY_PRINT));
        fclose($f);

        return new FormSendResult("success");
    }

    /**
     * @param ICookiesParser $cookies
     */
    public function setCookiesParser(ICookiesParser $cookiesParser)
    {
        $this->cookiesParser = $cookiesParser;
    }

    /**
     * @return ICookiesParser
     */
    public function getCookiesParser()
    {
        return $this->cookiesParser;
    }
}