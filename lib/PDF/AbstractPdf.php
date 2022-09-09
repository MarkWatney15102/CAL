<?php

namespace lib\PDF;

use Dompdf\Dompdf;
use Dompdf\Options;

abstract class AbstractPdf extends Dompdf
{
    public function initPdf(): void
    {
        $options = new Options();
        $options->setIsRemoteEnabled(true);

        $this->setOptions($options);

        $this->loadHtml($this->getHtml());
    }

    public function outputPdf(): void
    {
        $this->render();
        $this->stream(
            'file.pdf',
            [
                'Attachment' => 0
            ]
        );
    }

    abstract public function getHtml(): string;
}