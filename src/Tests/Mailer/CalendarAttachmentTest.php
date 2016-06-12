<?php

namespace Dyvelop\ICalCreatorBundle\Tests\Mailer;

use Dyvelop\ICalCreatorBundle\Component\Calendar;
use Dyvelop\ICalCreatorBundle\Mailer\CalendarAttachment;
use Dyvelop\ICalCreatorBundle\Tests\CalendarTestCase;

/**
 * Tests for the calendar response
 *
 * @package Dyvelop\ICalCreatorBundle\Tests\Mailer
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class CalendarAttachmentTest extends CalendarTestCase
{
    /**
     * Testing calendar attachment
     *
     * @param Calendar $calendar
     *
     * @dataProvider getCalendarTestData
     */
    public function testCalendarAttachment(Calendar $calendar)
    {
        $attachment = new CalendarAttachment($calendar);

        $this->assertInstanceOf('Swift_Attachment', $attachment);
        $this->assertInstanceOf('Dyvelop\ICalCreatorBundle\Mailer\CalendarAttachment', $attachment);

        $this->assertEquals($calendar->createCalendar(), $attachment->getBody());
        $this->assertEquals($calendar->getConfig('filename'), $attachment->getFilename());
        $this->assertEquals($calendar->getContentType(), $attachment->getContentType());
    }
}
