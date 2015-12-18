<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 11:00.
 */
namespace Queue\Worker\Generator;

use Queue\Worker\Job\JobInterface;
use Queue\Worker\JobStatus\JobStatusFactory;
use Queue\Worker\Queue\QueueWriter;

/**
 * Class Generator.
 */
class Generator
{
    /**
     * @var JobStatusFactory
     */
    protected $jobStatusFactory;

    /**
     * JobProcessor constructor.
     *
     * @param QueueWriter      $queueWriter
     * @param JobStatusFactory $jobStatusFactory
     */
    public function __construct(QueueWriter $queueWriter, JobStatusFactory $jobStatusFactory)
    {
        $this->queueWriter = $queueWriter;
        $this->jobStatusFactory = $jobStatusFactory;
    }

    /**
     * @param JobInterface $job
     *
     * @return bool
     */
    public function generate(JobInterface $job)
    {
        $success = $this->queueWriter->enqueue($job);
        if (!$success) {
            return false;
        }

        $jobStatus = $this->jobStatusFactory->create($job);
        $jobStatus->setWaiting();

        return true;
    }
}
