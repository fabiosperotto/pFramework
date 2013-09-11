<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<html>
<head>
</head>
	<body>
	<div style="margin-left:30px;">
		<h2>Welcome to your Website <?php if(!empty($data['nomeUsuario'])) echo $data['nomeUsuario']; ?>!</h2>
		<h3>pFramework 0.1 working...</h3>		
		<p>
			Se voc� est� vendo essa p�gina o framework est� ok. Em app/controllers consta o controlador padr�o e em 
			index.php a constante MAIN_CONT determina qual � o controlador da sua aplica��o.
		</p>
		<p>
			O diret�rio da aplica��o fica em /app onde constam os diret�rios MVC. Estrutura do framework:
		</p>
		<div>
		/app -> diret�rio da aplica��o <br />
		...../controllers<br />
		...../models<br />
		...../views<br />
		/system -> diret�rio de arquivos do framework<br />
		...../config -> diret�rio de configura��o do framework<br />
		...../core -> diret�rio com arquivos utilizados pelo framework<br />
		...../libraries -> bibliotecas de uso geral (API's, drivers), n�o confundir com models.<br />
		index.php -> local de configura��o inicial, chama o controlador de p�ginas do framework, futuramente poder� ser 
		um config.ini.php (parser)<br />
		</div>
		<p>
		<ul>
			<li>Os nomes de classes devem seguir o seguinte padr�o: Nome_Tipo. <br />
				Exemplo: Pessoa_Model � uma classe model Pessoa. <br />
			</li>
			<li>O nome do arquivo deve ser simples (pessoa.php para exemplo acima), o framework aceita tamb�m uso de sublinha 
				nos arquivos somente se o nome da classe refletir o mesmo padr�o: <br />
				Exemplo: Se m_pessoa.php ent�o a classe tamb�m deve ser M_Pessoa_Model
			</li>
			<li>Todo controller deve ter um metodo chamado index(array $var) que � o m�todo principal de sua execu��o e 
				como argumento um array onde receber� as vari�veis GET.
			</li>		
		</ul>
		</p>
		<h3>URL no pFramework</h3>
		<p>
			Por enquanto existem as duas formas abaixo. As vari�vies GET s�o divididas por 
			barras ( / ) e n�o pelo caractere &. � meio zuera, eu sei. Experimente-os.
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
				<li><b>Template</b>: Crie views espec�ficas para o cabe�alho, conte�do e rodap�s do seu site:<br />					
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
         			<br /> e na view de conte�do 'demo.php' apenas informe: <br />
         			<?php 
         			$codigo = '
					<?=$data[\'cabecalho\'];?>
	         			Conte�do bl� bl� bl�.....
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