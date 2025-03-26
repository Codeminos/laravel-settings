<?php

namespace Tests\Feature;

use Codeminos\Settings\Facades\Settings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingsManagerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the default value is returned for a non-existent setting.
     *
     * @return void
     */
    public function test_get_default_value_if_setting_does_not_exist()
    {
        $default = 'Default Value';

        $value = Settings::get('non_existent_key', $default);

        $this->assertEquals($default, $value);
    }

    /**
     * Test if a setting can be retrieved from the database.
     *
     * @return void
     */
    public function test_get_setting_from_database()
    {
        $key = 'site_name';
        $value = 'My Site';

        // Save the setting
        Settings::set($key, $value);

        // Retrieve the setting
        $retrievedValue = Settings::get($key);

        $this->assertEquals($value, $retrievedValue);
    }

    /**
     * Test if a setting can be stored and retrieved as a single value.
     *
     * @return void
     */
    public function test_set_and_get_single_value()
    {
        $key = 'site_name';
        $value = 'My Single Site';

        // Store the setting
        Settings::set($key, $value);

        // Retrieve the setting
        $retrievedValue = Settings::get($key);

        $this->assertEquals($value, $retrievedValue);
    }

    /**
     * Test if a setting can be stored and retrieved as an array.
     *
     * @return void
     */
    public function test_set_and_get_array_value()
    {
        $key = 'supported_languages';
        $value = ['en', 'fr', 'de'];

        // Store the setting
        Settings::set($key, $value);

        // Retrieve the setting
        $retrievedValue = Settings::get($key);

        $this->assertEquals($value, $retrievedValue);
    }

    /**
     * Test if a setting with one value is returned as a scalar (not an array).
     *
     * @return void
     */
    public function test_get_single_value_from_array()
    {
        $key = 'single_language';
        $value = ['en']; // Single value in an array

        // Store the setting
        Settings::set($key, $value);

        // Retrieve the setting
        $retrievedValue = Settings::get($key);

        $this->assertEquals('en', $retrievedValue); // Should return the single value, not the array
    }
}
