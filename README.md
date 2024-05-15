# use the env file with docker-compose
docker-compose --env-file ../src/.env up

# start db only
docker-compose --env-file ./src/.env up db

# start phpmyadmin
docker-compose --env-file ./src/.env up phpmyadmin



## Testing

### HOw to test

```bash
composer run test
```

### Note on testing
If the unit tests give as migration warning, then please run the following
command:   

```bash
vendor/bin/phpunit --migrate-configuration
```

### Note for composer
Regenerate the autoload sometime

```bash
composer dump-autoload
```
