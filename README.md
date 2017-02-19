# organize_api
Repositório do web service

- CONFIGURAÇÃO INICIAL (LOCALHOST):
    * Clonar o repositorio DENTRO DA PASTA PADRÃO DO SERVIDOR (/opt/lampp/htdocs).
        O caminho base para acesso ao projeto (pelo navegador) deverá ser: http://localhost/organize_api
    
    * Abrir a pasta do projeto pelo terminal e executar o comando 'composer install' (sem aspas).
        Provavelmente (se não tiver instalado) o SO irá informar que o composer não existe e perguntar se quer instalar. Aceite. 
        Ao final do processo (conclusão do comando) deverá existir uma pasta 'vendor' na raiz do projeto. 
    
    * No navegador, ir até:  http://localhost/phpmyadmin/ para executar o banco de dados local.
    * Importar o script 'scriptdb.sql' para gerar o banco de teste no local host.

- PADRÕES DE DESENVOLVIMENTO
    (O que estiver fora do estabelecido NÃO SERÁ ACEITO NO MERGE)
    * Seguir CRITERIOSAMENTE o padrão do projeto.
    * Desenvolvimento EXCLUSIVAMENTE em inglês.
    * Atenção a lógicas complexas e desnecessárias. 

- ERROS COMUNS
    * "Não é possível acessar esse site. A conexão com localhost foi recusada."
        O Xammp não foi iniciado. Execute o comando: "sudo /opt/lampp/lampp start"  no terminal

    * "404 Page Not Found"
        Sua rota não existe. Verifique: 
            - se o nome está digitado corretamente;
            - se a controller e a rota foi iniciada no arquivo routers.php
            - chame manualmente o index.php na url: http://localhost/organize_api/index.php/'suarota' 
              (algumas vezes o servidor não resolve a url corretamente)
