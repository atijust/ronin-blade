<?php
namespace Ronin;

use Illuminate\Contracts\Container\Container as ContainerContract;

class Blade
{
    /**
     * @param string|string[] $viewPaths
     * @param string $cachePath
     * @param \Illuminate\Contracts\Container\Container $container
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\Factory
     */
    public static function make(
        $viewPaths,
        $cachePath,
        ContainerContract $container = null
    ) {
        $blade = new Container();

        $blade['view.paths'] = is_array($viewPaths) ? $viewPaths : [$viewPaths];

        $blade['view.compiled'] = $cachePath;

        if ($container !== null) {
            $blade->instance('container', $container);
        }

        return $blade['view'];
    }
}
