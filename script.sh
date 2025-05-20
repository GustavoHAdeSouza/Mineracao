#!/bin/bash

# Verifica se um argumento foi passado
if [ -z "$1" ]; then
  echo "⚠️  Uso: ./script.sh [criar|deletar|iniciar|parar]"
  exit 1
fi

# Caso esteja no Windows, remova os "sudo" dos comandos abaixo

# Executa a ação com base no argumento
case "$1" in
  criar)
    echo "🚀 Iniciando containers com build..."
    sudo docker-compose up --build -d
    ;;
  deletar)
    echo "🛑 Encerrando containers e removendo..."
    sudo docker-compose down
    ;;
  iniciar)
    echo "▶️ Iniciando containers existentes..."
    sudo docker-compose start
    ;;
  parar)
    echo "⏹️ Parando containers sem remover..."
    sudo docker-compose stop
    ;;
  *)
    echo "❌ Opção inválida. Use: iniciar, encerrar, start ou stop"
    exit 1
    ;;
esac
