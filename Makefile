ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(RUN_ARGS):;@:)

.PHONY: help

include .env

## Common
#################################

help: ## Show Help
	@echo -e "$$(grep -hE '(^\S+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | sed -e 's/:.*##\s*/:/' -e 's/^\(.\+\):\(.*\)/\x1b[36m\1\x1b[m:\2/' | column -c2 -t -s :)"

init: build boot vendor-composer vendor-npm ## initializes docker machine
	@make -s art key:generate
	sleep 10 # wait that db is ready
	@make -s art migrate
	@make -s art db:seed

build:  ## build all docker containers
	bash -c "docker-compose build"

clear-volumes: ## deletes all volumes of this project
	docker-compose down -v

reset: clear-volumes init ## clear volumes and run init command

vendor-composer: ## installs composer dependencies
	@make -s composer install

vendor-npm: ## install node modules
	@make -s npm

## Docker booting
#################################

boot:
	bash -c "docker-compose up -d"

up: boot vendor-composer ## start docker

down: ## stop  all docker containers
	bash -c "docker-compose down"

restart: down up ## restart all docker containers

## Docker login to containers
#################################

bash: ## open docker bash via ssh
	bash -c "docker-compose exec -u www-data php bash"

bash-root: ## open docker bash via ssh as root
	bash -c "docker-compose exec -u root php bash"

bash-db: ## open docker bash via ssh as root
	bash -c "docker-compose exec mysql bash"

## Forwarding commands
#################################
php: ## forward php command to container
	docker-compose exec -u www-data php bash -c 'php ${ARGS}'

composer: ## forward composer command to container
	docker-compose exec -u www-data php bash -c 'composer ${ARGS}'

npm: ## forward npm command to container
	docker-compose exec -u www-data php bash -c 'npm ${ARGS}'

art: ## forward artisan command to container example `make art "make:model Sample -fs"`
	docker-compose exec -T -u www-data php bash -c 'php artisan ${ARGS}'

tinker: ## forward tinker command to container
	docker-compose exec -u www-data php bash -c 'php artisan tinker ${ARGS}'

## Builds Assets / Node commands
#################################

assets: ## build assets
	@make -s npm "run dev"
assets-watch: ## build assets and start watching for file changes
	@make -s npm "run watch-poll"
assets-production: ## build assets and start watching for file changes
	@make -s npm "run production"

# match all unknown tasks
%:
	@:
