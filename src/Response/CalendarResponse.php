<?php

namespace Dyvelop\ICalCreatorBundle\Response;

use Dyvelop\ICalCreatorBundle\Component\Calendar;
use Symfony\Component\HttpFoundation\Response;

/**
 * Represents a HTTP response for a calendar file download
 *
 * @package Dyvelop\ICalCreatorBundle\Response
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class CalendarResponse extends Response
{
    /**
     * Calendar
     *
     * @var Calendar
     */
    protected $calendar;


    /**
     * Construct calendar response
     *
     * @param Calendar $calendar Calendar
     * @param int      $status   Response status
     * @param array    $headers  Response headers
     */
    public function __construct(Calendar $calendar, $status = 200, $headers = array())
    {
        $this->calendar = $calendar;

        // convert to UTF-8
        $content = $calendar->createCalendar();
        if (!mb_check_encoding($content, 'UTF-8')) {
            $content = utf8_encode($content);
        }

        $headers = array_merge($this->getDefaultHeaders(), $headers);
        parent::__construct($content, $status, $headers);
    }


    /**
     * Get default response headers for a calendar
     *
     * @return array
     */
    protected function getDefaultHeaders()
    {
        $headers = array();

        $mimeType = $this->calendar->getContentType();
        $headers['Content-Type'] = sprintf('%s; charset=utf-8', $mimeType);

        $filename = $this->calendar->getConfig('filename');
        $headers['Content-Disposition'] = sprintf('attachment; filename="%s', $filename);

        return $headers;
    }
}
