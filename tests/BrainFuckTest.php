<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use BrainFuck;

class BrainFuckTest extends PHPUnit_Framework_TestCase {
    public function testOne() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput("Codewars" . chr(255));
        $this->assertEquals("Codewars", $brainFuck->run(",+[-.,+]")); // Echo until byte(255) encountered
    }

    public function testTwo() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput("Codewars" . chr(0));
        $this->assertEquals("Codewars", $brainFuck->run(",[.[-],]")); // Echo until byte(0) encountered
    }

    public function testThree() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput(chr(8) . chr(9));
        $this->assertEquals(chr(72), $brainFuck->run(",>,<[>[->+>+<<]>>[-<<+>>]<<<-]>>.")); // Multiplies two numbers and returns the ASCII value of the result
    }

    public function testFour() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput(null);
        $this->assertEquals('Hello World!', $brainFuck->run("++++++++++[>+++++++>++++++++++>+++>+<<<<-]>++.>+.+++++++..+++.>++.<<+++++++++++++++.>.+++.------.--------.>+."));
    }

    public function testFive() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput('ex37ymnirjivtu8ejor7' . chr(255));
        $this->assertEquals('ex37ymnirjivtu8ejor7', $brainFuck->run(",+[-.,+]"));
    }

    public function testSix() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput('zevc64xhtkrx7kvww95e');
        $this->assertEquals('zevc64xhtkrx7kvww95e', $brainFuck->run(",[.[-],]"));
    }

    public function testSeven() {
        $brainFuck = new BrainFuck;
        $brainFuck->setInput(chr(10));
        $this->assertEquals('1, 1, 2, 3, 5, 8, 13, 21, 34, 55', $brainFuck->run(",>+>>>>++++++++++++++++++++++++++++++++++++++++++++>++++++++++++++++++++++++++++++++<<<<<<[>[>>>>>>+>+<<<<<<<-]>>>>>>>[<<<<<<<+>>>>>>>-]<[>++++++++++[-<-[>>+>+<<<-]>>>[<<<+>>>-]+<[>[-]<[-]]>[<<[>>>+<<<-]>>[-]]<<]>>>[>>+>+<<<-]>>>[<<<+>>>-]+<[>[-]<[-]]>[<<+>>[-]]<<<<<<<]>>>>>[++++++++++++++++++++++++++++++++++++++++++++++++.[-]]++++++++++<[->-<]>++++++++++++++++++++++++++++++++++++++++++++++++.[-]<<<<<<<<<<<<[>>>+>+<<<<-]>>>>[<<<<+>>>>-]<-[>>.>.<<<[-]]<<[>>+>+<<<-]>>>[<<<+>>>-]<<[<+>-]>[<+>-]<<<-]"));
    }
}