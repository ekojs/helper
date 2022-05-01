<?php declare(strict_types=1);

namespace EJSHelper\Tests;

use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase {
    public function testIsKabisat(): void
    {
        $this->assertEquals(1,is_kabisat(2020));
    }
}
