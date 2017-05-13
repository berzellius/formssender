<?php
/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:12
 */
namespace formsSender\dto;

class SendObject implements ISendObject{

    /**
     * SendObject constructor with url, referer, request data.
     * @param string $url
     * @param string $referer
     * @param $origin
     * @param IFormData $formData
     */
    public function __construct($url, $referer, $origin, $formData)
    {
        $this->setUrl($url);
        $this->setReferer($referer);
        $this->setOrigin($origin);
        $this->setFormData($formData);
    }

    private $url;
    private $referer;
    private $origin;
    private $formData;

    /**
     * @return string
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;
    }

    /**
     * @return IFormData
     */
    public function getFormData()
    {
        return $this->formData;
    }

    /**
     * @param IFormData $formData
     */
    public function setFormData($formData)
    {
        $this->formData = $formData;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;
    }


}