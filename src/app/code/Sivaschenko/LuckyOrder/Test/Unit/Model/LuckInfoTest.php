<?php

namespace Sivaschenko\LuckyOrder\Test\Unit\Model;

use Sivaschenko\LuckyOrder\Model\LuckInfo;

class LuckInfoTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LuckInfo
     */
    private $luckInfo;

    protected function setUp()
    {
        $this->luckInfo = new LuckInfo();
    }

    /**
     * @param $isLucky
     * @param $amount
     * @dataProvider amountProvider
     */
    public function testIsAmountLucky($isLucky, $amount)
    {
        $this->assertEquals($isLucky, $this->luckInfo->isAmountLucky($amount));
    }

    public function amountProvider()
    {
        return [
            'lucky' => [true, 65.56],
            'not lucky' => [false, 66.56]
        ];
    }
}