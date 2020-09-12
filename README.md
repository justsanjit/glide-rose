## About Glide Rose

Glide Rose is a simple e-commerce store built with Laravel 8

## Setup

```bash
# Clone project
git clone git@github.com:sanjitkung/glide-rose.git

# Navigate into project directory
cd glide-rose

# Copy environment file and make changes to .env according to your local dev environment
cp .env.example .env

# Create sqlite database
touch database/database.sqlite

# Install composer dependencies
composer install

# Generate application key
php artisan key:generate

# Migrate and seed database
php artisan migrate --seed

# Install npm dependencies
npm install

# Compile the assets
npm run dev
```

Note: If you do not see product images, Fix `APP_URL` env variable.

The glide store is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
