<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 14.01.2017
 * Time: 14:18
 */
namespace formsSender;

use formsSender\adapters\FormContentAdapter;
use formsSender\dto\FormData;
use formsSender\dto\IFormData;
use formsSender\dto\ISendObject;
use formsSender\dto\SendObject;


spl_autoload_register(function ($class_name) {
    if(strpos($class_name, "formsSender") !== false){
        $path = str_replace("\\", "/", $class_name) . '.php';
        include $path;
    }
});

class Starter
{
    /**
     * What fields name translate to what
     * @var array
     */
    public static $fieldsTranslation = array(
        "text1" => "name",
        "text2" => "email",
        "text3" => "phone",
        "text4" => "email",
        "textarea5" => "comment",
        "textarea7" => "comment"
    );

    /**
     * if cant get HTTP_ORIGIN
     * @var string
     */
    public static $defaultOrigin = "http://elektro-karniz.ru";

    /**
     * method to backend server
     * @var string
     */
    public static $method = "post";

    /**
     * backend url
     * @var string
     */
    public static $url = "http://37.46.135.62/new_lead.php";

    /**
     * intercept request to catch form send
     */
    public static function runInterceptor(){
        $origin = isset($_SERVER['HTTP_ORIGIN'])? filter_input(INPUT_SERVER, 'HTTP_ORIGIN') : self::$defaultOrigin;
        $referer = isset($_SERVER['HTTP_REFERER'])? filter_input(INPUT_SERVER, 'HTTP_REFERER') : null;
        $url = isset($_SERVER['REQUEST_URI'])? filter_input(INPUT_SERVER, 'REQUEST_URI') : null;

        $method = self::getHttpMethod();

        $formData = ($method == 'POST')?
            self::getIFormDataInstance($url, $method, $_POST) : null;
            //self::getIFormDataInstance($url, $method, $_GET);
        if($formData == null)
            return;


        $formData->set("origin", $origin);
        $formData->set("referer", $referer);

        $formData = self::getIFormContentAdapterForFieldTranslation(self::$fieldsTranslation)->form2form($formData);

        $sendObject = self::getISendObjectInstance($url, $referer, $origin, $formData);
        $formSender = self::getIFormSenderInstance();
        $formSender->setCookiesParser(new CookiesParser($_COOKIE));

        $formSender->send($sendObject, self::$url, self::$method, $origin, $referer);
    }

    public static function getHttpMethod(){
        $method = isset($_SERVER['REQUEST_METHOD'])? filter_input(INPUT_SERVER, "REQUEST_METHOD") : null;
        return $method;
    }


    /**
     * @param array $cookies
     * @return ICookiesParser
     */
    public static function getICookiesParserInstance($cookies){
        return new CookiesParser($cookies);
    }


    /**
     * @param string $url
     * @param string $referer
     * @param string  $origin
     * @param IFormData $formData
     * @return ISendObject SendObject
     */
    public static function getISendObjectInstance($url, $referer, $origin, $formData){
        $sendObject = new SendObject($url, $referer, $origin, $formData);
        return $sendObject;
    }


    /**
     * @param string $url
     * @param string $method
     * @param array $data
     * @return FormData
     */
    public static function getIFormDataInstance($url, $method, $data){
        $formData = new FormData();
        $formData->setAction($url);
        $formData->setMethod($method);
        $formData->setData($data);

        return $formData;
    }

    /**
     * @return IFormsSender
     */
    public static function getIFormSenderInstance(){
        $formSender = new FormsSender();
        //$formSender = new FormsSenderStub();
        return $formSender;
    }

    /**
     * @param array $transation
     * @return FormContentAdapter
     */
    public static function getIFormContentAdapterForFieldTranslation(array $transation){
        $formContentAdapter = new FormContentAdapter();
        $formContentAdapter->setNameAssociations($transation);
        return $formContentAdapter;
    }
}