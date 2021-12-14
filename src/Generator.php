<?php

namespace JGI\Hogia;

use JGI\Hogia\Model\FileInfo;
use JGI\Hogia\Model\PayTypeInstruction;
use JGI\Hogia\Model\PersonSchedule;

class Generator
{
    public function createHogiaDocument(FileInfo $fileInfo, iterable $payTypeInstructions): HogiaDocument
    {
        $hogiaDocument = new HogiaDocument();

        $hogiaDocument->encoding = 'utf-8';
        $hogiaDocument->xmlVersion = '1.0';
        $hogiaDocument->formatOutput = true;

        $root = $hogiaDocument->createElement('PayRoll');
        $root->setAttributeNodeNS(new \DOMAttr('xmlns', 'http://www.hogia.se/XMLSchemas/pa'));
        $root->setAttributeNodeNS(new \DOMAttr('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance'));

        $fileInfoElement = $hogiaDocument->createElement('FileInfo');

        if ($fileInfo->getCompanyName()) {
            $fileInfoElement->appendChild($hogiaDocument->createElement('companyName', $fileInfo->getCompanyName()));
        }
        if ($fileInfo->getSoftwareProduct()) {
            $fileInfoElement->appendChild($hogiaDocument->createElement('softwareProduct', $fileInfo->getSoftwareProduct()));
        }
        if ($fileInfo->getCreatedBy()) {
            $fileInfoElement->appendChild($hogiaDocument->createElement('createdBy', $fileInfo->getCreatedBy()));
        }
        if ($fileInfo->getCreatedAt()) {
            $fileInfoElement->appendChild($hogiaDocument->createElement('createdDate', $fileInfo->getCreatedAt()->format('Y-m-d')));
        }
        if ($fileInfo->getMessage()) {
            $fileInfoElement->appendChild($hogiaDocument->createElement('message', $fileInfo->getMessage()));
        }

        $root->appendChild($fileInfoElement);

        /** @var PayTypeInstruction $payTypeInstruction */
        foreach ($payTypeInstructions as $payTypeInstruction) {
            $payTypeInstructionElement = $hogiaDocument->createElement('PayTypeInstruction');
            $payTypeInstructionElement->appendChild($hogiaDocument->createElement('employmentId', $payTypeInstruction->getEmploymentId()));
            $payTypeInstructionElement->appendChild($hogiaDocument->createElement('payTypeCode', $payTypeInstruction->getPayTypeCode()));
            $payTypeInstructionElement->appendChild($hogiaDocument->createElement('payTypeId', $payTypeInstruction->getPayTypeId()));


            if ($payTypeInstruction->getQuantity() !== null) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('quantity', $payTypeInstruction->getQuantity()));
            }
            if ($payTypeInstruction->getProject()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('project', $payTypeInstruction->getProject()));
            }
            if ($payTypeInstruction->getNote()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('note', $payTypeInstruction->getNote()));
            }
            if ($payTypeInstruction->getPeriodStartDate()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('periodStartDate', $payTypeInstruction->getPeriodStartDate()->format('Y-m-d')));
            }
            if ($payTypeInstruction->getPeriodEndDate()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('periodEndDate', $payTypeInstruction->getPeriodEndDate()->format('Y-m-d')));
            }
            if ($payTypeInstruction->isWithTime()) {
                if ($payTypeInstruction->getPeriodStartDate()) {
                    $payTypeInstructionElement->appendChild($hogiaDocument->createElement('periodStartTime', $payTypeInstruction->getPeriodStartDate()->format('H:i:s')));
                }
                if ($payTypeInstruction->getPeriodEndDate()) {
                    $payTypeInstructionElement->appendChild($hogiaDocument->createElement('periodEndTime', $payTypeInstruction->getPeriodEndDate()->format('H:i:s')));
                }
            }
            if ($payTypeInstruction->getCostCentre()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('costCentre', $payTypeInstruction->getCostCentre()));
            }
            if ($payTypeInstruction->getExtent()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('extent', $payTypeInstruction->getExtent()));
            }
            if ($payTypeInstruction->getChildName()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('childName', $payTypeInstruction->getChildName()));
            }
            if ($payTypeInstruction->getCostUnit()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('costUnit', $payTypeInstruction->getCostUnit()));
            }
            if ($payTypeInstruction->getAmount() !== null) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('amount', $payTypeInstruction->getAmount()));
            }
            if ($payTypeInstruction->getPrice() !== null) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement(
                    'price',
                    round($payTypeInstruction->getPrice() / 100, 2)
                ));
            }
            if ($payTypeInstruction->getPersonalIdentityNumber()) {
                $payTypeInstructionElement->appendChild($hogiaDocument->createElement('personalIdentityNumber', $payTypeInstruction->getPersonalIdentityNumber()));
            }

            $root->appendChild($payTypeInstructionElement);
        }

        $hogiaDocument->appendChild($root);

        return $hogiaDocument;
    }

    /**
     * @param PersonSchedule[] $personSchedules
     */
    public function createPersonSchedules(FileInfo $fileInfo, array $personSchedules): string
    {
        $string = <<<TXT
Filhuvud
Typ="Personschema"
SkapadAv="%s ;Standard"
DatumTid=#%s#

TXT;
        $string = sprintf(
            $string,
            $fileInfo->getSoftwareProduct(),
            $fileInfo->getCreatedAt()->format('Y-m-d H:i:s')
        );
        foreach ($personSchedules as $personSchedule) {
            $string .= <<<TXT
Pstart
Typ="Personschema"
Anställningsnummer=%s
StartDatum=#%s#
Längd=%s

TXT;
            $string = sprintf(
                $string,
                $personSchedule->getEmploymentId(),
                $personSchedule->getFirstPeriod()->getStart()->format('Y-m-d'),
                count($personSchedule->getPeriods())
            );

            foreach ($personSchedule->getPeriods() as $period) {
                $string .= <<<TXT
Arbetspass
StartDag=#%s#
StartTid=#%s#
SlutDag=#%s#
SlutTid=#%s#
Längd=#%s#

TXT;
                $string = sprintf(
                    $string,
                    $period->getStart()->format('Y-m-d'),
                    $period->getStart()->format('H:i'),
                    $period->getEnd()->format('Y-m-d'),
                    $period->getEnd()->format('H:i'),
                    $period->getLengthString()
                );

            }
            $string .= 'Pslut' . PHP_EOL;
        }

        return $string;
    }
}
