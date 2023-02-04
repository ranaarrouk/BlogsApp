<?php


namespace App\DataTransferObjects;


class StoreSubscriberDTO
{
    public string $name;
    public string $email;
    public string $password;
    public string $username;
    public string $status;
    public string $type;

    /**
     * StoreSubscriberDTO constructor.
     * @param string $name
     * @param string $username
     * @param string $password
     * @param string $status
     * @param string $type
     */
    public function __construct(string $name, string $username,string $password, string $status, string $type)
    {
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->status = $status;
        $this->type = $type;
    }


}
