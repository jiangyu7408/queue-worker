<?php

/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 15:29.
 */
namespace Queue\Worker\Job;

use Queue\Worker\JobStatus\JobStatus;
use Queue\Worker\JobStatus\JobStatusFactory;
use Queue\Worker\JobStatus\Persist\JobStatusPersist;
use Queue\Worker\Worker\JobProcessor;

/**
 * Class JobTest.
 */
class JobTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function test()
    {
        $jobStatusPersist = new JobStatusPersist();
        $prototype = new JobStatus($jobStatusPersist);

        $jobStatusFactory = new JobStatusFactory($prototype);
        $processor = new JobProcessor($jobStatusFactory);

        $payload = json_encode(['time' => microtime(true)]);
        $job = (new JobBuilder())->build(new TestJob(), $payload);

        $processor->process($job);

        $jobStatus = $jobStatusFactory->create($job);
        $status = $jobStatus->getStatus();
        static::assertEquals(JobStatus::STATUS_COMPLETE, $status);
    }
}
