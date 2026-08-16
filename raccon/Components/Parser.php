<?php
class Parser
{

    public static function getPageCURl($url)
    {

        $ch = curl_init();
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/' . rand(8, 100) . '.0';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_DEFAULT);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($errno = curl_errno($ch)) {
            return false;
        } else {

            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
    }

    public static function getFile($url)
    {
        $result = file_get_contents($url);
        if ($result) {
            return $result;
        } else {
            return null;
        }

    }

    public static function getDiv($p1, $p2, $p3)
    {
        $num1 = strpos($p1, $p2);
        if ($num1 === false) return 0;
        $num2 = substr($p1, $num1);
        return strip_tags(substr($num2, 0, strpos($num2, $p3)));
    }

    public static function getElementsByClass($url, $parseData)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
                
        $resultPage = self::getPageCURl($url);
        
        if ($resultPage) {
            @$dom->loadHTML($resultPage);
        } else {
            return false;
        }
        
        sleep($parseData['sleep']); // Give the remote page time before parsing.
        
        $contentNode = $dom->getElementById(strval($parseData['id']));
        
        $nodes = array();
        
        $childNodeList = $contentNode->getElementsByTagName(strval($parseData['tag']));
        
        
        for ($i = 0; $i < $childNodeList->length; $i++) {
            $temp = $childNodeList->item($i);
            foreach ($parseData['select_data'] as $key => $valueNodes) {
                if (stripos($temp->getAttribute($valueNodes['attribute']), $valueNodes['selector']) !== false) {
                    $nodes[] = trim($temp->nodeValue); 
                }
            }
        }
        
        if ($nodes) {
            return $nodes;
        } else {
            return [];
        }
    }

}
