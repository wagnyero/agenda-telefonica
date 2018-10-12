<?php
header("Content-type: text/html; charset=utf-8");
/******************************************************************
                        Constantes de Configura��o
********************************************************************/



//defined('PERFIL_ADM') || define('PERFIL_ADM',1); // Administrador
//defined('PERFIL_OPE') || define('PERFIL_OPE',4); // Operador


 

// T�tulo da aplica��o
defined('APPLICATION_TITLE') || define('APPLICATION_TITLE', 'Agenda Telefônica');

// Sistema operacional do servidor
defined('OS') || define('OS', (stripos($_SERVER["SERVER_SOFTWARE"], "win32") == TRUE ? "WINDOWS" : "UNIX"));

// Tipo de barra a utilizar de acordo com o sistema
defined('BAR') || define('BAR', (OS == "WINDOWS" ? "\\" : "/"));

// Separador de caminhos de acordo com o sistema
defined('PATH_SEPARATOR') || define('PATH_SEPARATOR', (OS == "WINDOWS" ? ";" : ":"));

// Caminho completo para a pasta da aplica��o    
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__).BAR.'..'));
#defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Nome da aplica��o
defined('APPLICATION_NAME') || define('APPLICATION_NAME', ltrim(strrchr(APPLICATION_PATH, BAR), BAR));

// Ambiente da aplica��o
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Caminhos da aplica��o
defined('ROOT_PATH') || define('ROOT_PATH', '/aplicacao/'.APPLICATION_NAME.'/public');
defined('LIBRARY_PATH') || define('LIBRARY_PATH', '/biblioteca');
defined('INTERNAL_LIBRARY_PATH') || define('INTERNAL_LIBRARY_PATH', '/aplicacao/'.APPLICATION_NAME.'/library');
defined('UPLOAD_FILES_PATH') || define('UPLOAD_FILES_PATH', '/doc/aplicacao/'.APPLICATION_NAME.'/');

// Endere�o do PortalDO de produ��o


/******************************************************************
                        Inicializa��o do Zend
********************************************************************/

/* set_include_path(implode(PATH_SEPARATOR,
        array(
            realpath(APPLICATION_PATH . '/../../biblioteca/php/zend/zend-1.11.11/'),
            realpath(APPLICATION_PATH . '/controllers'),
            get_include_path(),))); */

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    realpath(APPLICATION_PATH . '/../../biblioteca/php/zend/zend-1.11.11'),
    realpath(APPLICATION_PATH . '/controllers'),
    realpath(APPLICATION_PATH . '/models'),
    get_include_path(),
)));


require_once 'Zend/Application.php';

$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/config/configAgendaTelefonica.ini'
);

$application->bootstrap()->run();
