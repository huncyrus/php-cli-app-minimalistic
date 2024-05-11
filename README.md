# use the env file with docker-compose
docker-compose --env-file ../src/.env up

# start db only
docker-compose --env-file ./src/.env up db

# start phpmyadmin
docker-compose --env-file ./src/.env up phpmyadmin

