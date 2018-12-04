<?php
namespace OliverHader\PlanningApp\ViewHelpers\Activity;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractConditionViewHelper;

/***
 * This file is part of the "Planning App" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 ***/

/**
 * <planning:activity.ifSubscribed volunteer="{volunteer}"></planning:activity.ifSubscribed>
 */
class IfSubscribedViewHelper extends AbstractConditionViewHelper
{
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument(
            'activity',
            \OliverHader\PlanningApp\Domain\Model\Activity::class,
            'Activity to be used',
            true
        );
        $this->registerArgument(
            'volunteer',
            \OliverHader\PlanningApp\Domain\Model\Volunteer::class,
            'Volunteer to be used',
            true
        );
    }

    /**
     * @param null|array $arguments
     * @return bool
     */
    protected static function evaluateCondition($arguments = null): bool
    {
        /** @var \OliverHader\PlanningApp\Domain\Model\Activity $activity */
        $activity = $arguments['activity'];
        /** @var \OliverHader\PlanningApp\Domain\Model\Volunteer $volunteer */
        $volunteer = $arguments['volunteer'];

        return $activity->getVolunteers()->offsetExists($volunteer);
    }
}
