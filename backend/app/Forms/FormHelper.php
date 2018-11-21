<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\FormBuilder;

class FormHelper
{
    /** @var FormBuilder */
    private $formBuilder;

    /**
     * FormHelper constructor.
     * @param FormBuilder $formBuilder
     */
    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    /**
     * @param string $formClass
     * @param string $route
     * @param string $method
     * @return \Kris\LaravelFormBuilder\Form
     */
    public function createForm(string $formClass, string $route, string $method)
    {
        $form = $this->formBuilder->create($formClass);

        $form->setFormOptions([
            'url' => route($route),
            'method' => $method,
        ]);

        return $form;
    }
}