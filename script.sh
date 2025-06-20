#!/bin/bash

# Detecta se precisa do sudo (se não for root)
SUDO=""
if [ "$(id -u)" -ne 0 ]; then
  SUDO="sudo"
fi

# Verifica argumento
if [ -z "$1" ]; then
  echo "⚠️  Uso: ./script.sh [criar|deletar|iniciar|parar]"
  exit 1
fi

# Executa a ação
case "$1" in
  criar)
    echo "🚀 Iniciando containers com build..."
    $SUDO docker-compose up --build -d
    ;;
  deletar)
    echo "🛑 Encerrando containers e removendo..."
    $SUDO docker-compose down
    ;;
  iniciar)
    echo "▶️ Iniciando containers existentes..."
    $SUDO docker-compose start
    ;;
  parar)
    echo "⏹️ Parando containers sem remover..."
    $SUDO docker-compose stop
    ;;
  *)
    echo "❌ Opção inválida. Use: criar, deletar, iniciar ou parar"
    exit 1
    ;;
esac
