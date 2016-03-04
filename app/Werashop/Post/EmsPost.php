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

        $curl->get($this->_getBillnumUrl, ['xml' => $this->generateBillNumRequestData()]);
        $xml_str = $curl->response;
        //TODO
    }

    protected function generateBillNumRequestData()
    {
        return base64_encode('<?xml version="1.0" encoding="UTF-8"?><XMLInfo><sysAccount>'.$this->_sysAccount.'</sysAccount><passWord>'.$this->_password.'</passWord><appKey>'.$this->_appKey.'/appKey><businessType>4</businessType><billNoAmount>1</billNoAmount></XMLInfo>');
    }
}