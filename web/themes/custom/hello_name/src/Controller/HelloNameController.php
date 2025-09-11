<?php

namespace Drupal\hello_name\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines HelloNameController class.
 */
class HelloNameController extends ControllerBase
{

    /**
     * Display the name passed in the URL.
     *
     * @param string $name
     * The name to display.
     *
     * @return array
     * Return a renderable array.
     */
    public function hello($name)
    {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello, @name!', ['@name' => $name]),
        ];
    }
}
