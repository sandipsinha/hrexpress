<?php
  require_once "HTML/QuickForm2.php";
  require_once 'HTML/QuickForm2/Renderer.php';
  $format = array(
      ''     => 'Newsletter Format:',
      'text' => 'Text',
      'html' => 'HTML'
  );
  $form = new HTML_QuickForm2('newsletter');
  $name = $form->addText('name')->setLabel('Your Name:');
  $email = $form->addText('email')->setLabel('Your E-mail Address:');
  $newsletter = $form->addSelect('format', null, array('options' => $format));
  $newsletter->setLabel('Preferred Newsletter Format:');
  $form->addElement('submit', null, 'Submit!');
  $renderer = HTML_QuickForm2_Renderer::factory('default');
  echo $form->render($renderer);
?>
 