# PHP CLI Application

## Goal
 - PHP 8.x Application
 - CLI only
 - Uses database
 - Have option for `call-api` 
     - which should retrieve data from an HTTP endpoint
     - saves the results into database
 - Have option for `get-results`
    - Displays saved results
 - Have unit tests

## Requirements
- PHP `8.3`
- MySQL (see docker-compose file)
- `.env` file (Based on the `.env.example` file)

### Docker

#### use the env file with docker-compose
docker-compose --env-file ../src/.env up

#### start db only
docker-compose --env-file ./src/.env up db

#### start phpmyadmin
docker-compose --env-file ./src/.env up phpmyadmin


### Database

In the `data` directory, there is an `.sql` file, please create the database.  
This project does not implement (yet) any seed or database install/preparation/migration.


## Install

```bash
composer update
```


## Usage

Available commands:

| Command           | Optional param |   Desc                              |
| ----------------- | -------------- | ----------------------------------- |
| --version         | n/a            | App version                         |
| --help            | n/a            | Available options                   |
| --call-api        | n/a            | Request a HTTP endpoint             |
| --get-results     | [number]       | Lists the saved data, 10 by default |

### Note on `get-results`
This command accept a number for printable lines

### Example `call-api` command

```bash
cd <project>
php src/index.php --call-api
```

Expected result:

```bash
Test Assignment PHP CLI Application 
  API Call result saved. 
```

### Example `get-results` command

```bash
php src/index.php --gr
```

Example result:  

```bash
Test Assignment PHP CLI Application 
Stored API call results: 

ID    Status          Data                                     Created At               
--------------------------------------------------------------------------------------------------------------
20    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 20:39:40      
19    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 20:48:32      
18    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 17:23:49      
17    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 17:23:47      
16    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 17:23:46      
15    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 17:23:44      
14    fail            {"message": "Simulated failure...        2024-05-15 17:23:34      
13    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 16:43:42      
12    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 16:43:41      
11    success         s:30:"{"pong": true,"sandbox":...        2024-05-15 16:43:39 
```



## Testing

### How to test

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

## TODO
- [ ] Configure `PHPMD`
- [ ] Configure `PHP-cs-fixer`
- [ ] Configure `PHP-stan`
- [ ] Create DTO for models (see `SaveResultsModel.php:23` or `GetResultsModel.php:26`)
- [ ] Add workflow file to run tests on GitHub
- [ ] Update Dockerfile
- [ ] Add Dockerfile just for unit tests
