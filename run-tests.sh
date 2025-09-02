#!/bin/bash

# Set the working directory to the script's location
cd "$(dirname "$0")"

# Clear any previous test results
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run the tests
echo "Running all tests..."
php artisan test

# Provide specific test commands for convenience
echo ""
echo "To run specific test groups:"
echo "php artisan test --group=unit"
echo "php artisan test --group=feature"
echo ""
echo "To run tests for specific files:"
echo "php artisan test tests/Unit/Models/UserTest.php"
echo "php artisan test tests/Feature/Controllers/RFQControllerTest.php"
