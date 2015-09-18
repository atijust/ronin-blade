<?php
namespace Ronin;

use Illuminate\Container\Container as BaseContainer;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class Container extends BaseContainer
{
    public function __construct()
    {
        $this->instance('container', $this);

        $this->singleton('events', function () {
            return new Dispatcher();
        });

        $this->singleton('files', function () {
            return new Filesystem();
        });

        $this->singleton('blade.compiler', function () {
            return new BladeCompiler($this['files'], $this['view.compiled']);
        });

        $this->singleton('view.finder', function () {
            return new FileViewFinder($this['files'], $this['view.paths']);
        });

        $this->singleton('view.engine.resolver', function () {
            $resolver = new EngineResolver();

            $resolver->register('blade', function () {
                return new CompilerEngine($this['blade.compiler'], $this['files']);
            });

            $resolver->register('php', function () {
                return new PhpEngine();
            });

            return $resolver;
        });

        $this->singleton('view', function () {
            $env = new Factory($this['view.engine.resolver'], $this['view.finder'], $this['events']);
            $env->setContainer($this['container']);
            return $env;
        });
    }
}