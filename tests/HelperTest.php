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
            $this->assertEquals("01 Bulan 10 Hari",dateDiff("2022-04-01","2022-05-11"));
            $this->assertEquals("01 Tahun 02 Hari",dateDiff("2021-05-01","2022-05-03"));
            $this->assertEquals("12 Hari",dateDiff("2022-05-01","2022-05-13"));
            $this->assertEquals("01 Tahun 02 Bulan",dateDiff("2021-03-01","2022-05-01"));
        }else{
            $this->assertEquals("30 Hari",dateDiff("2022-04-01","2022-05-01"));
            $this->assertEquals("01 Bulan 09 Hari",dateDiff("2022-04-01","2022-05-11"));
            $this->assertEquals("01 Tahun 02 Hari",dateDiff("2021-05-01","2022-05-03"));
            $this->assertEquals("12 Hari",dateDiff("2022-05-01","2022-05-13"));
            $this->assertEquals("01 Tahun 02 Bulan 02 Hari",dateDiff("2021-03-01","2022-05-01"));

        }
        $this->assertEquals("0 Hari",dateDiff("2022-05-01","2022-05-01"));
    }

    public function testGetClientIp(): void
    {
        $this->assertEquals("UNKNOWN",getClientIp());
        putenv('HTTP_CLIENT_IP=127.0.0.1');
        $this->assertEquals("127.0.0.1",getClientIp());
        putenv('HTTP_CLIENT_IP');
        putenv('HTTP_X_FORWARDED_FOR=127.0.0.1');
        $this->assertEquals("127.0.0.1",getClientIp());
        putenv('HTTP_X_FORWARDED_FOR');
        putenv('HTTP_X_FORWARDED=127.0.0.1');
        $this->assertEquals("127.0.0.1",getClientIp());
        putenv('HTTP_X_FORWARDED');
        putenv('HTTP_FORWARDED_FOR=127.0.0.1');
        $this->assertEquals("127.0.0.1",getClientIp());
        putenv('HTTP_FORWARDED_FOR');
        putenv('HTTP_FORWARDED=127.0.0.1');
        $this->assertEquals("127.0.0.1",getClientIp());
        putenv('HTTP_FORWARDED');
        putenv('REMOTE_ADDR=127.0.0.1');
        $this->assertEquals("127.0.0.1",getClientIp());
    }

    public function testUuid_v3(): void
    {
        $this->assertEquals("eb83e28d-ab7e-3ad7-8d7e-8caeb9eedc37",uuid_v3("a7950197-cac7-4cd5-b29f-31c45bc1341f","ekojunaidisalam.com"));
    }

    public function testUuid_v4(): void
    {
        $this->assertTrue(is_valid_uuid(uuid_v4()));
    }

    public function testUuid_v5(): void
    {
        $this->assertEquals("0459d018-0a8e-5d72-89be-dffcd96c7dad",uuid_v5("a7950197-cac7-4cd5-b29f-31c45bc1341f","ekojunaidisalam.com"));
    }

    public function testSetMyHeaderNull(): void
    {
        $this->assertEquals(200,setMyHeader()->code);
        $this->assertEquals("OK",setMyHeader()->text);
        $this->assertEquals('{"code":200,"status":"OK"}',setMyHeader()->json);
    }

    public function testSetMyHeaderInvalid(): void
    {
        // $this->expectExceptionMessageMatches("/Unknown http status code/");
        $this->assertNull(setMyHeader(99));
    }

    public function testSetMyHeaderCode(): void
    {
        $this->assertEquals(100,setMyHeader(100)->code);
        $this->assertEquals(101,setMyHeader(101)->code);
        $this->assertEquals(200,setMyHeader(200)->code);
        $this->assertEquals(201,setMyHeader(201)->code);
        $this->assertEquals(202,setMyHeader(202)->code);
        $this->assertEquals(203,setMyHeader(203)->code);
        $this->assertEquals(204,setMyHeader(204)->code);
        $this->assertEquals(205,setMyHeader(205)->code);
        $this->assertEquals(206,setMyHeader(206)->code);
        $this->assertEquals(300,setMyHeader(300)->code);
        $this->assertEquals(301,setMyHeader(301)->code);
        $this->assertEquals(302,setMyHeader(302)->code);
        $this->assertEquals(303,setMyHeader(303)->code);
        $this->assertEquals(304,setMyHeader(304)->code);
        $this->assertEquals(305,setMyHeader(305)->code);
        $this->assertEquals(400,setMyHeader(400)->code);
        $this->assertEquals(401,setMyHeader(401)->code);
        $this->assertEquals(402,setMyHeader(402)->code);
        $this->assertEquals(403,setMyHeader(403)->code);
        $this->assertEquals(404,setMyHeader(404)->code);
        $this->assertEquals(405,setMyHeader(405)->code);
        $this->assertEquals(406,setMyHeader(406)->code);
        $this->assertEquals(407,setMyHeader(407)->code);
        $this->assertEquals(408,setMyHeader(408)->code);
        $this->assertEquals(409,setMyHeader(409)->code);
        $this->assertEquals(410,setMyHeader(410)->code);
        $this->assertEquals(411,setMyHeader(411)->code);
        $this->assertEquals(412,setMyHeader(412)->code);
        $this->assertEquals(413,setMyHeader(413)->code);
        $this->assertEquals(414,setMyHeader(414)->code);
        $this->assertEquals(415,setMyHeader(415)->code);
        $this->assertEquals(500,setMyHeader(500)->code);
        $this->assertEquals(501,setMyHeader(501)->code);
        $this->assertEquals(502,setMyHeader(502)->code);
        $this->assertEquals(503,setMyHeader(503)->code);
        $this->assertEquals(504,setMyHeader(504)->code);
        $this->assertEquals(505,setMyHeader(505)->code);
        $this->assertEquals(600,setMyHeader(600)->code);
    }

    public function testSetMyHeaderText(): void
    {
        $this->assertEquals("Continue",setMyHeader(100)->text);
        $this->assertEquals("Switching Protocols",setMyHeader(101)->text);
        $this->assertEquals("OK",setMyHeader(200)->text);
        $this->assertEquals("Created",setMyHeader(201)->text);
        $this->assertEquals("Accepted",setMyHeader(202)->text);
        $this->assertEquals("Non-Authoritative Information",setMyHeader(203)->text);
        $this->assertEquals("No Content",setMyHeader(204)->text);
        $this->assertEquals("Reset Content",setMyHeader(205)->text);
        $this->assertEquals("Partial Content",setMyHeader(206)->text);
        $this->assertEquals("Multiple Choices",setMyHeader(300)->text);
        $this->assertEquals("Moved Permanently",setMyHeader(301)->text);
        $this->assertEquals("Moved Temporarily",setMyHeader(302)->text);
        $this->assertEquals("See Other",setMyHeader(303)->text);
        $this->assertEquals("Not Modified",setMyHeader(304)->text);
        $this->assertEquals("Use Proxy",setMyHeader(305)->text);
        $this->assertEquals("Bad Request",setMyHeader(400)->text);
        $this->assertEquals("Unauthorized",setMyHeader(401)->text);
        $this->assertEquals("Payment Required",setMyHeader(402)->text);
        $this->assertEquals("Forbidden",setMyHeader(403)->text);
        $this->assertEquals("Not Found",setMyHeader(404)->text);
        $this->assertEquals("Method Not Allowed",setMyHeader(405)->text);
        $this->assertEquals("Not Acceptable",setMyHeader(406)->text);
        $this->assertEquals("Proxy Authentication Required",setMyHeader(407)->text);
        $this->assertEquals("Request Time-out",setMyHeader(408)->text);
        $this->assertEquals("Conflict",setMyHeader(409)->text);
        $this->assertEquals("Gone",setMyHeader(410)->text);
        $this->assertEquals("Length Required",setMyHeader(411)->text);
        $this->assertEquals("Precondition Failed",setMyHeader(412)->text);
        $this->assertEquals("Request Entity Too Large",setMyHeader(413)->text);
        $this->assertEquals("Request-URI Too Large",setMyHeader(414)->text);
        $this->assertEquals("Unsupported Media Type",setMyHeader(415)->text);
        $this->assertEquals("Internal Server Error",setMyHeader(500)->text);
        $this->assertEquals("Not Implemented",setMyHeader(501)->text);
        $this->assertEquals("Bad Gateway",setMyHeader(502)->text);
        $this->assertEquals("Service Unavailable",setMyHeader(503)->text);
        $this->assertEquals("Gateway Time-out",setMyHeader(504)->text);
        $this->assertEquals("HTTP Version not supported",setMyHeader(505)->text);
        $this->assertEquals("Database Unavailable",setMyHeader(600)->text);
    }
}
