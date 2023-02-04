<?php


namespace App\DataTransferObjects;


class UpdateSubscriberDTO
{
    public string $name;
    public string $password;
    public string $status;

    /**
     * UpdateSubscriberDTO constructor.
     * @param string $name
     * @param string $password
     * @param string $status
     */
    public function __construct(string $name, string $password, string $status)
    {
        $this->name = $name;
        $this->password = $password;
        $this->status = $status;
    }


}
