#!/bin/bash

#currentBranch=$(git rev-parse --abbrev-ref HEAD)

if [[ $1 ]]; then
    tag=$1
else
    tag=0.0.1
fi

if [[ $2 ]]; then
    label=$2
else
    label=staging
fi

docker-compose exec {container-name} php artisan optimize
docker-compose exec {container-name} php artisan route:clear

if [[ $label == *"staging"* ]];then
   docker-compose exec {container-name} php artisan scribe:generate
fi

if [[ $label == *"prod"* ]];then
    git checkout master
    git pull origin master
    label="prod"
    cp .env .env.local
    cp .env.production .env
    rm -r ./public/docs
    rm -r ./bootstrap/cache/**
    docker-compose exec {container-name} composer install --no-ansi --no-dev --no-interaction --no-plugins --no-progress --no-scripts
else
    label="staging"
    git checkout develop
    git pull origin develop
    cp .env .env.local
    cp .env.staging .env
    docker-compose exec {container-name} composer install
    docker-compose exec {container-name} php artisan prequel:install
fi

chmod -R 777 storage/

if [[ $label == *"prod"* ]];then
    cp docker/application/releases/Dockerfile.prod Dockerfile
else
    cp docker/application/releases/Dockerfile .
fi

docker build --no-cache -t registry.cn-hangzhou.aliyuncs.com/mn/{Branch Name}-$label:$tag .

rm Dockerfile

docker push registry.cn-hangzhou.aliyuncs.com/mn/{Branch Name}-$label:$tag

echo registry.cn-hangzhou.aliyuncs.com/mn/{Branch Name}-$label:$tag

git checkout "$currentBranch"

cp .env.local .env

docker-compose exec {container-name} php artisan optimize
