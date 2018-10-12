<?php

class Application_Form_FormAgenda extends Zend_Form {
	
    public function abrirFormCadastrarNovoContato(){
        $this->setMethod(self::METHOD_POST);
        $this->setDecorators(array(array('viewScript', array('viewScript' => '/agenda/formCadastrar.phtml'))));

        return $this;			   				
    }
	
    public function abrirFormCadastrarNovoGrupo(){
        $this->setMethod(self::METHOD_POST);
        $this->setDecorators(array(array('viewScript', array('viewScript' => '/agenda/formCadastrarGrupo.phtml'))));

        return $this;			   				
    }
}