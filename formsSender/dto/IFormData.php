<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:20
 */
namespace formsSender\dto;

interface IFormData
{

    /**
     * @return string
     */
    public function getAction();

    /**
     * @return string
     */
    public function getMethod();

    /**
     * @return array
     */
    public function getData();

    /**
     * @param array $data
     */
    public function setData($data);

    /**
     * sets key to value. update if exists, add if not.
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value);
}