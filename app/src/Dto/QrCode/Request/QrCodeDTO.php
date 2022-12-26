<?php

namespace App\Dto\QrCode\Request;;

use Symfony\Component\Validator\Constraints as Assert;

class QrCodeDTO
{

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/[\/]+/',
        message: 'QR код содержит недопустимые символы: "/"',
        htmlPattern: null,
        match: false,
    )]
    public string $qrCode;

    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode): void
    {
        $this->qrCode = $qrCode;
    }
}
