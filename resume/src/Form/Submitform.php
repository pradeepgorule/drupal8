<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class Submitform extends FormBase{
public function getFormId(){
	return 'submit_form';

}

public function buildForm(array $form, FormStateInterface $form_state){

	$form['container'] = [
		'#type' => 'container',
		'#attributes' => ['id' => 'box-container'],

	];
	$form['container']['box'] = [
		  '#type' => 'markup',
      '#markup' => '<h1>data display here</h1>',
	];

	$form['submit'] = [
		  '#type' => 'submit',
      	  '#value' => t('submit'),
      	  '#ajax' => [
        'callback' => '::promptCallback',
        'wrapper' => 'box-container',
      ],
	];
	return $form;
}
public function submitForm(array &$form, FormStateInterface $form_state) {}

  public function promptCallback(array &$form, FormStateInterface $form_state) {

    $element = $form['container'];
    $element['box']['#markup'] = " submit : " . date('c');
    return $element;
  }
}