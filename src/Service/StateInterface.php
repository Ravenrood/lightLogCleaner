<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 19:50
 */

namespace App\Service;


interface StateInterface
{
    const STATE_RECEIVED = 1;
    const STATE_PROCESSING = 2;
    const STATE_DONE = 3;
    const STATE_ERROR = 4;
}