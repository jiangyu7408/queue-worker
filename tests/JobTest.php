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
use Queue\Worker\Token\Token;
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
        $processor = new JobProcessor();

        $payload = json_encode(['time' => microtime(true)]);
        $job = (new JobBuilder(new TestJob(), new Token()))->build($payload);

        $jobStatusFactory = new JobStatusFactory(
            new JobStatus(
                new JobStatusPersist()
            )
        );
        $jobStatus = $jobStatusFactory->create($job);
        $processor->process($job, $jobStatus);
        $status = $jobStatus->getStatus();
        static::assertEquals(JobStatus::STATUS_COMPLETE, $status);

        $jobStatus2 = $jobStatusFactory->create($job);
        $status2 = $jobStatus2->getStatus();
        static::assertEquals(JobStatus::STATUS_COMPLETE, $status2);

        static::assertNotSame($jobStatus, $jobStatus2);
    }
}
