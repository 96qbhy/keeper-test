<?php

use App\Database\Connections\ConnectionPool;
use App\Http\Service;
use Dybasedev\Keeper\Http\ProcessKernels\KeeperKernel;
use Dybasedev\Keeper\Server\HttpServer;

require __DIR__ . '/vendor/autoload.php';

// 创建服务器调度内核
$kernel = new KeeperKernel(
// 创建 HTTP 服务逻辑
    new Service([
        'base' => __DIR__,
        'config' => __DIR__ . DIRECTORY_SEPARATOR . 'config',
    ])
);

// 创建 HTTP 服务器
$server = new HttpServer($kernel);

$pid_file = __DIR__ . '/temp/keeper.pid';
// 对服务器的额外选项设置
$server->host('0.0.0.0')
    ->port(8089)
    ->ssl(false)
    ->setting([           // Swoole 的配置选项，更多请参考 https://wiki.swoole.com/wiki/page/274.html
        'daemonize' => true,              // 开启守护进程
        'pid_file' => $pid_file,  // 设置 PID 文件
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

function stop($pid_file)
{
    if (is_file($pid_file)) {
        posix_kill(file_get_contents($pid_file), SIGKILL);  // 启动服务器
        unlink($pid_file);
    }
}

