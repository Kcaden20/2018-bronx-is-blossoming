<?php

class SimplemdeField extends TextField {
  
  static public $assets = array(
    'js' => array(
      'simplemde.min.js',
      'jquery.easy-autocomplete.min.js',
      'editor.js'
    ),
    'css' => array(
      'simplemde.min.css',
      'editor.css'
    )
  );
    
  public function input() {

    $input = parent::input();
    $input->tag('textarea');
    $input->data('field', 'simplemde');
    
    $input->data('json', preg_split( '/(\/options|\/pages)/', purl($this->model) )[0] . "/plugins/simplemde" );
    
    $input->removeAttr('value');
    $input->html($this->value() ? htmlentities($this->value(), ENT_NOQUOTES, 'UTF-8') : false);
  
    if (isset($this->buttons)) {
      if (is_array($this->buttons)) {
        $input->data('buttons', $this->buttons);
      }
      else {
        $input->data('buttons', "no");
      }
    }
    else {
      $input->data('buttons', c::get('simplemde.buttons', false));
    }

    return $input;
    
  }

  public function element() {
    $element = parent::element();
    $element->addClass('field-with-simplemde');
    if (c::get('simplemde.kirbytagHighlighting', true)) {
      $element->addClass('kirbytag-highlighting');
    }
    return $element;
  }

}

if (c::get('simplemde.replaceTextarea', false)) {
  class TextareaField extends SimplemdeField {
    
  }
}
