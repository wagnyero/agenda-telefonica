<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
    protected function _initCache() {
        // Habilita o cache para metadados de tabelas utilizadas pelo Zend_Db
        $cache = Zend_Cache::factory(
                                        'Core',
                                        'File',
                                        array('automatic_serialization' => true ),
                                        array('cache_dir'               => realpath("../data/cache"))
        );
        
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
    }	 
	
    protected function _initDbAdapter() {

        /********************************************************************
               Habilita recurso de conex�o com m�ltiplos bancos de dados
        *********************************************************************/
        $resource = $this->getPluginResource('multidb');
        $resource->init();
        Zend_Registry::set("db1", $resource->getDb("db1"));

    }
    
    public function _initAcl() {
        
        Zend_Controller_Front::getInstance();
    	$autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->setFallbackAutoloader(true);
    }
    
    public function _initView() {
        
    	$this->bootstrap("layout");
    	$layout = $this->getResource("layout");
    	$view = $layout->getView();
    	$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        
    	$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
    	$viewRenderer->setView($view);
    	Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
    }
}