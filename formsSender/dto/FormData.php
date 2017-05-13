<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:20
 */

namespace formsSender\dto;

class FormData implements IFormData
{
    /**
     * FormData constructor.
     */
    public function __construct()
    {
    }

    private $action;
    private $method;
    private $data;

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * sets key to value. update if exists, add if not.
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        $d = $this->getData();
        $d[$key] = $value;
        $this->setData($d);
    }
}