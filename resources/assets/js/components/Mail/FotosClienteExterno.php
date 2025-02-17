<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FotosClienteExterno extends Mailable
{
    use Queueable, SerializesModels;



    public $datos;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct ($datos)
    {
        //
         $this->datos = $datos;
         //dd($datos);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->markdown('emails.fotos.FotosCliente');
        return $this->view('emails.emailExternoFotos');

    }
}
