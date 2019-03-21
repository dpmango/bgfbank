<?
  class c_curl
  {
    var $_ch							= null;
//    var $_aErrors						= array();
    var $_sErrors						= '';

    var $_sCookieFile					= '';

    var $_bResetCookie					= FALSE;
    var $_sAgentName					= 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1';

    var $_sPost							= '';

    var $_sProxy						= '';
    var $_sReferer						= '';


    function c_curl()
    {
      $this->_ch = curl_init();
    }

    function free()
    {
      curl_close($this->_ch);
    }

    function getInfo()
    {
      return curl_getinfo($this->_ch);
    }

    function setCookieFile($cookie_file, $bReset = FALSE)
    {
      $this->_sCookieFile = $cookie_file;
      $this->_bResetCookie = $bReset;
    }
    function setProxy($sProxy)
    {
      $this->_sProxy = $sProxy;
    }
    function setReferer($sReferer)
    {
      $this->_sReferer = $sReferer;
    }
    function setPost($sPost)
    {
      $this->_sPost = $sPost;
    }

    function getErrorMsg()
    {
//      return implode('<br>', $this->_aErrors);
      return $this->_sErrors;

    }

    function getContent($sUrl, $bReturnTransfer = 1)
    {
      curl_setopt($this->_ch, CURLOPT_URL, $sUrl);
      curl_setopt($this->_ch, CURLOPT_HEADER, 0);
      curl_setopt($this->_ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($this->_ch, CURLOPT_TIMEOUT, 50);
      curl_setopt($this->_ch, CURLOPT_USERAGENT, $this->_sAgentName);
      curl_setopt($this->_ch, CURLOPT_RETURNTRANSFER, $bReturnTransfer);

      curl_setopt($this->_ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($this->_ch, CURLOPT_SSL_VERIFYHOST, false);

      if ($this->_sCookieFile)
      {
        if ($this->_bResetCookie)
        {
          $handle = fopen($this->_sCookieFile, "w");
          fclose($handle);
        }
        curl_setopt($this->_ch, CURLOPT_COOKIEFILE, $this->_sCookieFile);
        curl_setopt($this->_ch, CURLOPT_COOKIEJAR, $this->_sCookieFile);
      }

      if ($this->_sProxy)
      {
        // Укажем Curl что будем работать через прокси SOCKS 5
        //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5); // или CURLPROXY_SOCKS4
        // Укажем Curl информацию об ip-адресе и порте прокси-сервера
        curl_setopt($this->_ch, CURLOPT_PROXY, $this->_sProxy);
      }

      if ($this->_sReferer)
      {
        curl_setopt($this->_ch, CURLOPT_REFERER, $this->_sReferer);
      }

      if ($this->_sPost)
      {
        curl_setopt($this->_ch, CURLOPT_POST, 1);
        curl_setopt($this->_ch, CURLOPT_POSTFIELDS, $this->_sPost);
      }

      $this->sContent = curl_exec($this->_ch);
      //$this->_aErrors[] = curl_error($this->_ch);
      $this->_sErrors = curl_error($this->_ch);

      return $this->sContent;
    }

    /*
      //
    */
    function Demo()
    {
      $sUrl = 'http://www.ya.ru';
      $cookie_file = 'cookie.txt';

      $curl = new c_curl();
      $curl->getContent($sUrl);
    }
  }
?>