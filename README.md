# e-DefPR
Software para Controle de Processos - Defensoria Pública do Paraná

## Sumário

  1. [Guia Geral](#guia-geral)
  1. [Workflow](#workflow)
  1. [Instalação da Aplicação](#instalações-da-aplicação)
  1. [Execução e Gerenciamento de Tarefas](#execução-e-gerenciamento-de-tarefas)
  1. [Estrutura](#estrutura)
  1. [Sobre](#sobre)

  ## Guia Geral

Esclarecimentos gerais relacionados a documentação:

  <a name="guia--nomenclaturas"></a><a name="1.1"></a>
  - [1.1](#guia--nomenclaturas) **Nomenclaturas**:

    - Issues: tarefas

  <a name="guia--siglas"></a><a name="1.2"></a>
  - [1.2](#guia--siglas) **Siglas**:

    - PR: Pull Request

  <a name="guia--notas"></a><a name="1.3"></a>
  - [1.3](#guia--notas) **Notas Gerais**:

    - Em comandos, os colchetes `[]` delimitam que alguns conteúdos devem ser preenchidos em seu lugar;
    - A distro Ubuntu 16.04 foi utilizada como base de referência para a elaboração desta documentação, em outras distribuições podem ocorrer pequenas variações.

## Workflow

  <a name="workflow--ferramentas"></a><a name="2.1"></a>
  - [2.1](#workflow--ferramentas) **Ferramentas**:

    - [Waffle](https://waffle.io/C3DSU/e-DefPR/join): Gerenciamento de tarefas (issues)
    - [Github](https://github.com/C3DSU/e-DefPR): Versionamento
    - [Slack](https://c3dsu-edefpr.slack.com/messages): Chat e bots

  <a name="workflow--fluxo"></a><a name="2.2"></a>
  - [2.2](#workflow--fluxo) **Levantamento e distribuição de tarefas**:

    - 2.2.1. Draft (Github):

      Consiste no levantamento de demanda semanal em reunião de equipe técnica com equipe de produto, onde são debatidas e anotadas todas as solicitações para serem convertidas em tasks posteriormente.

    - 2.2.2. Tasks (Waffle):

     São as menores fragmentações do processo, são as tarefas técnicas executadas para que uma determinada funcionalidade seja implementada, sendo que essas nem sempre são independentes, e são necessárias diversas tarefas técnicas para completar um item de checklist do roadmap.

<a name="workflow--tarefas"></a><a name="2.3"></a>
  - [2.3](#workflow--tarefas) **Ciclo de vida de Tarefas**:

    - Para cada tarefa há um prazo máximo de execução de 5 dias;
    - Caso a execução de uma tarefa ultrapasse 5 dias a mesma deve ser reavaliada;
    - Tarefas devem ser quebradas em caso de:
      - Tarefas muito grandes;
      - Tarefas que modifiquem diversas áreas distintas do projeto;
      - Tarefas em que a execução ultrapasse os 5 dias.

      ##### Execução de tarefas em fluxo normal:

        ```
        1. Iniciada em colunas To do: (Random, Backend, Frontend)
        2. Executada pelo Desenvolvedor (in progress)
        3. Enviada para Revisão de código pela equipe (review)
        4. Marcada como concluída (done)
        ```

  <a name="workflow--review"></a><a name="2.4"></a>
  - [2.4](#workflow--review) **Revisão de Pull Request**:

    - As revisões de Pull Request devem ser feitas exclusivamente através do Github;
    - Comentários devem ser feitos na Pull Request e avisados via Slack;
    - É proibido realizar merge de Pull Request sem responder aos comentários;

  <a name="workflow--flags"></a><a name="2.5"></a>
  - [2.5](#workflow--flags) **Solicitações no Slack**: utilizamos por padrão flags de classificações no início de cada solicitação.

    - **REVIEW**: a notificação de REVIEW, é direcionada para o channel correto, de acordo com a categoria.

    `Ex.: @here: gianlucabine needs a *REVIEW*: https://github.com/sices/C3DSU/e-DefPR/pull/1/files`


    Para responder uma solicitação utilizamos por padrão o nome de usuário junto a resposta.

    `Ex.: @gianlucabine [MESSAGE]`

    > **Nota**: Para respostas curtas de confirmação pode ser utilizado apenas `:+1:`

 ## Instalação da Aplicação

  <a name="aplicacao--git"></a><a name="3.1"></a>
  - [3.1](#aplicacao--git) **Git e Github**:

    - ##### 3.1.1. *Instalando o Git*
    ```
    $ sudo apt install git
    ```

    - ##### 3.1.2. *Configurando informações do Git*
    ```
    $ git config --global user.email "mail@mail.com"
    $ git config --global user.name "Full Name"
    ```

    - ##### 3.1.3. *Criando chave para acesso SSH*
    ```
    $ ssh-keygen -t rsa -b 4096 -C "mail@mail.com"
    $ cat ~/.ssh/id_rsa.pub
    ```

    - ##### 3.1.4. *Inserindo chave SSH no Github*

      → [Tutorial Github](https://help.github.com/articles/adding-a-new-ssh-key-to-your-github-account)

    - ##### 3.1.5. *Clonando o repositório do Github*
    ```
    $ git clone git@github.com:C3DSU/e-DefPR.git
    ```
  <a name="aplicacao--bash"></a><a name="3.2"></a>
   - [3.2](#aplicacao--bash) **Bash Profile**:
  
      - ##### 3.2.1. *Abra o Arquivo `.profile` com seu editor (Vim, Nano ou outro)*
      ```
      $ sudo vim ~/.profile
      ```
  
      - ##### 3.2.2. *Adicione ao final do arquivo as linhas*
      ```
      export EDEF_PATH=[PROJECT_PATH]
      source $EDEF_PATH/devops/config/variables             
      export PATH=$PATH:$EDEF_PATH/devops
      ```
      > **Nota**: lembre-se de substitir `[PROJECT_PATH]` pelo caminho do projeto.
      
      - ##### 3.2.3. *Carregue as alterações do arquivo bash*
      ```
      $ source ~/.profile
      ```
  
      - ##### 3.2.4. *Na variável `PATH` agora devem aparecer alguns caminhos relacionados a pasta do projeto*
      ```
      $ echo $PATH | grep edef
      ```
      > **Nota**: caso o comando acima não possua retorno revise os passos de instalação e reinicie o sistema operacional.  


## Execução e Gerenciamento de Tarefas

Processo automatizado:
```
1. Executar: edef-issue-start xxx, onde xxx se refere ao número da tarefa no Waffle.
2. Efetuar as modificações no código-fonte.
3. Executar: git add [ARQUIVO INDIVIDUAL ou LISTA DE ARQUIVOS].
    - IMPORTANTE: Não recomendo o uso de: 'git add .'
4. Executar: git commit -m "MENSAGEM EXPLICATIVA" após cada 'git add [ARQUIVO INDIVIDUAL ou LISTA DE ARQUIVOS]' do passo 6.
    - IMPORTANTE: Na "MENSAGEM EXPLICATIVA" explicar de forma resumida o que foi modificado nos arquivos que que foram adicionados no 'git add'.
5. Executar: git push origin issue#xxx, onde xxx se refere ao número da tarefa no Waffle.
6. Executar: edef-issue-request-review auto ou edef-issue-request-review manual (auto cria a PR automaticamente e o manual redirecionada para a página do GitHub)
7. Comunicar no channel o link da PR pedindo review de código.
8. Esperar pelo menos 1 ou 2 Approves e após isso realizar o merge no site do GitHub.
    - IMPORTANTE: Caso as modificações foram complexas e/ou muito imporantes requisitar mais Approves do que somente 2.
9. Ir na página da Pull Request no GitHub e realizar o merge.
```

Processo manual:
```
1. Comunicar no channel apropriado (backend, frontend, random) o início da tarefa
2. Executar: git pull origin master
3. Executar: git checkout -b issue#xxx, onde XXX é o numero da issue no Waffle.
4. Executar: git push --set-upstream origin issue#xxx, onde XXX é o numero da issue no Waffle.
5. Mover a tarefa para a coluna In-progress no Waffle caso não for movida automaticamente.
6. Efetuar as modificações do código fonte.
7. Executar: git add [ARQUIVO INDIVIDUAL ou LISTA DE ARQUIVOS].
    - IMPORTANTE: Não recomendo o uso de: 'git add .'
8. Executar: git commit -m "MENSAGEM EXPLICATIVA" após cada 'git add [ARQUIVO INDIVIDUAL ou LISTA DE ARQUIVOS]' do passo 6.
    - IMPORTANTE: Na "MENSAGEM EXPLICATIVA" explicar de forma resumida o que foi modificado nos arquivos que que foram adicionados no 'git add'.
9. Executar: git push origin issue#xxx, onde xxx se refere ao número da tarefa no Waffle..
10. Ir na página do repositório no GitHub na parte de branches e criar a PR (Pull Request).
    - IMPORTANTE: Na descrição da PR colocar: fixed #XXX, onde XXX é o numero da issue no Waffle.
12. Comunicar no channel o link da PR pedindo review de código.
13. Esperar pelo menos 1 ou 2 Approves e após isso realizar o merge no site do GitHub.
    - IMPORTANTE: Caso as modificações foram complexas e/ou muito imporantes requisitar mais Approves do que somente 2.
14. Ir na página da Pull Request no GitHub e realizar o merge.
15. Executar: git checkout master
16. Executar: git pull origin master
17. Executar: git branch -d issue#xxx.
```

## Inicialização

  Frontend:
  ```
  Dentro da pasta Frontend
  1. yarn install
  2. yarn start
  ```

  Backend:
  ```
  Dentro da pasta Backend
  1. composer install
  2. php artisan migrate:refresh
  3. php artisan migrate
  4. php artisan passport:install
  5. php artisan db:seed
  6. php artisan serve
  ```

## Estrutura

  <a name="estrutura--ambience"></a><a name="9.1"></a>
  - [6.1](#estrutura--ambience) **Ambientes**:

    - `local`: servidor local de desenvolvimento, configurado na máquina de cada desenvolvedor
    - `production`: servidor remoto de produção, base final de uso de deploy manual

  <a name="estrutura--raiz"></a><a name="5.2"></a>
  - [6.2](#estrutura--raiz) **Pastas raiz**:

    - `backend`: pasta backend do projeto, contendo arquivos de models e controllers
    - `frontend`: pasta frontend do projeto, contendo arquivos de views
    - `devops`: pasta de uso geral de devops, como operações de ecossistema, processos, etc
    - `docs`: além do `README.md`, utilizamos essa pasta para documentações de arquivos e UML

## Sobre

  <a name="sobre--equipe"></a><a name="6.1"></a>
  - [7.1](#sobre--equipe) **A equipe**:

    - #### Gianluca Bine
    ```
    Backend developer
    Slack: @gianlucabine
    Github: @Pr3d4dor
    E-mail: gian_bine@hotmail.com
    ```

    - #### Jean Pierri
    ```
    Backend developer
    Slack: @envikeyy
    Github: @EnViKeyy
    E-mail: pierre.jp@outlook.com
    ```
    
    - #### Higor Gardin
    ```
    Frontend developer
    Slack: @HGardin
    Github: @HigorG
    E-mail: higorgardin@hotmail.com
    ```
    
    - #### Prof. Mauro Miazaki
    ```
    Professor
    Slack: @mmiazaki
    Github: @hmmiazaki
    E-mail: maurom@unicentro.br
    ```

    - #### Prof. Marcos Antônio Quináia
    ```
    Professor
    Slack: @marcosquinaia
    E-mail: quiana@unicentro.br
    ```

    - #### Davi Bastos
    ```
    Backend developer
    Slack: @Davi Bastos
    Github: @dav3sk
    E-mail: davibastos.v@gmail.com
    ```
    
    - #### Enrique Augusto da Roza
    ```
    Backend developer
    Slack: @Enrique Augusto da Roza
    Github: @hdoidao
    E-mail: enriqueaugroza@gmail.com
    ```
    
    - #### Luiz Eduardo Chicouski da Cruz
    ```
    Slack: @Luiz Eduardo Chicouski da Cruz
    Github: @SUdoWinchester
    E-mail: luizeduardo2607@gmail.com
    ```

    - #### Paulo Henrique Pieczarka da Silva
    ```
    Fullstack developer
    Slack: @paulopieczarka
    Github: @paulopieczarka
    E-mail: paulopieczarka@gmail.com
    ```

    - #### Alexandre Gueths
    ```
    Frontend developer
    Slack: @agueths
    Github: @agueths
    E-mail: agueths@gmail.com
    ```
        
    - #### Gabriel Pimenta
    ```
    Backend developer
    Slack: @Pimenta
    Github: @Pimenta1
    E-mail: pimenta@programmer.net
    ```
    