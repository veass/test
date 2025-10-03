<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/main.php';

class ReverseLettersTest extends TestCase
{
    public function testTz(): void
    {
        $this->assertEquals('tac', main::run('cat'));
        $this->assertEquals('Tac', main::run('Cat'));
        $this->assertEquals('esuOh', main::run('houSe'));
        $this->assertEquals('tnAhPele', main::run('elEpHant'));
        $this->assertEquals('Ьшым', main::run('Мышь'));
        $this->assertEquals('кимОД', main::run('домИК'));
        $this->assertEquals('tac,', main::run('cat,'));
        $this->assertEquals('Амиз:', main::run('Зима:'));
        $this->assertEquals("si 'dloc' won", main::run("is 'cold' now"));
        $this->assertEquals('отэ «Кат» "отсорп"', main::run('это «Так» "просто"'));
        $this->assertEquals('driht-trap', main::run('third-part'));
        $this->assertEquals('nac`t', main::run("can`t"));
        $this->assertEquals('nAc`t', main::run("cAn`t"));
    }

}
