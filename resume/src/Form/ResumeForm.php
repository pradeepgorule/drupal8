<?php

namespace Drupal\resume\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ResumeForm extends FormBase {

  public function getFormId() {
    return 'resume_form';//
  }


  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
      
    );
     
        $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,

    );

    $form['mobile'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
    );

 
    // The 'replace-textfield-container' container will be replaced whenever
    // 'changethis' is updated.
   

    // An AJAX request calls the form builder function for every change.
    // We can change how we build the form based on $form_state.
    $value = $form_state->getValue('name');
    // The getValue() method returns NULL by default if the form element does
    // not exist. It won't exist yet if we're building it for the first time.
    if ($value !== NULL) {
      $form['replace_textfield_container']['replace_textfield']['#description'] =
        $this->t(" '@value' Enter your Last Name", ['@value' => $value]);
    }
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );


  


    return $form;
  }


    public function validateForm(array &$form, FormStateInterface $form_state) {

      if (strlen($form_state->getValue('mobile')) < 10) {
        $form_state->setErrorByName('mobile', $this->t('Mobile number is less than 10 digit.'));
      }

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
