<?php
namespace Ronin;

use Illuminate\Contracts\Container\Container as ContainerContract;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class Blade
{
    /**
     * @param string|string[] $viewPaths
     * @param string $cachePath
     * @param \Illuminate\Contracts\Events\Dispatcher $dispatcher
     * @param \Illuminate\Contracts\Container\Container $container
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\Factory
     */
    public static function make(
        $viewPaths,
        $cachePath,
        DispatcherContract $dispatcher = null,
        ContainerContract $container = null
    ) {
        $blade = new Container();

        $blade['view.paths'] = is_array($viewPaths) ? $viewPaths : [$viewPaths];

        $blade['view.compiled'] = $cachePath;

        if ($dispatcher !== null) {
            $blade->instance('events', $dispatcher);
        }

        if ($container !== null) {
            $blade->instance('container', $container);
        }

        return $blade['view'];
    }
}
