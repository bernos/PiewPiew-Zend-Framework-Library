<?php
/**
 * Description of Placeholders
 *
 * @version $Id: Placeholders.php 3686 2010-11-24 11:06:50Z brendan.mcmahon $
 * @author Brendan McMahon (bernos@gmail.com)
 */
class PiewPiew_Application_Resource_Placeholders
extends Zend_Application_Resource_ResourceAbstract
{
  public function init() {
    $this->getBootstrap()->bootstrap('view');

    $options  = $this->getOptions();
    $view     = $this->getBootstrap()->getResource('view');

    if (isset($options['headtitle'])) {
      $view->headTitle($options['headtitle']['title'])
           ->setSeparator($options['headtitle']['separator']);
    }

    // Init javascript elements
    if (isset($options['headscript'])) {
      // Firstly script files
      if (isset($options['headscript']['files'])) {
        foreach ($options['headscript']['files'] as $key => $value) {
          $view->headScript()->appendFile($value);
        }
      }

      // Lastly inline scripts
      if (isset($options['headscript']['scripts'])) {
        foreach ($options['headscript']['scripts'] as $key => $value) {
          $view->headScript()->appendScript($value);
        }
      }     
    }

    // Init inline javascript elements
    if (isset($options['inlinescript'])) {
      // Firstly script files
      if (isset($options['inlinescript']['files'])) {
        foreach ($options['inlinescript']['files'] as $key => $value) {
          $view->inlineScript()->appendFile($value);
        }
      }

      // Lastly inline scripts
      if (isset($options['inlinescript']['scripts'])) {
        foreach ($options['inlinescript']['scripts'] as $key => $value) {
          $view->inlineScript()->appendScript($value);
        }
      }
    }

    // Init stylesheets
    if (isset($options['headlink'])) {
      if (isset($options['headlink']['stylesheets'])) {
        foreach($options['headlink']['stylesheets'] as $media => $files) {
          foreach($files as $index => $file) {
            $view->headLink()->appendStylesheet($file, $media);
          }
        }
      }
    }

    // Init meta
    if (isset($options['headmeta'])) {
      // Register the custom PiewPiew version of the HeadMeta view helper to
      // suport our extra meta tags
      $view->registerHelper(new PiewPiew_View_Helper_HeadMeta(), 'headMeta');

      if (isset($options['headmeta']['names'])) {
        foreach($options['headmeta']['names'] as $key => $value) {
          $view->headMeta()->prependName($value['value'], $value['content']);
        }
      }
      if (isset($options['headmeta']['properties'])) {

        foreach($options['headmeta']['properties'] as $key => $value) {
          $view->headMeta($value['content'], $value['value'], 'property');
        }

      }

      if (isset($options['headmeta']['httpequiv'])) {
        foreach($options['headmeta']['httpequiv'] as $key => $value) {
          $view->headMeta()->prependHttpEquiv($value['value'], $value['content']);
        }
      }
      if (isset($options['headmeta']['charset'])) {
        $view->headMeta()->setCharset($options['headmeta']['charset']);
      }
    }
  }
}