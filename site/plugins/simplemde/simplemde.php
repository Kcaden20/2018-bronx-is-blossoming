<?php 

  if(!function_exists('panel')) return;

  $kirby->set('field', 'simplemde', __DIR__ . DS . 'simplemde');
  
  function search() {
    return site()->search(get("phrase"), array(
    'minlength' => 1,
    'fields' => array(
      "title",
      "uri"
    )))->toArray();
  }
  
  panel()->routes[] = array(
    'pattern' => array(
      '(:any)/simplemde/index.json',
    ),
    'action'  => function() {
      $search = site()->search(get("phrase"), array(
      'minlength' => 1,
      'fields' => array(
        "title",
        "uri"
      )))->toArray();
      return json_encode($search, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    },
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  );
  
  panel()->routes[] = array(
    'pattern' => array(
      '(:any)/simplemde/translation.json',
    ),
    'action'  => function() {
      if (version_compare(panel()->version(), '2.2', '>=')) {
          $lang = panel()->translation()->code();
      } else {
          $lang = panel()->language();
      }
      $langDir = __DIR__ . DS . "simplemde" . DS . 'languages' . DS;
      if (file_exists($langDir . $lang . '.php')) {
        $translation = include $langDir . $lang . '.php';
      }
      else { 
        $translation = include $langDir . 'en.php';
      }
      
      return json_encode($translation, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    },
    'filter'  => 'auth',
    'method'  => 'POST|GET'
  );