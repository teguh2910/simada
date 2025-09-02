<?php

namespace Tests;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        require __DIR__.'/../vendor/autoload.php';

        $app = require __DIR__.'/../bootstrap/app.php';

        // Bootstrap the application
        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Prepare the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Disable CSRF middleware for tests to avoid 419 responses when posting forms.
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }
}
