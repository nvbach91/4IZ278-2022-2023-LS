<?php

namespace classes;

class statusMessage
{
    /**
     * @param string $message       The message you want to show the user.
     * @param string $messageType   The type of the message: success, error, info (info is default).
     */

    public string $type;
    public function __construct(

        public string $message,
        private readonly string $messageType

    ) {

        $this->type = match ($this->messageType) {
            'success' => 'success',
            'error' => 'danger',
            'warning' => 'warning',
            default => 'info'
        };

    }

}