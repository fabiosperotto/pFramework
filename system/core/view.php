<?php
/**
 * Este model define a funcionalidade das views no nosso MVC
 */
class View_Model
{
	//array que guarda as variaveis que poderao ser utilizadas dentro da view
	private $data = array();

	private $render = FALSE;

	/**
	 * aceita template ou view para carregar
	 */
	public function __construct($template)
	{
		//nome do arquivo
		$file = SERVER_ROOT . '/app/views/' . strtolower($template) . '.php';

		if (file_exists($file))
		{

			$this->render = $file;
		}		
	}

	/**
	 * Recebe atribuições do controlador de variavies para mostrar na view
	 * 
	 * @param $variable
	 * @param $value
	 */
	public function assign($variable , $value)
	{
		$this->data[$variable] = $value;
	}

	/**
	 * Renderiza a view diretamente na pagina ou retorna a saida gerada
	 * 
	 * @param $direct_output Setado para nao-TRUE temos a view gerada
	 * diretamente.
	 */
	public function render($direct_output = TRUE)
	{
		// captura todo o buffer de saida
		if ($direct_output !== TRUE)
		{
			ob_start();
		}

		// variaveis de dados em variaveis locais
		$data = $this->data;

		// entao inclui a view/template
		include($this->render);

		// pega o conteudo do buffer e o retorna
		if ($direct_output !== TRUE)
		{
			return ob_get_clean();
		}
	}

	public function __destruct()
	{
	}
}