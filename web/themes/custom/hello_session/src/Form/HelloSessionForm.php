<?php

namespace Drupal\hello_session\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\SessionManagerInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form to set a name in the session.
 */
class HelloSessionForm extends FormBase
{

    /**
     * The session manager.
     *
     * @var \Drupal\Core\Session\SessionManagerInterface
     */
    protected $sessionManager;

    /**
     * Constructs a new HelloSessionForm.
     *
     * @param \Drupal\Core\Session\SessionManagerInterface $session_manager
     * The session manager.
     */
    public function __construct(SessionManagerInterface $session_manager)
    {
        $this->sessionManager = $session_manager;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('session_manager')
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'hello_session_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['name'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Your Name'),
            '#required' => TRUE,
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Save Name'),
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $name = $form_state->getValue('name');

        // Get the session object and set a variable.
        $session = $this->getRequest()->getSession();
        $session->set('hello_session_name', $name);

        $this->messenger()->addStatus($this->t('Your name has been saved!'));

        // You can redirect to the greeting page here.
        $url = Url::fromRoute('hello_session.greeting_page');
        $form_state->setRedirectUrl($url);
    }
}
