<?php

namespace Dyvelop\ICalCreatorBundle\Component;

/**
 * Calendar component
 * Extends original vCalendar component with some utility functions
 *
 * @package Dyvelop\ICalCreatorBundle\Component
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class Calendar extends \vcalendar
{
    /**
     * @var string
     */
    protected $timezone;


    /**
     * Get content type
     *
     * @return string
     */
    public function getContentType()
    {
        if ($this->format == 'xcal') {
            return 'application/calendar+xml';
        } else {
            return 'text/calendar';
        }
    }


    /**
     * Create new event for calendar
     *
     * @return \vevent
     */
    public function newEvent()
    {
        return $this->newComponent('VEVENT');
    }


    /**
     * Set timezone, when Non-UTC
     *
     * @see http://kigkonsult.se/iCalcreator/docs/using.html#createTimezone
     *
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        $this->setConfig('TZID', $timezone);
        $this->setProperty('X-WR-TIMEZONE', $timezone);
    }


    /**
     * Create calendar
     * Adds timezone component, when not already done
     *
     * @see http://kigkonsult.se/iCalcreator/docs/using.html#createTimezone
     *
     * @return string
     */
    public function createCalendar()
    {
        // add timezone component
        if ($this->timezone && $this->getComponent('VTIMEZONE') === false) {
            $xprops = array('X-LIC-LOCATION' => $this->timezone);
            \iCalUtilityFunctions::createTimezone($this, $this->timezone, $xprops);
        }

        return parent::createCalendar();
    }
}
