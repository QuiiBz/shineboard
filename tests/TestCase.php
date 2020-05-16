<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->createApplication();
        $this->prepareApplication();
    }

    /**
     * Prepate the database
     *
     * @return void
     */
    protected function prepareApplication(): void
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
    }
}
