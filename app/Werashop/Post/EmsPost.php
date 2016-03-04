<?php


namespace App\Werashop\Post;


use App\Models\Address;
use App\Models\Order;
use Curl\Curl;

class EmsPost implements PostInterface
{
    private $_getBillnumUrl;

    private $_printDatasUrl;

    private $_sysAccount;

    private $_password;

    private $_appKey;

    /**
     * EmsPost constructor.
     */
    public function __construct()
    {
        $this->_getBillnumUrl = "http://os.ems.com.cn:8081/zkweb/bigaccount/getBigAccountDataAction.do?method=getBillNumBySys";
        $this->_printDatasUrl = "http://os.ems.com.cn:8081/zkweb/bigaccount/getBigAccountDataAction.do?method=updatePrintDatas";

        $this->_sysAccount = env('EMS_SYS_ACCOUNT');
        $this->_password = env('EMS_PASSWORD');
        $this->_appKey = env('EMS_APPKEY');
    }


    public function getMailNo()
    {
        $curl = new Curl();

        $curl->get($this->_getBillnumUrl, $this->generateBillNumRequestData());
        $xml_str = $curl->response;
        //TODO
    }

    protected function generateBillNumRequestData()
    {
        return base64_encode('<?xml version="1.0" encoding="UTF-8"?><XMLInfo><sysAccount>42010670114000</sysAccount><passWord>595600830807d207332c36fcd7a5c3e5</passWord><appKey>S51f85dA8892165c7</appKey><businessType>4</businessType><billNoAmount>1</billNoAmount></XMLInfo>');
    }
}