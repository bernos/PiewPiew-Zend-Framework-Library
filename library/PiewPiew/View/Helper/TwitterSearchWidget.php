<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TwitterSearchWidget
 *
 * @author Brendan McMahon (bernos@gmail.com)
 */
class PiewPiew_View_Helper_TwitterSearchWidget
extends PiewPiew_View_Widget_Abstract {
  public function twitterSearchWidget($searchTerm) {
    $twitterSearch = new Zend_Service_Twitter_Search('json');
    $searchResults = $twitterSearch->search($searchTerm);

    return $this->renderWidget(array('result' => $searchResults['results']));
  }
}
?>
