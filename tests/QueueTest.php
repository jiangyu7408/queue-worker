<?php
/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:09.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Queue\QueueWriter;
use Queue\Worker\Token\Token;

require __DIR__.'/../vendor/autoload.php';

/**
 * Class QueueTest
 */
class QueueTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function test()
    {
        $payload = json_encode(
            [
                'uid' => 17692,
                'timestamp' => microtime(true),
            ]
        );

        $jobBuilder = new JobBuilder(new TestJob(), new Token());
        $job = $jobBuilder->build($payload);
        static::assertInstanceOf(TestJob::class, $job);

        $queueWriter = new QueueWriter();
        $queueWriter->enqueue($job);
    }
}
