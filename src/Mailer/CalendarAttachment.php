<?php

namespace Dyvelop\ICalCreatorBundle\Mailer;

use Dyvelop\ICalCreatorBundle\Component\Calendar;

/**
 * Calendar attachment for Swift mailer messages
 *
 * @package Dyvelop\ICalCreatorBundle\Mailer
 * @author  Franziska Dyckhoff <fdyckhoff@dyvelop.de>
 */
class CalendarAttachment extends \Swift_Attachment
{
    /**
     * Calendar attachment constructor
     *
     * @param Calendar $calendar
     */
    public function __construct(Calendar $calendar)
    {
        $data = $calendar->createCalendar();
        $filename = $calendar->getConfig('filename');
        $contentType = $calendar->getContentType();
        
        parent::__construct($data, $filename, $contentType);
    }
}
