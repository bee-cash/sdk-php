<?php

class Bee
{
    private $headers, $url;

    public function __construct($token)
    {
        $this->url = 'https://bee.cash/api/';

        $this->headers = [
            'WWW-Authenticate: Token',
            'Authorization: Token ' . $token,
            'Accept: application/json',
            'Content-Type: application/json'
        ];
    }

    private function execute($end_point, $array, $method = 'post')
    {
        $method = strtoupper($method);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url.$end_point);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
        } elseif ($method != 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
        }
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        var_dump($this->url.$end_point);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function altcoin_address($array = [])
    {
        return $this->execute('altcoin/address', $array);
    }

    public function altcoin_withdrawal($array = [])
    {
        return $this->execute('altcoin/withdrawal', $array);
    }

    public function balance($coin = '')
    {
        return $this->execute('balance/'.$coin, [], 'get');
    }

    public function bank_deposit_boleto($array)
    {
        return $this->execute('bank/deposit/boleto', $array);
    }

    public function charge_boleto($array = [])
    {
        return $this->execute('charge/boleto', $array);
    }

    public function charge_boleto_receive_in_cash($boleto_id)
    {
        return $this->execute('charge/boleto/'.$boleto_id.'/receive-in-cash');
    }

    public function charge_client($array = [])
    {
        return $this->execute('charge/client', $array);
    }

    public function coin($coin = '')
    {
        return $this->execute('coin/'.$coin, [], 'get');
    }

    public function transfer($array = [])
    {
        return $this->execute('transfer', $array);
    }
}
