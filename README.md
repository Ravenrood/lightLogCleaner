#LightLogCleaner simple Database log cleaner for log events

#-clone project from
https://github.com/Ravenrood/lightLogCleaner.git

#-configure and then create DB
php bin/console doctrine:database:create

#-updateDB
php bin/console doctrine:schema:update --env=dev --force

#-loading db data 
php bin/console doctrine:fixtures:load --env=dev



