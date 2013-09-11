<?php
/**
 * Este controlador encaminha todas as solicitacoes para o controlador apropriado
 */
//Inclui automaticamente arquivos contendo classes das quais sao chamadas
function __autoload($className)
{
    // Analisar o nome do arquivo onde a classe deve estar localizada
    // A forma como esta suporta nomes como 'Examplo_Model', 'Examplo_Segundo_Model'
    list($suffix, $filename) = preg_split('/_/', strrev($className), 2);
    $filename = strrev($filename);
    $suffix = strrev($suffix);
	
	//compoe o nome de arquivo, se for uma view, primeiro tem que ter o include da system/core/view.php para gera-las
	//qualquer outra coisa, model, library, deve ser tratado nas proximas linhas 
	if(preg_match("/\bview\b/",strtolower($filename)))
	{
	    $file = SERVER_ROOT . DS . 'system' . DS . 'core' . DS . strtolower($filename) . '.php';
	}
	
	//otherwise the required class from application will be loaded
	if(!preg_match("/\bview\b/",strtolower($filename)))
	{
	    switch (strtolower($suffix))
	    {
	    	case 'model':
	    
	    	    $folder = DS .'app' . DS . 'models' . DS;
	    
	    	    break;
	    
	    	case 'library':
	    
	    	    $folder = DS . 'system' . DS . 'libraries' . DS;
	    
	    	    break;
	    
	    	case 'driver':
	    
	    	    $folder =  DS . 'system' . DS . 'libraries' . DS . 'drivers' . DS;
	    
	    	    break;
	    }
	    $file = SERVER_ROOT . $folder . DS . strtolower($filename) . '.php';
	}

	if (file_exists($file))
	{
		//finalmente inclui
		include_once($file);		
	}
	
	if(!file_exists($file))
	{
		//em caso de problema
		die("Arquivo '$filename' contendo a classe '$className' não foi encontrado.");	
	}
}
	
//pega a requisicao do usuario, QUERY_STRING eh o que vem depois do ? na url caso nao saiba!
$request = $_SERVER['QUERY_STRING'];

//um parse para verificar os demais campos GET que contem na QUERY_STRING
$parsed = explode('/' , $request);

//o controlador deve ser o primeiro elemento da query_string
$page = array_shift($parsed);

//o restante dos elementos declarados tornam-se variaveis
$getVars = array();
foreach ($parsed as $argument)
{
	//split GET vars no simbolo '=' que separa variable, values
	list($variable , $value) = explode('=' , $argument);
	$getVars[$variable] = $value;
}

//controller default caso nenhum for informado no arquivo de configuracao
if(MAIN_CONT == ''){
	$page = 'main';
}

//determinando o caminho do arquivo controlador
$target = SERVER_ROOT . DS . 'app' . DS . 'controllers' . DS . $page . '.php';


if (file_exists($target))
{
	include_once($target);
	
	//combinando com o nome de convencao para as classes
	$class = ucfirst($page) . '_Controller';
	
	//instanciando a classe apropriada
	if (class_exists($class))
	{
		$controller = new $class;
	}
	else
	{
		//se caiu aqui, provavlemente o nome da classe esta com problemas
		die('Classe inexistente!');
	}
}
else
{
	//ou nao existe controller algum com o nome repassado 
	die('Controller inexistente!');
}

//com o controlador instanciado, eh chamado seu metodo principal (index)
//passando qualquer variavel GET para o metodo principal
$controller->index($getVars);


