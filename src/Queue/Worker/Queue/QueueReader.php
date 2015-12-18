<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 11:11.
 */
namespace Queue\Worker\Queue;

use Queue\Worker\Job\JobInterface;
use Queue\Worker\Job\TestJob;

/**
 * Class QueueReader.
 */
class QueueReader
{
    /**
     * @return JobInterface
     */
    public function dequeue()
    {
        return new TestJob();
    }
}
