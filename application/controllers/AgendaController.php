<?php

class AgendaController extends Zend_Controller_Action
{
    public function formcadastrarAction() {
    	$this->_helper->layout->setLayout('nolayout');

        $formFiltros = new Application_Form_FormAgenda();
        $formSaida = $formFiltros->abrirFormCadastrarNovoContato();

        $this->view = $formSaida;
    }  
    
    public function formcadastrargrupoAction() {
    	$this->_helper->layout->setLayout('nolayout');

        $formFiltros = new Application_Form_FormAgenda();
        $formSaida = $formFiltros->abrirFormCadastrarNovoGrupo();

        $this->view = $formSaida;
    }    
    
    public function cadastrargrupoAction() {
    	$this->_helper->layout->setLayout('nolayout');
        $this->_helper->viewRenderer->setNoRender(true);

        $nomeGrupo = $this->_request->getParam("txtNomeGrupo");
        $bd = new Application_Model_Generico();
        $bdAgenda = new Application_Model_Agenda();
        
        $validaGrupoCadastrado = $bdAgenda->listarGrupo($nomeGrupo);
        
        if(count($validaGrupoCadastrado) == 0){
            $dadosInput = array();
            $dadosInput["nome"] = $nomeGrupo;

            $json = $bd->insert("grupo", $dadosInput);
        } else {
            $json = "Erro: Este grupo já foi inserido";
        }

        $this->_helper->json->sendJson($json);
    }    
    
    public function listargruposAction() {
    	$this->_helper->layout->setLayout('nolayout');
        $this->_helper->viewRenderer->setNoRender(true);

        $nomeGrupo = $this->_request->getParam("txtNomeGrupo");
        $bd = new Application_Model_Agenda();
        
        $json = $bd->listarGrupo($nomeGrupo);

        $this->_helper->json->sendJson($json);
    }

    public function cadastrarcontatoAction() {
    	$this->_helper->layout->setLayout('nolayout');
        $this->_helper->viewRenderer->setNoRender(true);
        
        $response = $this->getRequest()->getParams();
        $erroValidacao = "nao";
        
        if(strpos($response["txtEmail"], "@") === FALSE){
            $json = "ERRO: Email inválido!";
            $erroValidacao = "sim";
        }
        
        if(strlen($response["txtTelefone"]) < 14){
            $json = "ERRO: Telefone inválido!";
            $erroValidacao = "sim";
        } 
        
        $bd = new Application_Model_Generico();
        $bdAgenda = new Application_Model_Agenda();
        
        $validaContatoCadastrado = $bdAgenda->listarContato($response["txtNomeContato"]);
        
        if(count($validaContatoCadastrado) == 0){
            if($erroValidacao == "nao"){
                $dadosInput = array();
                $dadosInput["nome"]             = $response["txtNomeContato"];
                $dadosInput["telefone"]         = $response["txtTelefone"];
                $dadosInput["email"]            = $response["txtEmail"];
                $dadosInput["grupo_idgrupo"]    = $response["slcGrupo"];

                $json = $bd->insert("contatos", $dadosInput);
            } 
        } else {
            $json = "ERRO: Contato já Cadastrado.";
        } 

        $this->_helper->json->sendJson($json);
    }    
    
     public function listarcontatosagendaAction(){
        
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout( "nolayout" );

        $response  = $this->getRequest()->getParams();
        $db = new Application_Model_Agenda();

        $result = $db->listarContatosAgenda(intval($response['start']),
                                                              intval($response['start'] + $response['length']),
                                                              intval(intval($response['order'][0]['column'])+1).' '.$response['order'][0]['dir']);
        foreach ($result[0] as $key => $value) {
            $result[0][$key] = array_values($result[0][$key]);
        }
        
        $data = array('draw' => $_REQUEST['draw'],
                        "recordsTotal" => $result[1]['COUNT'],
                        "recordsFiltered" => $result[1]['COUNT'],
                        "data" => $result[0]);                                                              

        return $this->_helper->json($data);
    }
    
    public function listartotalcontatosporgrupoAction(){
        
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout( "nolayout" );

        $db = new Application_Model_Agenda();

        $result = $db->listarTotalContatosPorGrupo();

        return $this->_helper->json($result);
    }
    
    public function listartotalcontatosAction(){
        
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout( "nolayout" );

        $db = new Application_Model_Agenda();
        $result = $db->totalContatos();

        return $this->_helper->json($result);
    }
    
    public function listartotalgrupoAction(){
        
        $this->_helper->layout->disableLayout();
        $this->_helper->layout->setLayout( "nolayout" );

        $db = new Application_Model_Agenda();

        $result = $db->totalGrupos();

        return $this->_helper->json($result);
    }
}

