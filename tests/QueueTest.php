<?php
/**
 * Created by PhpStorm.
 * User: Jiang Yu
 * Date: 2015/12/18
 * Time: 10:09.
 */
namespace Queue\Worker\Job;

use Queue\Worker\Queue\QueueWriter;

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
        $payload = [
            'uid' => 17692,
            'timestamp' => microtime(true),
        ];
        $job = new TestJob(json_encode($payload));

        $queueWriter = new QueueWriter();
        $queueWriter->enqueue($job);
    }
}
