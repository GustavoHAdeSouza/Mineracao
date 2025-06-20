@echo off
SET arg=%1

IF "%arg%"=="" (
    echo ⚠️  Uso: script.bat [criar|deletar|iniciar|parar]
    exit /b 1
)

IF "%arg%"=="criar" (
    echo 🚀 Iniciando containers com build...
    docker-compose up --build -d
) ELSE IF "%arg%"=="deletar" (
    echo 🛑 Encerrando containers e removendo...
    docker-compose down
) ELSE IF "%arg%"=="iniciar" (
    echo ▶️ Iniciando containers existentes...
    docker-compose start
) ELSE IF "%arg%"=="parar" (
    echo ⏹️ Parando containers sem remover...
    docker-compose stop
) ELSE (
    echo ❌ Opcao invalida. Use: criar, deletar, iniciar ou parar
    exit /b 1
)
