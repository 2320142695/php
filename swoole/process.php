<?php

/*
 *
 * (c) cxx <cxx2320@foxmail>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 *
 */

use Swoole\Process;

for ($n = 1; $n <= 3; ++$n) {
    $process = new Process(function () use ($n) {
        echo 'Child #' . getmypid() . " start and sleep {$n}s" . PHP_EOL;
        sleep($n);
        echo 'Child #' . getmypid() . ' exit' . PHP_EOL;
    });
    $process->start();
}
// for ($n = 3; $n--;) {
//     $status = Process::wait(true);
//     echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
// }
while ($status = Process::wait(true)) {
    echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
}
echo 'Parent #' . getmypid() . ' exit' . PHP_EOL;
