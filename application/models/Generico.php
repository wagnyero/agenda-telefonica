<?php
class Application_Model_Generico extends Zend_Db_Table_Abstract
{
    protected $_db;
    
    public function init(){
        $this->_db = Zend_Registry::get( 'db1' ); //db1
    }

    public function insert($tabela, $registros) {
        try {
            $this->_db->insert("agenda." . $tabela, $registros);
            
            return "sucesso";
        } catch (Exception $e) {
//            var_dump($e);
//            exit;
            return "erro";
        }
    }

    public function delete($tabela, $where) {
        try {
            $this->_db->delete("agenda." . $tabela, $where);
            
            return "sucesso";
        } catch (Exception $e) {
//            var_dump($e);
//            exit;
            return "erro";
        }
    }

    public function update($tabela, $where, $registros) {
        try {
            $this->_db->update("agenda." . $tabela, $registros, $where);
            return "sucesso";
        } catch (Exception $e) {
//            var_dump($registros);
//            echo $e->getMessage() . "<br>" . $e->getTraceAsString();
//            var_dump($e);
//            exit;
            return "erro";
        }
    }
}




