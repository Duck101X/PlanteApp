# 🌿 PlanteApp - Conectando Cultivadores

O **PlanteApp** é uma plataforma Full Stack desenvolvida para entusiastas da botânica. O sistema facilita o descarte consciente e a aquisição de novas espécies através de um sistema de anúncios para doação, troca ou venda de mudas e plantas.

---

## 📖 Sobre o Projeto

O sistema funciona como uma vitrine virtual. O foco é a **sustentabilidade e o cultivo urbano**. 

> ⚠️ **IMPORTANTE:** A negociação não acontece dentro da plataforma. O site atua como uma ponte, exibindo o contato direto (telefone) do anunciante para que as partes finalizem o acordo externamente (via WhatsApp ou ligação).

---

## 🚀 Funcionalidades Principais

### 👤 Gestão de Usuários
- Cadastro e Login com sistema de autenticação.
- Controle de acesso e encerramento de sessão (Logout).

### 🌿 Gestão de Plantas
- **CRUD Completo:** Criar, Listar, Editar e Excluir anúncios de plantas.
- **Upload de Imagens:** Processamento e armazenamento de fotos das mudas.
- **Categorização de Oferta:** Opções para Doar, Trocar ou Vender (com suporte a preços ou itens de troca).

### 🔍 Inteligência de Busca
- **Busca Dinâmica (Assíncrona):** Filtro em tempo real utilizando **JavaScript (Fetch API)** para localizar plantas por nome, tipo ou descrição sem recarregar a página.

---

## 🛠 Tecnologias Utilizadas

- **Front-end:** HTML5, CSS3 (Design Responsivo), JavaScript (Fetch API).
- **Back-end:** PHP 8.x.
- **Banco de Dados:** MySQL / MariaDB.
- **Ambiente de Desenvolvimento:** XAMPP / WampServer.

---

## 📂 Estrutura do Projeto

```text
PLANTEAPP
├── CSS/              # Estilos modulares (Login, Cadastro, Listagem)
├── img/              # Ativos visuais estáticos do site
├── Login/            # Lógica de autenticação e configuração do BD
├── Planta/           # Processamento do CRUD e buscas
│   └── uploads/      # Pasta de destino das fotos das plantas
├── index.php         # Página inicial (Landing Page)
└── sql/              # Arquivos de exportação do Banco de Dados
```

🗄️ Modelagem do Banco de Dados
O sistema utiliza MySQL com duas tabelas relacionadas:

Tabela cadastro: Gerencia os usuários (ID, Nome, Email, Senha).

Tabela plantas: Armazena os anúncios.

Relacionamento: Possui uma Chave Estrangeira (usuario_id) que vincula cada planta ao seu respectivo dono na tabela de usuários.

⚙️ Instalação e Configuração
Clonar o repositório:
```
Bash
git clone [https://github.com/seu-usuario/planteapp.git](https://github.com/seu-usuario/planteapp.git)
Configurar o Servidor Local:
```
Mova a pasta do projeto para htdocs (XAMPP) ou www (Wamp).

Importar o Banco de Dados:

No phpMyAdmin, crie um banco de dados chamado cadastro.

Importe os arquivos SQL inclusos no projeto.

Ajustar Conexão:

Verifique o arquivo Login/config.php e insira suas credenciais locais:
```

PHP
$conexao = new mysqli("localhost", "seu_root", "sua_senha", "cadastro");
Executar:
```
Acesse: http://localhost/planteapp

📱 Fluxo de Uso
Anúncio: O usuário cadastra a planta e faz o upload da foto.

Interesse: Outro usuário utiliza a busca dinâmica para filtrar o que deseja.

Negociação: Ao clicar em "Negociar", os detalhes e o telefone de contato são exibidos.

Contato: A comunicação final ocorre fora do ambiente web.

🌿 Objetivo
Incentivar o cultivo urbano e promover a economia circular de mudas de forma simples e eficiente.

Desenvolvido por Duck101X 🚀
