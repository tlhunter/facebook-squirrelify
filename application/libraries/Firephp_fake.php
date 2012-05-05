<?php
class FirePHP_Fake {
  
  const LOG = NULL;
  const INFO = NULL;
  const WARN = NULL;
  const ERROR = NULL;
  const DUMP = NULL;
  const EXCEPTION = NULL;
  
  protected static $instance = NULL;
  
  
  public static function getInstance() {
  }
   
  public static function init() {
  } 

  public function setProcessorUrl()
  {
  }

  public function setRendererUrl()
  {
  }
  

  public function log() {
  }

  public function dump() {
  } 
  
  public function detectClientExtension() {
  }
 
  public function fb($Object) {
  }

  protected function setHeader($Name, $Value) {
  }

  protected function getUserAgent() {
  }

  protected function newException($Message) {
  }
}

?>
