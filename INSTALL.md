# Install

## Requirements

* PHP
* Composer

Check this command to check your system have installed all PHP required
modules:

```
composer check-platform-reqs
```

## Steps

1. Include this repository to the file `composer.json` of the root project:
   ```
   "require": {
           "fclopezjurado/weather-api-client-bundle": "0.1.*",
   }
   ```
   
2. Use *Composer* to add this bundle to the project dependencies:
   ```
    composer req fclopezjurado/weather-api-client-bundle
   ```
