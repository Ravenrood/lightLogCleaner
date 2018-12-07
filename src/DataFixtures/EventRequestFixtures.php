<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\EventRequest;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class EventRequestFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var array
     */
    private $eventRequestMethod = [
        'add',
        'remove',
        'replace',
        'wait',
    ];

    /**
     * @var array
     */
    private $state = [];

    /**
     * @var array
     */
    private $event = [];

    public function getDependencies()
    {
        return array(
            StateFixtures::class,
            EventLogFixtures::class
        );
    }

    /**
     * Add Event Request Fixtures to DB
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->state[] = $this->getReference(StateFixtures::STATE_DONE);
        $this->state[] = $this->getReference(StateFixtures::STATE_PROCESSING);
        $this->state[] = $this->getReference(StateFixtures::STATE_RECEIVED);
        $this->state[] = $this->getReference(StateFixtures::STATE_ERROR);

        $this->event[] = $this->getReference(EventLogFixtures::EVENT_LOG_1);
        $this->event[] = $this->getReference(EventLogFixtures::EVENT_LOG_2);
        $this->event[] = $this->getReference(EventLogFixtures::EVENT_LOG_3);
        $this->event[] = $this->getReference(EventLogFixtures::EVENT_LOG_4);
        $this->event[] = $this->getReference(EventLogFixtures::EVENT_LOG_5);

        for ($i = 1; $i < 6; $i++) {
            $eventRequest = new EventRequest();
            $eventRequest->setState($this->state[array_rand($this->state)]);
            $eventRequest->setRequest($this->eventRequestMethod[array_rand($this->eventRequestMethod, 1)]);
            $eventRequest->setResponse('response ' . $i . ' ' . mt_rand(0,100));
            $eventRequest->setNote('note ' . $i . ' ' . mt_rand(0,100));
            $eventRequest->setEventLog($this->event[array_rand($this->event, 1)]);
            $manager->persist($eventRequest);
            $manager->flush();
        }
    }
}