<?php

require __DIR__ . '/vendor/autoload.php';

use App\Exceptions\Handler;
use App\Http\Service;
use Dybasedev\Keeper\Http\ProcessKernels\KeeperKernel;
use Dybasedev\Keeper\Server\HttpServer;


//register_shutdown_function('keeper_error_handler');
set_error_handler('keeper_error_handler');

try {

    // 创建服务器调度内核
    $kernel = new KeeperKernel(
    // 创建 HTTP 服务逻辑
        (new Service([
            'base'   => __DIR__,
            'config' => __DIR__ . DIRECTORY_SEPARATOR . 'config',
        ]))->setExceptionHandler(new Handler())
    );

    // 创建 HTTP 服务器
    $server = new HttpServer($kernel);

    $pid_file = __DIR__ . '/temp/keeper.pid';
    // 对服务器的额外选项设置
    $server->host('0.0.0.0')
           ->port(8089)
           ->ssl(false)
           ->setting([           // Swoole 的配置选项，更多请参考 https://wiki.swoole.com/wiki/page/274.html
                                 'daemonize'  => false,              // 开启守护进程
                                 'pid_file'   => $pid_file,  // 设置 PID 文件
                                 'worker_num' => 4,
           ]);

    $action = $argv[1] ?? 'start';

    switch ($action) {
        case 'start':
            $server->start();  // 启动服务器
            break;
        case 'stop':
            stop($pid_file);
            break;
        case 'restart':
            stop($pid_file);
            sleep(1);
            $server->start();
            break;
    }

} catch (Throwable $throwable) {
    print_r($throwable);
    die(1);
}
