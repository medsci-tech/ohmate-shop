<?php


namespace App\Werashop\UnionUserInterface;


class Encryptor
{
    public function encrypt($string, $key = 'mime.org.cn')
    {
        return $this->tcode($string, true, $key);
    }

    public function decrypt($string, $key = 'mime.org.cn')
    {
        return $this->tcode($string, false, $key);
    }

    private function tcode($string, $isEncrypt = true, $key = 'mime.org.cn')
    {
        $dynKey = $isEncrypt ? hash('sha1', microtime(true)) : substr($string, 0, 40);
        $dynKey1 = substr($dynKey, 0, 20);
        $dynKey2 = substr($dynKey, 20);
        $fixKey = hash('sha1', $key);
        $fixKey1 = substr($fixKey, 0, 20);
        $fixKey2 = substr($fixKey, 20);
        $newkey = hash('sha1', $dynKey1 . $fixKey1 . $dynKey2 . $fixKey2);
        if($isEncrypt){
            $newstring = $fixKey1 . $string . $dynKey2;
        }else{
            $newstring = base64_decode(substr($string, 40));
        }
        $re = '';
        $len = strlen($newstring);
        for ($i = 0; $i < $len; $i++)
        {
            $j = $i % 40;
            $re .= chr(ord($newstring{$i}) ^ ord($newkey{$j}));
        }
        return $isEncrypt ? $dynKey . str_replace('=', '_', base64_encode($re)) : substr($re, 20, -20);
    }
}