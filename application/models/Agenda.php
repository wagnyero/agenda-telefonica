<?php
class Application_Model_Agenda extends Zend_Db_Table_Abstract
{
    protected $_db;
    
    public function init(){
        $this->_db = Zend_Registry::get( 'db1' ); //db1
    }

    public function listarGrupo($grupo = "") {
        $where = "";
        
        if($grupo != "") {
            $where = "WHERE UPPER(NOME) = UPPER('$grupo')";
        }
        
        try {
            $sql = "SELECT DISTINCT IDGRUPO, NOME FROM GRUPO $where";
            
            $result = $this->_db->fetchAll($sql);
            
            return $result;
        } catch (Exception $e) {
//            var_dump($e);
//            exit;
            return "erro";
        }
    }

    public function listarContato($nomeContato) {
        try {
            $sql = "SELECT * FROM CONTATOS WHERE UPPER(NOME) = UPPER('$nomeContato')";
            
            $result = $this->_db->fetchAll($sql);
            
            return $result;
        } catch (Exception $e) {
//            var_dump($e);
//            exit;
            return "erro";
        }
    }
    
    public function listarContatosAgenda($idPagIni, $idPagFim, $order){

        $sql = "SELECT C.IDCONTATOS RNUM, C.NOME, C.TELEFONE, C.EMAIL, G.NOME NOME_GRUPO 
                  FROM CONTATOS C
                    INNER JOIN GRUPO G
                        ON G.IDGRUPO = C.GRUPO_IDGRUPO
                  ORDER BY $order 
                  LIMIT $idPagIni, $idPagFim";

        try { 
            $result = array();
            $resultGrid = $this->_db->fetchAll($sql);

            array_push($result, $resultGrid);

            $sql = "SELECT COUNT(*) COUNT
                    FROM CONTATOS";

            $count = $this->_db->fetchRow($sql);
            array_push($result, $count);
            
            return $result;
        }
        catch(Zend_Db_Exception $e) {
                echo $e."Erro ao Buscar Relatorios";
        }
    }
    
    public function listarTotalContatosPorGrupo(){

        $sql = "SELECT G.NOME, COUNT(GRUPO_IDGRUPO) TOTAL
                FROM CONTATOS C
                        INNER JOIN AGENDA.GRUPO G ON C.GRUPO_IDGRUPO = G.IDGRUPO 
                GROUP BY GRUPO_IDGRUPO";

        try { 
            $result = $this->_db->fetchAll($sql);

            return $result;
        }
        catch(Zend_Db_Exception $e) {
                echo $e."Erro ao Buscar Relatorios";
        }
    }
    
    public function totalContatos(){

        $sql = "SELECT COUNT(*) TOTAL
                FROM CONTATOS ";

        try { 
            $result = $this->_db->fetchRow($sql);

            return $result;
        }
        catch(Zend_Db_Exception $e) {
                echo $e."Erro ao Buscar Relatorios";
        }
    }
    
    public function totalGrupos(){

        $sql = "SELECT COUNT(*) TOTAL
                FROM GRUPO";

        try { 
            $result = $this->_db->fetchRow($sql);

            return $result;
        }
        catch(Zend_Db_Exception $e) {
                echo $e."Erro ao Buscar Relatorios";
        }
    }
}




