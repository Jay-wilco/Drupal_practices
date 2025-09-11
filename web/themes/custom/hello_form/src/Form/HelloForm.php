<?php

namespace Drupal\hello_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a Hello Form.
 */
class HelloForm extends FormBase
{

    /**
     * {@inheritdoc}
     */
    public function getFormId()
    {
        return 'hello_form_form';
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
            '#value' => $this->t('Say Hello'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $name = $form_state->getValue('name');
        // $this->messenger()->addStatus($this->t('Hello, @name!', ['@name' => $name]));

        // You can also redirect the user to a different page.
        $url = Url::fromRoute('hello_name.hello_page', ['name' => $name]);
        $form_state->setRedirectUrl($url);
    }
}
