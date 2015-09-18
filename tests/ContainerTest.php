<?php

use Ronin\Container;

class ContainerTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $container = new Container();
        $container['view.paths'] = ['/view'];
        $container['view.compiled'] = '/cache';

        $this->assertSame($container, $container['container']);
        $this->assertInstanceOf('\Illuminate\Contracts\Events\Dispatcher', $container['events']);
        $this->assertInstanceOf('\Illuminate\Filesystem\Filesystem', $container['files']);
        $this->assertInstanceOf('\Illuminate\View\Compilers\BladeCompiler', $container['blade.compiler']);
        $this->assertInstanceOf('\Illuminate\View\ViewFinderInterface', $container['view.finder']);
        $this->assertInstanceOf('\Illuminate\View\Engines\EngineResolver', $container['view.engine.resolver']);
        $this->assertInstanceOf('\Illuminate\Contracts\View\Factory', $container['view']);
        $this->assertInstanceOf('\Illuminate\View\Engines\CompilerEngine', $container['view.engine.resolver']->resolve('blade'));
        $this->assertInstanceOf('\Illuminate\View\Engines\PhpEngine', $container['view.engine.resolver']->resolve('php'));
    }
}