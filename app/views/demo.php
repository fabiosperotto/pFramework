<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<html>
<head>
</head>
	<body>
	<div style="margin-left:30px;">
		<h2>Welcome to your Website <?php if(!empty($data['nomeUsuario'])) echo $data['nomeUsuario']; ?>!</h2>
		<h3>pFramework 0.1 working...</h3>		
		<p>
			Se você está vendo essa página o framework está ok. Em app/controllers consta o controlador padrão e em 
			index.php a constante MAIN_CONT determina qual é o controlador da sua aplicação.
		</p>
		<p>
			O diretório da aplicação fica em /app onde constam os diretórios MVC. Estrutura do framework:
		</p>
		<div>
		/app -> diretório da aplicação <br />
		...../controllers<br />
		...../models<br />
		...../views<br />
		/system -> diretório de arquivos do framework<br />
		...../config -> diretório de configuração do framework<br />
		...../core -> diretório com arquivos utilizados pelo framework<br />
		...../libraries -> bibliotecas de uso geral (API's, drivers), não confundir com models.<br />
		index.php -> local de configuração inicial, chama o controlador de páginas do framework, futuramente poderá ser 
		um config.ini.php (parser)<br />
		</div>
		<p>
		<ul>
			<li>Os nomes de classes devem seguir o seguinte padrão: Nome_Tipo. <br />
				Exemplo: Pessoa_Model é uma classe model Pessoa. <br />
			</li>
			<li>O nome do arquivo deve ser simples (pessoa.php para exemplo acima), o framework aceita também uso de sublinha 
				nos arquivos somente se o nome da classe refletir o mesmo padrão: <br />
				Exemplo: Se m_pessoa.php então a classe também deve ser M_Pessoa_Model
			</li>
			<li>Todo controller deve ter um metodo chamado index(array $var) que é o método principal de sua execução e 
				como argumento um array onde receberá as variáveis GET.
			</li>		
		</ul>
		</p>
		<h3>URL no pFramework</h3>
		<p>
			Por enquanto existem as duas formas abaixo. As variávies GET são divididas por 
			barras ( / ) e não pelo caractere &. É meio zuera, eu sei. Experimente-os.
			<ul>
				<li>http://seudominio/pframework/index.php?main/nome=SeuNomeAqui</li>
				<li>http://seudominio/pframework/?main/nome=SeuNomeAqui</li>
			</ul>
		</p>
		<h3>Template</h3>
		<p>
			Existem duas formas de se utilizar o framework para gerar as views, com e sem template: <br />
			<ul>
				<li><b>View direto</b>: no controlador apenas chame a view:<br />
				    <?php
				    highlight_string('<?php
		$view = new View_Model(\'demo\');
    	$view->render();'); 
				    ?> 
				</li>
				<li><b>Template</b>: Crie views específicas para o cabeçalho, conteúdo e rodapés do seu site:<br />					
         			<?php          			
         			highlight_string('<?php 
		$cabecalho = new View_Model(\'cabecalho_template\'); //passando a localizacao do arquivo
		$rodape = new View_Model(\'rodape_template\');
		$conteudo = new View_Model(\'demo\');
		$conteudo->assign(\'cabecalho\', $cabecalho->render(FALSE));
		$conteudo->assign(\'rodape\', $rodape->render(FALSE));
		$conteudo->render();'
         			); 
         			?>
         			<br /> e na view de conteúdo 'demo.php' apenas informe: <br />
         			<?php 
         			$codigo = '
					<?=$data[\'cabecalho\'];?>
	         			Conteúdo blá blá blá.....
	         		<?=$data[\'rodape\'];?>
							';
         			highlight_string($codigo); 
         			?>
	         		<br />
	         		Simples assim =)         
				</li>
			</ul>
		</p>
	</div>
	</body>
</html>