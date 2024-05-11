# Use official PHP image with the CLI version
FROM php:8.3-cli

# Install PDO SQLite extension
RUN docker-php-ext-install pdo_sqlite mysql_client mysqli_client pdo pdo_mysql

# Set the working directory
WORKDIR /app

# Copy the application files to the container
COPY . /app

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install

# Command to keep the container running
CMD ["tail", "-f", "/dev/null"]
