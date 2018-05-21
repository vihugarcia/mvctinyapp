<?php
namespace TinyMVC\Tests;

use PHPUnit\Framework\TestCase;
use TinyMVC\core\Matcher;

class MatcherTest extends TestCase
{
    public function providerTestMatchReturnsResolverParams()
    {
        return [
            ['/test/view/2', [2]],
            ['/test/view/2/3', [2, 3]]
        ];
    }

    /**
     * @dataProvider providerTestMatchReturnsResolverParams
     */
    public function testMatchReturnsResolverParams($request, $params)
    {
        $routes = [
            '/test/view/(\d+)' => 'App\Controllers\TestController::view',
            '/test/view/(\d+)/(\d+)' => 'App\Controllers\TestController::view'
        ];

        $matcher = new Matcher($routes, $request);

        $resolver = $matcher->match();

        $this->assertEquals($params, $resolver['params']);
    }
}