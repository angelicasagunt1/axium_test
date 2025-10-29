# Axium – ABM de Productos-Servicios

Proyecto base Symfony 6.4 con entorno Dockerizado para desarrollo backend API. Incluye configuración para PostgreSQL, Composer y servidor local en el puerto 8080.

## 🚀 Requisitos

- Docker + Docker Compose
- Git

## 🧭 Instalación

```bash
git clone https://github.com/tu-usuario/axium.git
cd axium
docker-compose up --build -d
```

## 🐚 Acceso al contenedor PHP

```bash
docker exec -it axium_test-php-1 bash
```

## ⚙️ Symfony setup (manual por ahora)

Dentro del contenedor:

```bash
composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php -S 0.0.0.0:8000 -t public
```

Accedé desde tu navegador:
```
http://localhost:8080
```