<?php
namespace App\Exceptions;
use Exception;

class RouteNotFoundException extends Exception
{
    protected $message = 'Router Not Found (404)';
}