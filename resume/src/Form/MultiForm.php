<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class MultiForm extends FormBase
{
	
	public function getFormId()
	{
		return 'multi_step';
	}
	public function buildForm(array $form, FormStateInterface $form_state)
	{

		if ($form_state->has('page_num') && $form_state->get('page_num') == 2) {
      return self::PageTwo($form, $form_state);
    }
     $form_state->set('page_num', 1);
     $form['name']=[
     	'#type' => 'textfield',
     	'#title' => t('Name'),

     ];
     $form['lname']=[
     	'#type' => 'textfield',
     	'#title' => t('Last Name'),
     ];
     $form['email']=[
     	'#type' => 'email',
     	'#title' => t('Emails'),
     ];
     $form['next']=[
     	'#type' => 'submit',
     	'#button_type' => 'primary',
     	'#value' => t('Next'),
     	'#submit'=> ['::NextForm'],
     ];
     return $form;
	}
	public function NextForm(array &$form, FormStateInterface $form_state) {

			$form_state
      ->set('page_values', [
      
        'name' => $form_state->getValue('name'),
        'lname' => $form_state->getValue('lname'),
        'email' => $form_state->getValue('email'),
      ])
      ->set('page_num', 2)
    
      ->setRebuild(TRUE);

	}

	public function PageTwo(array &$form, FormStateInterface $form_state) {

		//$form_state->set('page_num', 2);
		$form['description'] =[
			'markup' => t('Second page'),
		];
		$form['mob'] =[
			'#type' => 'textfield',
			'#title' => t('Mobile Number'),
		];
		$form['back']=[
     	'#type' => 'submit',
     	'#value' => t('back'),
     	'#submit' => ['::backpage'],
     	];
		$form['submit']=[
     	'#type' => 'submit',
     	'#value' => t('submit'),
     	
     ];
     	
		return $form;
	}
public function backpage(array &$form, FormStateInterface $form_state) {
		$form_state
      ->set('page_values', [
      
        'name' => $form_state->getValue('name'),
        'lname' => $form_state->getValue('lname'),
        'email' => $form_state->getValue('email'),
      ])
      ->set('page_num', 1)
      
      ->setRebuild(TRUE);
}

	public function submitForm(array &$form, FormStateInterface $form_state) {
    $page_values = $form_state->get('page_values');

    $this->messenger()->addMessage($this->t('The form has been submitted. name="@first @last", email=@email', [
      '@first' => $page_values['name'],
      '@last' => $page_values['lname'],
      '@email' => $page_values['email'],
    ]));

    $this->messenger()->addMessage($this->t('And mobile number is @mob', ['@mob' => $form_state->getValue('mob')]));
  }
}