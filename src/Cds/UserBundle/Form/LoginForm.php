<?php

namespace Cds\UserBundle\Form;

use Symfony\Component\Form\Form;
use Symfony\Component\Form\TextField;
use Symfony\Component\Form\PasswordField;

class LoginForm extends Form
{
    public $pseudo;

    public $password;

    public function configure()
    {
        $this->setDataClass('Cds\\MembresBundle\\Form\\Validators\\LoginValidator');
        $this->add('pseudo');
        $this->add(new PasswordField('password'));
    }

   
}
