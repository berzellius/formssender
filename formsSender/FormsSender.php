<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:59
 */
namespace formsSender;

use formsSender\dto\FormSendResult;
use formsSender\dto\IFormSendResult;
use formsSender\dto\ISendObject;

class FormsSender implements IFormsSender
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
        $data = array_merge($data, $utm);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Origin: ".$origin,
            "Referer: ".$referer
        ));
        if($method == 'post' && $data != null && is_array($data) && sizeof($data) > 0) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        $out = curl_exec($curl);
        $information = curl_getinfo($curl);
        $code = curl_getinfo($curl,CURLINFO_HTTP_CODE);
        curl_close($curl);


        $f = fopen("forms_sender/logs/log_" . time() . ".txt", "a");
        fputs($f, json_encode($data, JSON_PRETTY_PRINT));
        fputs($f, "\n and utm: \n");
        fputs($f, json_encode($utm, JSON_PRETTY_PRINT));
        fputs($f, "\n and result: \n");
        fputs($f, json_encode(array("out" => $out, "information" => $information, "code" => $code), JSON_PRETTY_PRINT));
        fclose($f);

        return new FormSendResult("success");
    }

    /**
     * @param ICookiesParser $cookiesParser
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