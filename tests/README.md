# SIMADA Testing Suite

This directory contains automated tests for the SIMADA application.

## Test Structure

- **Unit Tests**: Located in `tests/Unit/`
  - Model Tests: `tests/Unit/Models/`
  - Mail Tests: `tests/Unit/Mail/`
  
- **Feature Tests**: Located in `tests/Feature/`
  - Controller Tests: `tests/Feature/Controllers/`
  - Authentication Tests: `tests/Feature/Auth/`

## Running Tests

To run all tests:

```bash
./run-tests.sh
```

To run specific test groups:

```bash
# Run unit tests only
php artisan test --group=unit

# Run feature tests only
php artisan test --group=feature

# Run specific test file
php artisan test tests/Unit/Models/UserTest.php
```

## Test Coverage

The tests cover:

1. **Models**:
   - User
   - Document
   - Transaction
   - Komentar
   - Supplier
   - RFQ

2. **Controllers**:
   - HomeController
   - RFQController

3. **Authentication**:
   - Login/Logout functionality
   - User registration

4. **Mail**:
   - RFQMail formatting and content

## Adding New Tests

To create a new test, use the Laravel Artisan command:

```bash
php artisan make:test NewFeatureTest
```

For unit tests, create them in the appropriate subdirectory under `tests/Unit/`.

## Database Factories

The testing suite includes database factories for all models, making it easy to create test data.
