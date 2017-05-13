<?php

/**
 * Created by PhpStorm.
 * User: berz
 * Date: 18.01.2017
 * Time: 18:58
 */
namespace formsSender\adapters;

use formsSender\dto\IFormData;

interface IFormContentAdapter
{
    /**
     * Converts the form data given as array to
     * the same data organized in the array by different way
     * @param IFormData $form
     * @return IFormData array
     */
    public function form2form(IFormData $form);
}