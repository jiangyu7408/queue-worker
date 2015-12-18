<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 11:10.
 */
namespace Queue\Worker\Worker;

use Queue\Worker\Queue\QueueReader;

/**
 * Class JobManager.
 */
class JobManager
{
    /**
     * JobManager constructor.
     *
     * @param QueueReader $queueReader
     */
    public function __construct(QueueReader $queueReader)
    {
        $this->queueReader = $queueReader;
    }

    /**
     * @return \Queue\Worker\Job\JobInterface
     */
    public function waitForJob()
    {
        $job = $this->queueReader->dequeue();

        return $job;
    }
}
