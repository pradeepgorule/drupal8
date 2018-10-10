<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class Textfield extends FormBase
{
	
	public function getFormId()
	{
		return 'auto_text';
	}

	public function  buildForm(array $form, FormStateInterface $form_state)
	{
		$form['container'] = [
			'#type' => 'markup',
			'#markup' => t('text will display when clicked'),
			
		];
		//here we call the textfieldCallback from line 53 & wrapper class is textfield-container from line 46 
		//i.e we have to display textfield on textfield at line 53
		$form['fname'] = [
			'#type' => 'checkbox',
			'#title' => 'Click here to enter your first name',
			'#ajax' => [
        		'callback' => '::textfieldCallback',
        		'wrapper' => 'textfield-container',
        		
     		 ],
		];

		$form['lname'] = [
			'#type' => 'checkbox',
			'#title' => 'Click here to enter your Last name',
			'#ajax' => [
        		'callback' => '::textfieldCallback',
        		'wrapper' => 'textfield-container',
        		
     		 ],
		];


		$form['textfield-container'] = [
			'#type' => 'container',
			'#markup' => t('textfield will displays here'),
			'#attributes' => ['id' => 'textfield-container'],
		];


		$form['textfield-container']['textfield'] = [
			'#type' => 'fieldset',
			'#description'  => t('textfield will display here'),
		];


		if($form_state->getValue('fname', NULL) === 1){
		$form['textfield-container']['textfield']['name'] = [
			'#type' => 'textfield',
			'#title' => t('First Name'),
		];
		}


		if($form_state->getValue('lname', NULL) === 1){
		$form['textfield-container']['textfield']['lastname'] = [
			'#type' => 'textfield',
			'#title' => t('Last Name'),
		];
		}


		$form['textfield-container']['submit']= [
			'#type' => 'submit',
			'#value' => t('Submit'),
		];

		return $form;
	}
	public function submitForm(array &$form, FormStateInterface $form_state) {}


public function textfieldCallback(array $form, FormStateInterface $form_state) {
    return $form['textfield-container'];
  }
}