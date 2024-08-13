<?php

namespace controllers;

class Controller
{
    public function sendResponse(string $message, string $redirect_to): void
    {
        echo $message;
        echo $redirect_to;
    }

    public function sendError(string $message): void
    {
       echo $message;
    }

}