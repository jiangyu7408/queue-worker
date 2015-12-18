<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:14.
 */
namespace Queue\Worker\Worker;

use Queue\Worker\Job\JobInterface;
use Queue\Worker\JobStatus\JobStatus;

/**
 * Class JobProcessor.
 */
class JobProcessor
{
    /**
     * @param JobInterface $job
     * @param JobStatus    $jobStatus
     */
    public function process(JobInterface $job, JobStatus $jobStatus)
    {
        $jobStatus->setRunning();
        try {
            $job->setUp();
            $job->perform();
            $job->tearDown();
        } catch (\Exception $exception) {
            $jobStatus->setFailed();

            return;
        }
        $jobStatus->setComplete();
    }
}
