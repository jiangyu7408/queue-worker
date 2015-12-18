<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:30.
 */
namespace Queue\Worker\JobStatus;

use Queue\Worker\Job\JobInterface;

/**
 * Class JobStatusFactory.
 */
class JobStatusFactory
{
    /**
     * @var JobStatus
     */
    protected $prototype;

    /**
     * JobStatusFactory constructor.
     *
     * @param JobStatus $prototype
     */
    public function __construct(JobStatus $prototype)
    {
        $this->prototype = $prototype;
    }

    /**
     * @param JobInterface $job
     *
     * @return JobStatus
     */
    public function create(JobInterface $job)
    {
        assert($this->prototype instanceof JobStatus);
        $instance = clone $this->prototype;
        $instance->setToken($job->getToken());

        return $instance;
    }
}
