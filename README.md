# Axium – ABM de Productos y Servicios

Proyecto base Symfony 6.4 con entorno Dockerizado para desarrollo backend API. Incluye configuración para PostgreSQL, Composer, Yarn y servidor Nginx en el puerto 8085.

## 🚀 Requisitos

- Docker + Docker Compose
- Git

## 🧭 Instalación rápida

```bash
git clone https://github.com/tu-usuario/axium.git
cd axium
docker compose up --build -d
```

## 🌐 Acceso a la app

```
http://localhost:8085
```

## 🐚 Acceso al contenedor PHP

```bash
docker compose exec php bash
```

## ⚙️ Setup Symfony (si no se hizo en el build)

Dentro del contenedor:

```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

## 🎨 Compilación de assets (Stimulus, Turbo, Bootstrap)

```bash
yarn install
yarn dev
```

## 🛠️ Comandos útiles

```bash
docker compose down
docker compose build
docker compose exec php bash
```
