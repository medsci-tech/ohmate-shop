<?php


namespace App\Werashop\Wechat;

use Overtrue\Wechat\Menu;

class Wechat
{

    private $_appId;

    private $_secret;

    private $_aseKey;

    private $_token;
    /**
     * Wechat constructor.
     */
    public function __construct()
    {
        $this->_appId = env('WX_APPID');
        $this->_secret = env('WX_APPSECRET');
        $this->_aseKey = env('WX_ENCODING_ASEKEY');
        $this->_token = env('WX_TOKEN');
    }

    public function createMenu($menus)
    {
        $menuService = new Menu($this->_appId, $this->_secret);

        try {
            $menuService->set($menus);// 请求微信服务器
            echo '设置成功！';
        } catch (\Exception $e) {
            echo '设置失败：' . $e->getMessage();
        }
    }
}