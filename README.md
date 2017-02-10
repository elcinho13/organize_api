# organize_api
Repositório do web service

[Marcela Melo][09/02/2017]

- CONFIGURAÇÃO INICIAL (LOCALHOST):
    * Clonar o repositorio DENTRO DA PASTA PADRÃO DO SERVIDOR (/opt/lampp/htdocs).
        O caminho base para acesso ao projeto (pelo navegador) deverá ser: http://localhost/organize_api
    
    * Abrir a pasta do projeto pelo terminal e executar o comando 'composer install' (sem aspas).
        Provavelmente (se não tiver instalado) o SO irá informar que o composer não existe e perguntar se quer instalar. Aceite. 
        Ao final do processo (conclusão do comando) deverá existir uma pasta 'vendor' na raiz do projeto. 
    
    * No navegador, ir até:  http://localhost/phpmyadmin/ para executar o banco de dados local.
    * Importar o script 'scriptdb.sql' para gerar o banco de teste no local host.
