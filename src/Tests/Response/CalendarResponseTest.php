<?php

namespace Dyvelop\ICalCreatorBundle\Tests\Response;

use Dyvelop\ICalCreatorBundle\Component\Calendar;
use Dyvelop\ICalCreatorBundle\Response\CalendarResponse;
use Dyvelop\ICalCreatorBundle\Tests\CalendarTestCase;

/**
 * Tests for CalendarResponse
 *
 * @package Dyvelop\ICalCreatorBundle\Tests\Response
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class CalendarResponseTest extends CalendarTestCase
{
    /**
     * Testing calendar response
     *
     * @param Calendar $calendar Calendar
     * @param array    $headers  Additional response headers
     *
     * @dataProvider getCalendarTestData
     */
    public function testCalendarResponse(Calendar $calendar, $headers = array())
    {
        $response = new CalendarResponse($calendar, 200, $headers);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Response', $response);
        $this->assertInstanceOf('Dyvelop\ICalCreatorBundle\Response\CalendarResponse', $response);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertEquals($calendar->createCalendar(), $response->getContent());

        foreach ($headers as $key => $value) {
            $this->assertEquals($value, $response->headers->get($key));
        }

        $this->assertContains($calendar->getContentType(), $response->headers->get('Content-Type'));
        $this->assertContains($calendar->getConfig('filename'), $response->headers->get('Content-Disposition'));
    }
}
