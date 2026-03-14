# 🌱 PlanteApp

O PlanteApp é uma plataforma web desenvolvida em PHP, HTML, CSS e MySQL que permite aos usuários doar, trocar ou vender mudas e plantas.
O sistema conecta pessoas interessadas em jardinagem, facilitando o contato entre usuários através do telefone informado no anúncio.

⚠️ Importante:
A negociação não acontece dentro da plataforma. O site apenas exibe o telefone do usuário para que as partes entrem em contato diretamente.

📸 Demonstração

Página inicial do sistema com:

Destaques de plantas

Sistema de busca

Cards com informações das plantas

Botão para negociar

🚀 Funcionalidades

✔ Cadastro de usuários
✔ Login de usuários
✔ Cadastro de plantas
✔ Upload de foto da planta
✔ Escolha da ação:

Doar

Trocar

Vender

✔ Busca de plantas por:

Nome

Tipo

Descrição

✔ Visualização da planta com detalhes
✔ Contato direto com o dono da planta

🛠 Tecnologias utilizadas

PHP

MySQL / MariaDB

HTML5

CSS3

JavaScript (Fetch API)

📂 Estrutura do Projeto
PLANTEAPP
│
├── CSS
│   ├── BlocoProduto.css
│   ├── cadastrar-planta.css
│   ├── cadastro.css
│   ├── listar-plantas.css
│   ├── Login.css
│   ├── negociar.css
│   └── visual1.css
│
├── img
│
├── Login
│   ├── cadastro.php
│   ├── config.php
│   ├── home.php
│   ├── login.php
│   ├── sair.php
│   └── testelogin.php
│
├── Planta
│   ├── buscar-plantas.php
│   ├── cadastrar-planta.php
│   ├── editar-planta.php
│   ├── excluir-planta.php
│   ├── listar-plantas.php
│   ├── negociar.php
│   ├── processa-planta.php
│   ├── saveEdit.php
│   └── uploads
│
├── index.php
├── negociar-index.php
└── buscar-plantas-index.php
🗄 Banco de Dados

O sistema utiliza MySQL com duas tabelas principais:

Tabela cadastro

Armazena os usuários do sistema.

Campos principais:

id

Nome

Email

Senha

Tabela plantas

Armazena os anúncios de plantas.

Campos principais:

idplantas

nome

tipo

telefone

descricao

foto

opcao (doar, trocar, vender)

preco

usuario_id

troca

Existe uma chave estrangeira ligando plantas ao usuário.

⚙️ Instalação
1️⃣ Clonar o repositório
git clone https://github.com/seu-usuario/planteapp.git
2️⃣ Colocar no servidor local

Coloque a pasta dentro do:

xampp/htdocs/

ou

wamp/www/
3️⃣ Criar banco de dados

No phpMyAdmin:

Crie um banco chamado:

cadastro

Importe os arquivos SQL:

cadastro_cadastro.sql

cadastro_plantas.sql

4️⃣ Configurar conexão

Arquivo:

Login/config.php

Exemplo:

$conexao = new mysqli("localhost","root","","cadastro");
5️⃣ Executar o projeto

Abra no navegador:

http://localhost/planteapp
🔎 Sistema de busca

O sistema possui uma busca dinâmica utilizando Fetch API, que atualiza os resultados sem recarregar a página.

A busca funciona por:

nome da planta

descrição

tipo

📱 Como funciona a negociação

Usuário publica uma planta

Outro usuário encontra a planta no feed

Clica em Negociar

O sistema mostra:

telefone

descrição

tipo

foto

preço ou item de troca

O contato é feito fora do site.

🌿 Objetivo do projeto

O PlanteApp foi desenvolvido com o objetivo de:

Incentivar cultivo urbano

Estimular troca de plantas

Promover sustentabilidade

Facilitar o acesso a mudas
