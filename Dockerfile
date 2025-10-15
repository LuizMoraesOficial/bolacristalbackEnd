# Usa a imagem oficial do PHP 8.2 com servidor embutido
FROM php:8.2-cli

# Define o diretório de trabalho dentro do container
WORKDIR /app

# Copia todos os arquivos do projeto para dentro do container
COPY . /app

# Porta usada pelo Render (Render define $PORT automaticamente)
ENV PORT=10000

# Instala extensões que o PHP possa precisar (json já vem por padrão)
RUN docker-php-ext-install pdo pdo_mysql || true

# Comando para iniciar o servidor PHP
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t /app"]
