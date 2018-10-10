<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Our simple form class.
 */
class SimpleAjax extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'simple_ajax';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['display'] = [
      '#type' => 'markup',
      '#markup' => '<div class="message"></div>',
    ];

    $form['number_1'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First number'),
    ];

    $form['number_2'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Second number'),
    ];
    $form['formula'] = [
      '#type' => 'select',
      '#options' => array(
        'select' => t('select'),
        'add' => t('Addition'),
        'subtract' => t('Substract'),
        'multiply' => t('Multiplication'),
      ),
      '#title' => $this->t('Option'),
      '#ajax' => [
        'callback' => '::setMessage',
      ]
    ];

  

    return $form;
  }

  public function setMessage(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    if ($form_state->getvalue('formula') == 'add') {
      $response->addCommand(
      new HtmlCommand(
        '.message',
        '<div class="my_top_message">' . $this->t('The result is @result', ['@result' => ($form_state->getValue('number_1') + $form_state->getValue('number_2'))])
        )
    );
    }
    elseif ($form_state->getvalue('formula') == 'subtract') {
      $response->addCommand(
      new HtmlCommand(
        '.message',
        '<div class="my_top_message">' . $this->t('The result is @result', ['@result' => ($form_state->getValue('number_1') - $form_state->getValue('number_2'))])
        )
    );
    }
    else{
      $response->addCommand(
      new HtmlCommand(
        '.message',
        '<div class="my_top_message">' . $this->t('The result is @result', ['@result' => ($form_state->getValue('number_1') * $form_state->getValue('number_2'))])
        )
    );
    }


    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
