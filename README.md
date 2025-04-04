# Mineracao

Este é o repositório do projeto Mineracao. Aqui estão os passos para começar a usar o site:

## Passo 1: Clonar o repositório

Primeiro, você precisa clonar o repositório do GitHub. Você pode fazer isso usando o seguinte comando no terminal:

```bash
git clone https://github.com/GustavoHAdeSouza/Mineracao.git
```


## Passo 2: Variáveis de Ambiente

Para rodar esse projeto, você vai precisar criar seu `.env` de acordo com o arquivo `.env.example` e colocar os valores das váriaveis de ambiente 

## Passo 3: Iniciar o docker do projeto

Iniciar o projeto com
```bash
./script.sh iniciar
```
mas caso estiver iniciando o projeto em windows entre no arquivo `script.sh` e tire todos os `sudo` do arquivo para funcionar

## Encerrar o projeto docker
```bash
./script.sh encerrar
```