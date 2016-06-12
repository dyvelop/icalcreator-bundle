<?php

namespace Dyvelop\ICalCreatorBundle\Factory;

use Dyvelop\ICalCreatorBundle\Component\Calendar;

/**
 * Calendar Factory
 *
 * @package Dyvelop\ICalCreatorBundle\Factory
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class Factory
{
    /**
     * @var string
     */
    protected $timezone;


    /**
     * Create new calendar
     *
     * @param array $config
     *
     * @return Calendar
     */
    public function create($config = array())
    {
        $calendar = new Calendar($config);

        if (!is_null($this->timezone)) {
            $calendar->setTimezone($this->timezone);
        }

        return $calendar;
    }


    /**
     * Set timezone
     *
     * @param string $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }
}
