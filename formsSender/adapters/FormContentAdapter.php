<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 18.01.2017
 * Time: 19:02
 */
namespace formsSender\adapters;

use formsSender\dto\IFormData;

class FormContentAdapter implements IFormContentAdapter
{

    private $nameAssociations;

    /**
     * Converts the form data given as array to
     * the same data organized in the array by different way
     * @param IFormData $form
     * @return IFormData
     */
    public function form2form(IFormData $form)
    {
        $res = array();
        foreach($form->getData() as $k => $v){
            $res[isset($this->getNameAssociations()[$k])? $this->getNameAssociations()[$k] : $k] = $v;
        }

        $form->setData($res);
        return $form;
    }

    /**
     * name asscotiations,
     * i.e. if input array is array('mytext' => 'some text')
     * and output must be array('mycontent' => 'some text'),
     * then nameAssociation will be array('mytext' => 'mycontent')
     * @return array
     */
    public function getNameAssociations()
    {
        return $this->nameAssociations;
    }

    /**
     * @param array $nameAssociations
     */
    public function setNameAssociations($nameAssociations)
    {
        $this->nameAssociations = $nameAssociations;
    }
}