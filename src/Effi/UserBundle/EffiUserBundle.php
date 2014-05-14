<?php

namespace Effi\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EffiUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}