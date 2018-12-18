<?php
namespace OliverHader\PlanningApp\Tests\Unit\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case.
 */
class VolunteerTest extends UnitTestCase
{
    /**
     * @var \OliverHader\PlanningApp\Domain\Model\Volunteer
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \OliverHader\PlanningApp\Domain\Model\Volunteer();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getUserReturnsInitialValueForInt()
    {
        self::assertSame(
            null,
            $this->subject->getUser()
        );
    }

    /**
     * @test
     */
    public function setUserForIntSetsUser()
    {
        $user = $this->prophesize(FrontendUser::class)
            ->reveal();
        $this->subject->setUser($user);

        self::assertAttributeEquals(
            $user,
            'user',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getFirstNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameForStringSetsFirstName()
    {
        $this->subject->setFirstName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'firstName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLastNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameForStringSetsLastName()
    {
        $this->subject->setLastName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lastName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getDateOfBirthReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getDateOfBirth()
        );
    }

    /**
     * @test
     */
    public function setDateOfBirthForDateTimeSetsDateOfBirth()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setDateOfBirth($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'dateOfBirth',
            $this->subject
        );
    }
}
