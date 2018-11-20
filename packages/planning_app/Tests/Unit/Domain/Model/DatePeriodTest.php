<?php
namespace OliverHader\PlanningApp\Tests\Unit\Domain\Model;

/**
 * Test case.
 */
class DatePeriodTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \OliverHader\PlanningApp\Domain\Model\DatePeriod
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\PlanningApp\Domain\Model\DatePeriod();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getStartTimeReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getStartTime()
        );
    }

    /**
     * @test
     */
    public function setStartTimeForDateTimeSetsStartTime()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setStartTime($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'startTime',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getEndTimeReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getEndTime()
        );
    }

    /**
     * @test
     */
    public function setEndTimeForDateTimeSetsEndTime()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setEndTime($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'endTime',
            $this->subject
        );
    }
}
