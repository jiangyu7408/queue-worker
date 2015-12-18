<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:14.
 */
namespace Queue\Worker\Worker;

use Queue\Worker\Job\JobInterface;
use Queue\Worker\JobStatus\JobStatusFactory;

/**
 * Class JobProcessor.
 */
class JobProcessor
{
    /**
     * @var JobStatusFactory
     */
    protected $jobStatusFactory;

    /**
     * JobProcessor constructor.
     *
     * @param JobStatusFactory $jobStatusFactory
     */
    public function __construct(JobStatusFactory $jobStatusFactory)
    {
        $this->jobStatusFactory = $jobStatusFactory;
    }

    /**
     * @param JobInterface $job
     */
    public function process(JobInterface $job)
    {
        $jobStatus = $this->jobStatusFactory->create($job);
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
