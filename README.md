# Dyvelop iCalcreator Bundle

Symfony bundle for creating iCal formatted files, using the iCalcreator PHP library (http://kigkonsult.se/iCalcreator/index.php)

## Installation

### Step 1: Download

Download via [Composer](https://getcomposer.org/)

```bash
composer require dyvelop/icalcreator-bundle
```

This project requires the packagist distribution from https://github.com/iCalcreator/iCalcreator which is currently only available in the `dev-master` branch. (which is equals to version 2.22 from http://kigkonsult.se/iCalcreator/index.php)
Because there isn't any tagged version yet, you may need to change the minimal stability to "dev" in the `composer.json` of your Symfony project:

```
{
  ...
  "minimum-stability": "dev"
}
```

### Step 2: Enable Bundle

Enable the Bundle in the `app/AppKernel.php` file in your Symfony project:

```php
// File: app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new \Dyvelop\ICalCreatorBundle\DyvelopICalCreatorBundle(),
        );
        
        // ...
        
        return $bundles;
    }
    
    // ...
}
```

