<?php

use PHPUnit\Framework\TestCase;

class RoutesTest extends TestCase
{
    public function testHomeRouteStructure(): void
    {
        $home = Routes::$home;
        $this->assertEquals('@home', $home['id']);
        $this->assertEquals('backend', $home['route']['application']);
        $this->assertEquals('admin', $home['route']['module']);
        $this->assertEquals('index', $home['route']['method']);
    }

    public function testVhomeRouteStructure(): void
    {
        $route = Routes::$vhome;
        $this->assertEquals('@vhome', $route['id']);
        $this->assertEquals('vendedores', $route['route']['module']);
    }

    public function testAllRoutesHaveRequiredKeys(): void
    {
        $routes = [
            Routes::$home,
            Routes::$vhome,
            Routes::$uniconf,
            Routes::$tipos,
            Routes::$reporte,
            Routes::$vehlistar,
        ];

        foreach ($routes as $route) {
            $this->assertArrayHasKey('id', $route);
            $this->assertArrayHasKey('route', $route);
            $this->assertArrayHasKey('application', $route['route']);
            $this->assertArrayHasKey('module', $route['route']);
            $this->assertArrayHasKey('method', $route['route']);
        }
    }

    public function testAllRoutesUseBackendApplication(): void
    {
        $routes = [
            Routes::$home,
            Routes::$vhome,
            Routes::$uniconf,
            Routes::$tipos,
            Routes::$reporte,
            Routes::$vehlistar,
        ];

        foreach ($routes as $route) {
            $this->assertEquals('backend', $route['route']['application']);
        }
    }

    public function testRouteIdsStartWithAtSymbol(): void
    {
        $routes = [
            Routes::$home,
            Routes::$vhome,
            Routes::$uniconf,
            Routes::$tipos,
            Routes::$reporte,
            Routes::$vehlistar,
        ];

        foreach ($routes as $route) {
            $this->assertStringStartsWith('@', $route['id']);
        }
    }
}
