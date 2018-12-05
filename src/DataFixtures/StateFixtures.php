<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 06:49
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\State;

class StateFixtures extends Fixture
{

    public const STATE_RECEIVED = 'stateReceived';
    public const STATE_PROCESSING = 'stateProcessing';
    public const STATE_DONE = 'stateDone';
    public const STATE_ERROR = 'stateError';

    public function load(ObjectManager $manager)
    {
        /**
         * Load 4 event Log states
         */
        $stateReceived = new State();
        $stateReceived->setName('received');
        $manager->persist($stateReceived);
        $manager->flush();
        $this->addReference(self::STATE_RECEIVED, $stateReceived);

        $stateProcessing = new State();
        $stateProcessing->setName('processing');
        $manager->persist($stateProcessing);
        $manager->flush();
        $this->addReference(self::STATE_PROCESSING, $stateProcessing);

        $stateDone = new State();
        $stateDone->setName('done');
        $manager->persist($stateDone);
        $manager->flush();
        $this->addReference(self::STATE_DONE, $stateDone);

        $stateError = new State();
        $stateError->setName('error');
        $manager->persist($stateError);
        $manager->flush();
        $this->addReference(self::STATE_ERROR, $stateError);
    }

}
