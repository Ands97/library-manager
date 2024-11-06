# Variables
DOCKER_COMPOSE = docker-compose

# Default target
all: help

# Display help information
help:
	@echo "Usage: make [command]"
	@echo ""
	@echo "Available commands:"
	@echo "  build           			- Build the Docker containers"
	@echo "  up              			- Start the Docker containers"
	@echo "  down            			- Stop the Docker containers"
	@echo "  status          			- Show status of Docker containers"
	@echo "  app-shell       			- Access the Laravel application shell"
	@echo "  migrate         			- Run migrations"
	@echo "  create-queues   			- Create RabbitMQ queues"
	@echo "  seed            			- Run database seeders"
	@echo "  dump-autoload   			- Dump autoloaded classes"
	@echo "  config-clear    			- Config clear"
	@echo "  cache-clear     			- Cache clear"
	@echo "  composer-install 		- Install Composer dependencies"
	@echo "  composer-require 		- Require Composer dependencies"
	@echo "  composer-require-dev - Require Composer dev dependencies"
	@echo "  composer-update 			- Update Composer dependencies"
	@echo "  logs            			- View application logs"
	@echo "  clean           			- Clean up Docker images and volumes"
	@echo ""
	@echo "Use 'make [command]' to run a specific command."

# Build the Docker containers
build:
	docker build --progress=plain -t library-manager .

# Start the Docker containers
up:
	$(DOCKER_COMPOSE) up -d

# Stop the Docker containers
down:
	$(DOCKER_COMPOSE) down

# Show status of Docker containers
status:
	$(DOCKER_COMPOSE) ps

# Access the Laravel application shell
app-shell:
	$(DOCKER_COMPOSE) exec app bash

# Run migrations
migrate:
	$(DOCKER_COMPOSE) exec app php artisan migrate

# Run database seeders
seed:
	$(DOCKER_COMPOSE) exec app php artisan db:seed

# Config clear
config-clear:
	$(DOCKER_COMPOSE) exec app php artisan config:clear

# Cache clear
cache-clear:
	$(DOCKER_COMPOSE) exec app php artisan cache:clear

# Install Composer dependencies
composer-install:
	$(DOCKER_COMPOSE) exec app composer install

# Require Composer dependencies
composer-require:
	$(DOCKER_COMPOSE) exec app composer require $(filter-out $@,$(MAKECMDGOALS))

# Require Composer dev dependencies
composer-require-dev:
	$(DOCKER_COMPOSE) exec app composer require --dev $(filter-out $@,$(MAKECMDGOALS))

# Update Composer dependencies
composer-update:
	$(DOCKER_COMPOSE) exec app composer update

# Update Composer dependencies
composer-update-single:
	$(DOCKER_COMPOSE) exec app composer update $(filter-out $@,$(MAKECMDGOALS))

# View application logs
logs:
	$(DOCKER_COMPOSE) logs -f

# Clean up Docker images and volumes
clean:
	$(DOCKER_COMPOSE) down --rmi all --volumes

.PHONY: all help build up down restart status app-shell migrate create-queues seed test test-single test-coverage dump-autoload config-clear cache-clear composer-install composer-require composer-require-dev composer-update composer-update-single logs clean
