<?php

namespace Rotunova2\FotosultimasCard;

use Laravel\Nova\Card;

class FotosultimasCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';


    public function currentVisitors()
    {
        return $this->withMeta(['currentVisitors' => true]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'fotosultimas-card';
    }
}
