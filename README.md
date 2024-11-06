# 📚 Library Manager

Uma aplicação FullStack para armazenamento e registro de livros, desenvolvida com PHP 8.2 e Laravel 11.9.

## 🚀 Funcionalidades

- ✨ Gerenciamento completo de livros (CRUD)
  - Cadastro de novos livros
  - Edição de informações
  - Remoção de registros
- 🔍 Sistema de busca avançada
  - Filtros por título, autor ou ano de publicação
  - Paginação dos resultados

## 🛠️ Tecnologias

- **Backend**
  - PHP 8.2
  - Laravel 11.9
  - PostgreSQL
- **Infraestrutura**
  - Docker
  - Docker Compose
- **Ferramentas**
  - Makefile (automação)
  - Git (versionamento)

## ⚙️ Pré-requisitos

- Docker
- Docker Compose
- Git
- Make (opcional)

## 🚀 Instalação

### 1. Clone o repositório

```bash
git clone git@github.com:Ands97/library-manager.git
cd library-manager
```

### 2. Configuração do ambiente

Copie o arquivo de exemplo de variáveis de ambiente:
```bash
cp .env.example .env
```

### 3. Inicialize a aplicação

#### Usando Docker diretamente:
```bash
docker build --progress=plain --no-cache -t library-manager:latest .
docker-compose up -d
```

#### Ou usando Makefile (recomendado):
```bash
make build  # Constrói as imagens
make up     # Inicia os containers
```

### 4. Gere a APP_KEY

A chave de aplicação é necessária para criptografia segura. Gere-a usando um dos métodos abaixo:

#### Usando Docker:
```bash
docker-compose exec app php artisan key:generate
```
## 📝 Comandos úteis

```bash
make help    # Lista todos os comandos disponíveis
make down    # Para os containers
make logs    # Visualiza os logs da aplicação
make app-shell   # Acessa o shell do container da aplicação
```

## 🌐 Acessando a aplicação

1. Acesse no navegador:
```
http://localhost:8080
```

2. Na primeira execução:
   - Crie um usuário através do formulário de registro 
   - Após o registro será redirecionado para a aplicação
   - Comece a gerenciar sua biblioteca!

## 🔧 Troubleshooting

Se encontrar problemas durante a instalação:

1. Verifique se as portas 8080 e 5432 não estão em uso
2. Certifique-se que o Docker está rodando
3. Tente recriar os containers:
```bash
make down
make build
make up
```