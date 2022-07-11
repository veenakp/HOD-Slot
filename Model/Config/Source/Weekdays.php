<?php
/**
 * @package HOD_Slot
 */
declare(strict_types=1);

namespace HOD\Slot\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Weekdays implements OptionSourceInterface
{
    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'Sunday', 'label' => 'Sunday'],
            ['value' => 'Monday', 'label' => 'Monday'],
            ['value' => 'Tuesday', 'label' => 'Tuesday'],
            ['value' => 'Wednesday', 'label' => 'Wednesday'],
            ['value' => 'Thursday', 'label' => 'Thursday'],
            ['value' => 'Friday', 'label' => 'Friday'],
            ['value' => 'Saturday', 'label' => 'Saturday']
        ];
    }
}
