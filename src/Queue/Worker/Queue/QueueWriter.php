<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 11:06.
 */
namespace Queue\Worker\Queue;

use Queue\Worker\Job\JobInterface;

/**
 * Class QueueWriter.
 */
class QueueWriter
{
    /**
     * @param JobInterface $job
     *
     * @return bool
     */
    public function enqueue(JobInterface $job)
    {
    }
}
