<?php

namespace JGI\Hogia\Model;

class FileInfo
{
    private ?string $companyName = null;
    private ?string $softwareProduct = null;
    private ?string $createdBy = null;
    private ?\DateTimeInterface $createdAt = null;
    private ?string $message = null;

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function getSoftwareProduct(): ?string
    {
        return $this->softwareProduct;
    }

    public function setSoftwareProduct(?string $softwareProduct): void
    {
        $this->softwareProduct = $softwareProduct;
    }

    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?string $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }
}
