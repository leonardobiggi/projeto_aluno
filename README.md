# Projeto Aluno

Esta aplicação tem o objetivo de cadastrar, listar, pesquisar, 
editar e excluir o cadastro de alunos e gerar um relatório PDF 
por idade.

# Desenvolvedor

Leonardo Biggi Toledo

## Arquitetura

Aplicação construída usando PHP com banco de dados MySql através 
do framework CodeIgniter, e para o frontend foi utilizado o 
Bootstrap 5.

## Banco de dados

Certifique-se de ter um banco de dados em um servidor MySQL. 
Prepare a estrutura de tabelas com script existente na pasta
'script'.

## Execução

Para executar esta aplicação você precisará de um servidor de 
aplicação capaz de interpretar PHP. Copie todo o conteúdo da 
pasta 'app' diretamente para a raiz do servidor e altere os 
arquivos:
	- application/config/database.php 
	Nele insira os dados de conexão com o banco de dados, 
	alterando as linhas: host, user, password e database.
	- application/config/config.php
	Nele informe a URL do projeto na linha base_url, seguindo
	o exemplo: 
	$config['base_url']='http://localhost/projeto_aluno/';
			