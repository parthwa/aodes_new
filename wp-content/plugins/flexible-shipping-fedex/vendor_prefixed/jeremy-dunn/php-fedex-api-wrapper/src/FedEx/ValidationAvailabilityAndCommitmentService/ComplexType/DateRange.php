<?php

namespace FedExVendor\FedEx\ValidationAvailabilityAndCommitmentService\ComplexType;

use FedExVendor\FedEx\AbstractComplexType;
/**
 * DateRange
 *
 * @author      Jeremy Dunn <jeremy@jsdunn.info>
 * @package     PHP FedEx API wrapper
 * @subpackage  Validation Availability And Commitment Service Service
 *
 * @property string $Begins
 * @property string $Ends
 */
class DateRange extends \FedExVendor\FedEx\AbstractComplexType
{
    /**
     * Name of this complex type
     *
     * @var string
     */
    protected $name = 'DateRange';
    /**
     * Set Begins
     *
     * @param string $begins
     * @return $this
     */
    public function setBegins($begins)
    {
        $this->values['Begins'] = $begins;
        return $this;
    }
    /**
     * Set Ends
     *
     * @param string $ends
     * @return $this
     */
    public function setEnds($ends)
    {
        $this->values['Ends'] = $ends;
        return $this;
    }
}