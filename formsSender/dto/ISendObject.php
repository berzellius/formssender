<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:14
 */
namespace formsSender\dto;

interface ISendObject
{
    /**
     * @return IFormData
     */
    public function getFormData();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getOrigin();

    /**
     * @return string
     */
    public function getReferer();
}