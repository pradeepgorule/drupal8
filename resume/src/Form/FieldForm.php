<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FieldForm extends FormBase {

  public function getFormId() {
    return 'simple_field_form';//
  }


  public function buildForm(array $form, FormStateInterface $form_state) {


        $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,

    );

    $form['mobile'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
    );
      return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    
    $resume_value = array(

      'name'=>$form_state->getValue('name'),
      'email'=>$form_state->getValue('email'),
      'mobile'=>$form_state->getValue('mobile'),

    );

    $query=\Drupal::database();
    $query->insert('resume')
           ->fields($resume_value)
           ->execute();

   
drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('name'))));

  

   }

}