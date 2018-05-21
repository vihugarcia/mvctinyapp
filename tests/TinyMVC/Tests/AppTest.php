<?php
namespace TinyMVC\Tests;

use PHPUnit\Framework\TestCase;
use TinyMVC\core\App;
use TinyMVC\core\Matcher;

class AppTest extends TestCase
{
    public function testNotFoundHandling()
    {
        $routes = [
            '/test' => 'App\Controllers\TestController::index',
            '/test/view/(\d+)' => 'App\Controllers\TestController::view'
        ];

        $matcher = new Matcher($routes, 'nothing');

        $app = new App($matcher);

        $response = $app->handle();

        $this->assertEquals(404, $response->getCode());
    }
}