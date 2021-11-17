<?php

use JGI\Hogia\Generator;
use JGI\Hogia\HogiaDocument;
use JGI\Hogia\Model\FileInfo;
use JGI\Hogia\Model\PayTypeInstruction;
use JGI\Hogia\Model\Period;
use JGI\Hogia\Model\PersonSchedule;

final class GeneratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function it_returns_payment_document()
    {
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

        $hogiaDocument = (new Generator())->createHogiaDocument($fileInfo, [$payTypeInstruction]);
        $this->assertInstanceOf(HogiaDocument::class, $hogiaDocument);
        $this->assertXmlStringEqualsXmlFile(__DIR__ . '/expected.xml', $hogiaDocument->saveXML());
    }

    /**
     * @test
     */
    public function it_returns_person_schedule_document()
    {
        $fileInfo = new FileInfo();
        $fileInfo->setSoftwareProduct('Leanlink');
        $fileInfo->setCreatedAt(new \DateTime('2021-11-17 12:14:03'));

        $personSchedule1 = new PersonSchedule(
            '123',
            [
                new Period(new \DateTimeImmutable('2021-11-01 08:00:00'), new \DateTimeImmutable('2021-11-01 17:00:00')),
                new Period(new \DateTimeImmutable('2021-11-02 08:00:00'), new \DateTimeImmutable('2021-11-03 10:30:00')),
            ]
        );

        $personSchedule2 = new PersonSchedule(
            '456',
            [
                new Period(new \DateTimeImmutable('2021-12-01 08:00:00'), new \DateTimeImmutable('2021-12-01 08:01:00')),
            ]
        );


        $result = (new Generator())->createPersonSchedules($fileInfo, [$personSchedule1, $personSchedule2]);

        $this->assertIsString($result);
        $this->assertStringEqualsFile(__DIR__ . '/person-schedule.txt', $result);
    }
}
