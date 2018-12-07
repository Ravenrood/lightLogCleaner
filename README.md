### LightLogCleaner simple Database log cleaner for log events

1 - Clone project from

[https://github.com/Ravenrood/lightLogCleaner.git]

2 - Configure and then create DB

```php bin/console doctrine:database:create```

3 - Update DB

```php bin/console doctrine:schema:update --env=dev --force```

4 - loading db data 

```php bin/console doctrine:fixtures:load --env=dev```