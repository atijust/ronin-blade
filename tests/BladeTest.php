<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Ronin\Blade;

class BladeTest extends PHPUnit_Framework_TestCase
{
    public function testMake()
    {
        $blade = Blade::make('/view', '/cache');
        $this->assertSame(['/view'], $blade->getFinder()->getPaths());
        $this->assertSame(
            (new BladeCompiler(new Filesystem(), '/cache'))->getCompiledPath('test'),
            $blade->getEngineResolver()->resolve('blade')->getCompiler()->getCompiledPath('test')
        );
        $this->assertInstanceOf('\Illuminate\Contracts\Events\Dispatcher', $blade->getDispatcher());
        $this->assertInstanceOf('\Illuminate\Contracts\Container\Container', $blade->getContainer());
    }

    public function testMakeWithDispatcher()
    {
        $dispatcher = new Dispatcher();

        $blade = Blade::make('/view', '/cache', $dispatcher);
        $this->assertSame($dispatcher, $blade->getDispatcher());
    }

    public function testMakeWithContainer()
    {
        $container = new Container();

        $blade = Blade::make('/view', '/cache', null, $container);
        $this->assertSame($container, $blade->getContainer());
    }

    public function testRendering()
    {
        $blade = Blade::make(__DIR__, sys_get_temp_dir());
        $view = $blade->make('test', ['message' => 'Hello, world!']);
        $this->assertSame('Hello, world!', $view->render());
    }
}