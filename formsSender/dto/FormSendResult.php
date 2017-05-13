<?php
/**
 * Created by PhpStorm.
 * User: berz
 * Date: 13.01.2017
 * Time: 18:10
 */
namespace formsSender\dto;

class FormSendResult implements IFormSendResult{


    private $result;

    /**
     * FormSendResult constructor.
     * @param $result
     */
    public function __construct($result)
    {
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }


}