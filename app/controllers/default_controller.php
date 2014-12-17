<?php

class defaultController extends AppController
{
    public function index()
    {
        $message = Message::getDisplayMessage();

        $this->set('message', $message);
    }
}
