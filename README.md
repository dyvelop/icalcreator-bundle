[![Build Status](https://travis-ci.org/dyvelop/icalcreator-bundle.svg?branch=master)](https://travis-ci.org/dyvelop/icalcreator-bundle)

# Dyvelop iCalcreator Bundle

This bundle provides some utilities for using the iCalcreator PHP library (http://kigkonsult.se/iCalcreator/index.php) in Symfony.

## Installation

### Step 1: Download

Download via [Composer](https://getcomposer.org/)

```bash
composer require dyvelop/icalcreator-bundle
```

This project requires the packagist distribution from https://github.com/iCalcreator/iCalcreator in version 2.22.

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

## Configuration

### Unique ID

You can change the default [unique ID](http://kigkonsult.se/iCalcreator/docs/using.html#Unique_id) for calendars with following configuration.

```yml
dyvelop_icalcreator:
    default_unique_id: DyvelopICalCreatorBundle
```

### Timezone

If you want to create calendar events in a timezone with [daylight saving time](https://en.wikipedia.org/wiki/Daylight_saving_time) (or summer time), you can set a default timezone globally via config:

```yml
dyvelop_icalcreator:
    default_timezone: Europe/Berlin
```

## Usage

### Basic usage

Create a new calendar:

```php
$config = array(
    'unique_id' => 'My unique calendar name',
    'format'    => 'ical',            // or 'xcal'
    'filename'  => 'my-calendar.ics'  // or 'my-calendar.xml'
);
$calendar = $this->get('dyvelop_icalcreator.factory')->create($config);
```

Create a new calendar event:

```php
$event = $calendar->newEvent();
$event->setUid('foo');
$event->setSummary('Bar');
$event->setDtstart(2016, 10, 6, 20);
$event->setDtend(2016, 10, 6, 21);
```

See http://kigkonsult.se/iCalcreator/docs/using.html for detailed documentation of the iCalcreate PHP library.

### Render calendar via controller

After creating a calendar you can use the `CalendarResponse` to render the file in your Symfony controller.

```php
namespace AppBundle/Controller;

use Dyvelop\ICalCreatorBundle\Response\CalendarResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $calendar = $this->get('dyvelop_icalcreator.factory')->create();
        
        // add events to calendar etc.
        // ...
        
        return new CalendarResponse($calendar);
    }
}
```

### Attach calender file in mails

Using the `CalendarAttachment` class you can attach your calendar file in a Swiftmailer mail message.

```php
use  Dyvelop\ICalCreatorBundle\Mailer\CalendarAttachment;

// create a new mail message via Swiftmailer
$mailer = $this->get('mailer');
$message = $mailer->createMessage();

// create calendar
$calendar = $this->get('dyvelop_icalcreator.factory')->create();

// add events to calendar etc.
// ...

// add calender attachment
$attachment = new CalendarAttachment($calendar);
$message->attach($attachment);

// add other message configurations like subject or body
// ...

$mailer->send($message);
```
