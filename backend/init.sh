php bin/console doctrine:database:create --if-not-exists
php bin/console make:migration --no-interaction
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console ugo:orders:import docs
php -S localhost:8080