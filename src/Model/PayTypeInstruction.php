<?php

namespace JGI\Hogia\Model;

class PayTypeInstruction
{
    private string $employmentId;
    private string $payTypeCode;
    private string $payTypeId;
    private ?float $quantity = null;
    private ?string $project = null;
    private ?string $note = null;
    private ?\DateTimeInterface $periodStartDate = null;
    private ?\DateTimeInterface $periodEndDate = null;
    private bool $withTime = false;
    private ?string $costCentre = null;
    private ?string $extent = null;
    private ?string $childName = null;
    private ?string $costUnit = null;
    private ?float $amount = null;
    private ?int $price = null;
    private ?string $personalIdentityNumber = null;

    public function __construct(string $employmentId, string $payTypeCode, string $payTypeId)
    {
        $this->employmentId = $employmentId;
        $this->payTypeCode = $payTypeCode;
        $this->payTypeId = $payTypeId;
    }

    public function getEmploymentId(): string
    {
        return $this->employmentId;
    }

    public function getPayTypeCode(): string
    {
        return $this->payTypeCode;
    }

    public function getPayTypeId(): string
    {
        return $this->payTypeId;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(?string $project): void
    {
        $this->project = $project;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): void
    {
        $this->note = $note;
    }

    public function getPeriodStartDate(): ?\DateTimeInterface
    {
        return $this->periodStartDate;
    }

    public function setPeriodStartDate(?\DateTimeInterface $periodStartDate): void
    {
        $this->periodStartDate = $periodStartDate;
    }

    public function getPeriodEndDate(): ?\DateTimeInterface
    {
        return $this->periodEndDate;
    }

    public function setPeriodEndDate(?\DateTimeInterface $periodEndDate): void
    {
        $this->periodEndDate = $periodEndDate;
    }

    public function isWithTime(): bool
    {
        return $this->withTime;
    }

    public function setWithTime(bool $withTime): void
    {
        $this->withTime = $withTime;
    }

    public function getCostCentre(): ?string
    {
        return $this->costCentre;
    }

    public function setCostCentre(?string $costCentre): void
    {
        $this->costCentre = $costCentre;
    }

    public function getExtent(): ?string
    {
        return $this->extent;
    }

    public function setExtent(?string $extent): void
    {
        $this->extent = $extent;
    }

    public function getChildName(): ?string
    {
        return $this->childName;
    }

    public function setChildName(?string $childName): void
    {
        $this->childName = $childName;
    }

    public function getCostUnit(): ?string
    {
        return $this->costUnit;
    }

    public function setCostUnit(?string $costUnit): void
    {
        $this->costUnit = $costUnit;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): void
    {
        $this->amount = $amount;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    public function getPersonalIdentityNumber(): ?string
    {
        return $this->personalIdentityNumber;
    }

    public function setPersonalIdentityNumber(?string $personalIdentityNumber): void
    {
        $this->personalIdentityNumber = $personalIdentityNumber;
    }
}
