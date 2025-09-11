<?php

namespace Drupal\hello_session\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\SessionManagerInterface; // We'll keep this one for consistency
use Symfony\Component\HttpFoundation\Session\SessionInterface; // This is the correct interface to type hint against
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a controller to retrieve a name from the session.
 */
class HelloSessionController extends ControllerBase
{

    /**
     * The session.
     *
     * @var \Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    protected $session;

    /**
     * Constructs a new HelloSessionController.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     * The session.
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            // We inject the 'session' service, which returns a SessionInterface object.
            $container->get('session')
        );
    }

    /**
     * Displays the name stored in the session.
     *
     * @return array
     * A renderable array.
     */
    public function greeting()
    {
        // We can now directly use the $this->session property.
        $name = $this->session->get('hello_session_name', 'Guest');

        return [
            '#type' => 'markup',
            '#markup' => $this->t('Hello, @name!', ['@name' => $name]),
        ];
    }
}
