<?php

namespace Nickel\Hydrator\Strategy;

use DateTime;
use Zend\Stdlib\Hydrator\Strategy\DefaultStrategy;

class DateTimeStrategy extends DefaultStrategy
{
    /**
     * Datetime format 
     */
    private $format;
    
    /**
     * Constructor
     * @param type $format
     */
    public function __construct($format = 'Y-m-d') {
        $this->format = $format;
    }
    
    /**
     * Convert a string value into a DateTime object
     */
    public function hydrate($value)
    {
        if (is_string($value)) {
            $value = DateTime::createFromFormat($this->format, $value);
        }
        return $value;
    }
  
    /**
     * Convert a DateTime object into a string value
     */
    public function extract($value)
    {
        if ($value instanceof DateTime) {
            $value = $value->format($this->format);
        }
        return $value;
    }
}