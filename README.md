# Codeminos Settings

A simple and flexible settings manager for Laravel applications, allowing you to store and retrieve application settings easily.

## 📦 Installation

You can install the package via Composer:

```
composer require codeminos/settings
```

## Publish Configuration & Migrations
After installation, publish the config file and migration:

```
php artisan vendor:publish --provider="Codeminos\\Settings\\SettingsServiceProvider"
```
Then, run the migration:

```
php artisan migrate
```

## ⚡ Usage
### Store a Setting
```
Settings::set('site_name', 'Codeminos');
```
### Retrieve a Setting
```
$siteName = Settings::get('site_name');
```

### Check if a Setting Exists
```
if (Settings::has('site_name')) {
    // Do something
}
```

### Delete a Setting
```
Settings::forget('site_name');
```

### 🛠 Configuration
The package configuration file config/settings.php allows you to define default settings and behavior.

### 🧪 Testing
To run the package tests, use:
```
composer test
```

### 📄 License
This package is open-source and licensed under the MIT License.