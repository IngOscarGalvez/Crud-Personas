<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Info extends Mailable
{
    use Queueable, SerializesModels;
    private $pdf;
    private $empresa;
    private $excel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf,$empresa)
    {
        $this->pdf=$pdf;
        $this->empresa=$empresa;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Informe Levantamiento de Requerimientos - PDFSEGTICS Soluciones SAS')
            ->markdown('email.levantamiento')
            ->attachData($this->pdf,'Levantamiento_de_Requerimientos_'.$this->empresa.'.pdf');

    }
}
