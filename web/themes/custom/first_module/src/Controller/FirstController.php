<?php

namespace Drupal\first_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase
{

    public function firstPage()
    {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello, this is my first Drupal page!'),
        ];
    }
}
