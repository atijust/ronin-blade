<?php

use Illuminate\Container\Container;
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
    }

    public function testMakeWithContainer()
    {
        $container = new Container();

        $blade = Blade::make('/view', '/cache', $container);
        $this->assertSame($container, $blade->getContainer());
    }

    public function testRendering()
    {
        $blade = Blade::make(__DIR__, sys_get_temp_dir());
        $view = $blade->make('test', ['message' => 'Hello, world!']);
        $this->assertSame('Hello, world!', $view->render());
    }
}