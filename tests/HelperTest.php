<?php declare(strict_types=1);

namespace EJSHelper\Tests;

use PHPUnit\Framework\TestCase;
use DateTimeImmutable;
use DateTimeZone;

class HelperTest extends TestCase {

    public function testIsKabisat(): void
    {
        $this->assertEquals(1,is_kabisat(2020));
    }

    public function testIDateTimesWithTimes(): void
    {
        $this->assertEquals("Minggu, 01 Mei 2022 10:34:12", IDateTimes("2022-05-01 10:34:12"));
    }

    public function testIDateTimesNoTimes(): void
    {
        $this->assertEquals("Minggu, 01 Mei 2022", IDateTimes((new DateTimeImmutable("2022-05-01", new DateTimeZone("Asia/Jakarta")))->format("Y-m-d"),false));
    }

    public function testIDateTimesWithoutParams(): void
    {
        $this->assertIsString(IDateTimes());
    }

    public function testDateDiffWithoutParams(): void
    {
	$this->assertEmpty(dateDiff());
    }

    public function testDateDiffWithParams(): void
    {
	$this->assertEquals("31 Tahun 10 Bulan 27 Hari",dateDiff((new DateTimeImmutable("1990-06-04", new DateTimeZone("Asia/Jakarta")))->format("Y-m-d"),"2022-05-01"));
	if(preg_match('/8.1/',phpversion())){
		$this->assertEquals("01 Bulan",dateDiff("2022-04-01","2022-05-01"));
	}else{
		$this->assertEquals("30 Hari",dateDiff("2022-04-01","2022-05-01"));
	}
	$this->assertEquals("01 Bulan 10 Hari",dateDiff("2022-04-01","2022-05-11"));
	$this->assertEquals("01 Tahun 02 Bulan",dateDiff("2021-03-01","2022-05-01"));
	$this->assertEquals("01 Tahun 02 Hari",dateDiff("2021-05-01","2022-05-03"));
	$this->assertEquals("12 Hari",dateDiff("2022-05-01","2022-05-13"));
	$this->assertEquals("0 Hari",dateDiff("2022-05-01","2022-05-01"));
    }
}
