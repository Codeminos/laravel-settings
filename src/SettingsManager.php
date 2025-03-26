<?php

namespace Codeminos\Settings;

use Codeminos\Settings\Models\Setting;
use Illuminate\Support\Facades\Config;

class SettingsManager
{
    /**
     * Get a setting value by key.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        // First, check if the value exists in the config file defaults
        $defaultValue = Config::get("settings.defaults.{$key}", $default);

        // Then check the database if it's not available in the config
        $setting = Setting::where('key', $key)->first();

        if ($setting) {
            // Decode the value as JSON (always return an array)
            $value = json_decode($setting->value, true);

            // If the decoded value is an array and has one item, return that single item
            if (is_array($value) && count($value) === 1) {
                return $value[0];  // Return the first item as a scalar
            }

            // Return the entire array if it's multi-value or the decoded value
            return $value;
        }

        // Return the default if not found in either source
        return $defaultValue;
    }

    /**
     * Set a setting value by key.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return bool
     */
    public function set($key, $value)
    {
        // Find or create the setting
        $setting = Setting::firstOrNew(['key' => $key]);

        // Always store the value as an array (even if it's a single value)
        $setting->value = is_array($value) ? json_encode($value) : json_encode([$value]);

        return $setting->save();
    }

    /**
     * Delete a setting by key.
     *
     * @param  string  $key
     * @return bool
     */
    public function delete($key)
    {
        // Delete the setting from the database
        return Setting::where('key', $key)->delete();
    }
}
