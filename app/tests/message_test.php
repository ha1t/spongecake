<?php
class FilesTest extends PHPUnit_Framework_TestCase
{
    public function testGetDisplayMessage()
    {
        $expected = Message::getDisplayMessage();
        $actual = "Hello World.";

        $this->assertEquals($expected, $actual);
    }

}
