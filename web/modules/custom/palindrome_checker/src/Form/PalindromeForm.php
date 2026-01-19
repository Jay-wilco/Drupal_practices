<?php

namespace Drupal\palindrome_checker\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class PalindromeForm extends FormBase
{

    public function getFormId(): string
    {
        return 'palindrome_checker_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state): array
    {
        $form['text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Text to check'),
            '#description' => $this->t('Enter a word or sentence. Spaces, punctuation, and casing are ignored.'),
            '#required' => TRUE,
            '#size' => 60,
            '#maxlength' => 255,
        ];

        $form['actions'] = [
            '#type' => 'actions',
        ];

        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Check'),
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state): void
    {
        $input = (string) $form_state->getValue('text');

        // Normalize: lowercase + remove all non-letters/numbers.
        $normalized = mb_strtolower($input);
        $normalized = preg_replace('/[^\p{L}\p{N}]+/u', '', $normalized) ?? '';

        $reversed = implode('', array_reverse(preg_split('//u', $normalized, -1, PREG_SPLIT_NO_EMPTY)));

        if ($normalized !== '' && $normalized === $reversed) {
            $this->messenger()->addStatus($this->t('The text “@text” is a palindrome.', [
                '@text' => $input,
            ]));
        } else {
            $this->messenger()->addWarning($this->t('The text “@text” is not a palindrome.', [
                '@text' => $input,
            ]));
        }
    }
}
