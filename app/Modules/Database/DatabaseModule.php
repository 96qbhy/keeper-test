<?php
/**
 * User: qbhy
 * Date: 2018/3/7
 * Time: 上午11:11
 */

namespace App\Modules\Database;

use Dybasedev\Keeper\Http\Interfaces\WorkerHookDelegation;
use Dybasedev\Keeper\Http\Request;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Container\Container;
use Dybasedev\KeeperContracts\Module\ModuleProvider;

class DatabaseModule implements ModuleProvider
{

    public function register(Container $container)
    {
        $config = $container->make(Repository::class)->get('database');

        $db = new DB();

        array_map(function ($connectionConfig) use (&$db) {
            $db->addConnection($connectionConfig);
        }, $config['connections']);


        // Make this Capsule instance available globally via static methods... (optional)
        $db->setAsGlobal();
    }

    public function mount(Container $container)
    {
        $this->hookDelegationHandle($container);

    }

    public function hookDelegationHandle(Container $container)
    {
        /** @var WorkerHookDelegation $delegation */
        $delegation = $container->make(WorkerHookDelegation::class);

        // 开始
        $delegation->processBegin(function (Request $request) {

        });

        // 结束
        $delegation->processEnd(function (Request $request, $response) {

        });
    }
}