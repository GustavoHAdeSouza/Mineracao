# 🏗️ Projeto Mineração

Este é o repositório do projeto **Mineração**, que utiliza PHP, Docker e Composer. Aqui você encontrará as instruções completas para configurar, executar e desenvolver o projeto em qualquer sistema operacional (Linux, macOS e Windows).

## ✅ Pré-requisitos

Para rodar este projeto, você precisa ter instalado na sua máquina:

- [Docker](https://www.docker.com/) e [Docker Compose](https://docs.docker.com/compose/install/)
- [Composer](https://getcomposer.org/) (se for rodar comandos PHP fora do Docker)
- Git (para clonar o projeto)
- Terminal Bash, WSL, Git Bash ou Powershell (no caso do Windows)

## 📥 Clonando o projeto

Execute no terminal:

```bash
git clone https://github.com/GustavoHAdeSouza/Mineracao.git
```

```bash
cd mineracao
```

## 🔐 Configurando variáveis de ambiente

1. Copie o arquivo de exemplo:

```bash
cp .env.example .env
```

2. Preencha os dados necessários no arquivo `.env` com suas configurações, como:

- Banco de Dados (usuário, senha, host, nome do banco)
- Outras variáveis necessárias

## 📦 Instalando dependências PHP

⚠️ A pasta `/vendor` está no `.gitignore`, então você **precisa instalar as dependências**.

Se estiver rodando localmente (fora do Docker), execute:

```bash
composer install
```

Se estiver rodando dentro do Docker, o script já cuida disso no build.

## 🐳 Subindo o ambiente com Docker

### Linux / macOS:

```bash
./script.sh criar
```

### Windows:

```bash
script.bat criar
```

✔️ Se estiver usando WSL ou Git Bash no Windows, você pode usar o ./script.sh criar também.

## ▶️ Comandos úteis

### Iniciar containers (se já foram criados antes):

Linux/macOS:

```bash
./script.sh iniciar
```

Windows:

```bash
script.bat iniciar
```

### Parar containers (sem deletar):

Linux/macOS:

```bash
./script.sh parar
```

Windows:

```bash
script.bat parar
```

### Deletar containers e volumes:

Linux/macOS:

```bash
./script.sh deletar
```

Windows:

```bash
script.bat deletar
```

## 🔧 Estrutura dos scripts

- script.sh → Para Linux/macOS e Windows (via WSL ou Git Bash)
- script.bat → Para Windows (CMD/Powershell)

## 🚀 Tecnologias Utilizadas

- PHP
- Docker e Docker Compose
- Composer
- MySQL
- Apache

<br>

# 💡 Notas

- Sempre que atualizar ou instalar novas dependências, lembre-se de rodar composer install novamente (ou o equivalente no Docker).
- O projeto depende do correto preenchimento do arquivo `.env` para funcionar.
- Em caso de erros no Docker, verifique se ele está rodando corretamente e se não há conflitos de portas.
