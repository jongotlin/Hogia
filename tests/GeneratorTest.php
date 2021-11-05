<?php

use JGI\Hogia\Generator;
use JGI\Hogia\Model\FileInfo;
use JGI\Hogia\Model\PayTypeInstruction;

final class GeneratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shouldReturnHogiaDocument()
    {
        $generator = new Generator();

        $fileInfo = new FileInfo();
        $fileInfo->setCompanyName('Hogia Test AB');
        $fileInfo->setSoftwareProduct('Leanlink');
        $fileInfo->setCreatedBy('Jon');
        $fileInfo->setCreatedAt(new \DateTime('2021-11-05 12:03:34'));
        $fileInfo->setMessage('Meddelande 1');

        $payTypeInstruction = new PayTypeInstruction('101', 'L', '10');
        $payTypeInstruction->setQuantity(1.1);
        $payTypeInstruction->setProject('project');
        $payTypeInstruction->setNote('note');
        $payTypeInstruction->setPeriodStartDate(new \DateTimeImmutable('2021-11-05 19:00:00'));
        $payTypeInstruction->setPeriodEndDate(new \DateTimeImmutable('2021-11-06 02:30:00'));
        $payTypeInstruction->setWithTime(true);
        $payTypeInstruction->setCostCentre('cost centre');
        $payTypeInstruction->setExtent('extent');
        $payTypeInstruction->setChildName('child name');
        $payTypeInstruction->setCostUnit('cost unit');
        $payTypeInstruction->setAmount(2.2);
        $payTypeInstruction->setPrice(100);
        $payTypeInstruction->setPersonalIdentityNumber('personal identity number');

        $hogiaDocument = $generator->createHogiaDocument($fileInfo, [$payTypeInstruction]);
        $this->assertInstanceOf(\JGI\Hogia\HogiaDocument::class, $hogiaDocument);
        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/expected.xml', $hogiaDocument->saveXML());
    }
}
