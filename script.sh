#!/bin/bash

# Verifica se um argumento foi passado
if [ -z "$1" ]; then
  echo "⚠️  Uso: ./script.sh [iniciar|encerrar]"
  exit 1
fi

#Caso estiver no windows tire os "sudo" que estão nos comandos desse arquivo

# Executa a ação com base no argumento
if [ "$1" = "iniciar" ]; then
  echo "🚀 Iniciando containers..."
  sudo docker-compose up --build -d
elif [ "$1" = "encerrar" ]; then
  echo "🛑 Encerrando containers..."
  sudo docker-compose down
else
  echo "❌ Opção inválida. Use: iniciar ou encerrar"
  exit 1
fi
