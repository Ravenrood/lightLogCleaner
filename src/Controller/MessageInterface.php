<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 05.12.2018
 * Time: 20:34
 */

namespace App\Controller;


interface MessageInterface
{
    const MESSAGE_DONE = 'clearing completed';
    const MESSAGE_ERROR = 'clearing failed';
    const MESSAGE_COMPRESSED = 'commpressed';
}