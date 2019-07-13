# Helix Sleep Code Challenge
## Setup
All seeded users will be generated with the same password (secret). A list of user will be displayed in the terminal.
```bash
composer install
php artisan migrate --seed
php artisan jwt:secret
```

