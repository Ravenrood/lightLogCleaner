<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\EventLog;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EventLogFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var array
     */
    private $eventMethod = [
        'getDataFromExternal',
        'setDataInExternal',
        'removeDataFromExternal',
        'sleep',
    ];

    public const EVENT_LOG_1 = 'eventLog1';
    public const EVENT_LOG_2 = 'eventLog2';
    public const EVENT_LOG_3 = 'eventLog3';
    public const EVENT_LOG_4 = 'eventLog4';
    public const EVENT_LOG_5 = 'eventLog5';

    /**
     * @var array
     */
    private $state = [];

    public function getDependencies()
    {
        return array(
            StateFixtures::class
        );
    }

    /**
     * Add Event Log Fixtures to DB
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        $this->state[] = $this->getReference(StateFixtures::STATE_DONE);
        $this->state[] = $this->getReference(StateFixtures::STATE_PROCESSING);
        $this->state[] = $this->getReference(StateFixtures::STATE_RECEIVED);
        $this->state[] = $this->getReference(StateFixtures::STATE_ERROR);
        for ($i = 1; $i < 6; $i++) {
            $eventLog = new EventLog();
            $eventLog->setState($this->state[array_rand($this->state)]);
            $eventLog->setEvent($this->eventMethod[array_rand($this->eventMethod, 1)]);
            $date = new \DateTime();
            $eventLog->setEventStartDate($date);
            $eventLog->getEventEndDate($date->modify('+5 second'));
            $eventLog->setNote('note ' . $i . ' ' . mt_rand(0,100));
            $manager->persist($eventLog);
            $manager->flush();
            $this->addReference(constant("SELF::EVENT_LOG_$i"), $eventLog);
        }
    }
}
