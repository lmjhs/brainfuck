<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use BrainFuck;

class BrainFuckTest extends PHPUnit_Framework_TestCase {
    // public function testOne() {
    //     $brainFuck = new BrainFuck;
    //     $brainFuck->setInput("Codewars" . chr(255));
    //     $this->assertEquals("Codewars", $brainFuck->run(",+[-.,+]")); // Echo until byte(255) encountered
    // }

    public function testTwo() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput("Codewars" . chr(0));
        $this->assertEquals("Codewars", $brainFuck->run(",[.[-],]")); // Echo until byte(0) encountered
    }

    // public function testThree() {
    //     $brainFuck = new BrainFuck;
    //     $brainFuck->setInput(chr(8) . chr(9));
    //     $this->assertEquals(chr(72), $brainFuck->run(",>,<[>[->+>+<<]>>[-<<+>>]<<<-]>>.")); // Multiplies two numbers and returns the ASCII value of the result
    // }
}