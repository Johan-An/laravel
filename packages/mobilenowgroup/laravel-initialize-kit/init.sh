if [[ $1 ]]; then
    label=$1
else
    label=staging
fi

docker-compose exec {container-name} php artisan vendor:publish --provider="MobileNowGroup\LaravelErrorDingDingNotice\SendDingDingProvider"

if [[ $label == *"staging"* ]];then
   docker-compose exec {container-name} php artisan scribe:generate
   docker-compose exec {container-name} php artisan prequel:install
   docker-compose exec {container-name} php artisan vendor:publish --provider="MobileNowGroup\LaravelPhpCs\LaravelPhpCsServiceProvider"
fi