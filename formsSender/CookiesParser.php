<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 14.01.2017
 * Time: 13:33
 */
namespace formsSender;

class CookiesParser implements ICookiesParser
{
    /**
     * CookiesParser constructor.
     * @param array $cookies
     */
    public function __construct(array $cookies)
    {
        $this->setCookies($cookies);
    }

    private $cookies;

    public static $cookiesTranslate = array(
        "utmcsr" => "utm_source",
        "utmcmd" => "utm_medium",
        "utmcct" => "utm_content",
        "utmccn" => "utm_campaign",
        "utmctr" => "utm_term",
    );

    /**
     * @return array
     */
    public function parseUtm()
    {
        $utm = array();
        foreach ($this->getCookies() as $cookie){
            if(
                preg_match_all("/(utmcsr|utmcmd|utmcct|utmccn|utmctr)=(.+?)[|;]/", $cookie, $matches) &&
                count($matches) > 2
            ){
                $cnt = count($matches[1]);
                if(count($matches[2]) >= $cnt){
                    for($i = 0; $i < $cnt; $i++){
                        $utm[self::$cookiesTranslate[$matches[1][$i]]] = $matches[2][$i];
                    }

                    return $utm;
                }
            }
        }

        return $utm;
    }

    /**
     * @return array
     */
    public function getCookies()
    {
        return $this->cookies;
    }

    /**
     * @param array $cookies
     */
    public function setCookies($cookies)
    {
        $this->cookies = $cookies;
    }
}