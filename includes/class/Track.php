<?php


class Track {
    public $db;

    function __construct() {
        $this->db = new DBConnection();

    }

    function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    function recordClick($issueNo,$articleId,$andarAcct,$ipAddress) {
        $issueArticle = $issueNo . '_' . $articleId;
        $result = $this->db->query("SELECT * FROM link WHERE issue_article='".$issueArticle."'");
        $dataRow = $result->fetch_array();

        if($dataRow!=null) {
            $linkId = $dataRow["id"];
$query = "INSERT INTO click(link_id,andar_account_number,ip_address) VALUES ('" . $linkId . "','" . $andarAcct . "','" . $ipAddress ."')";
            $result = $this->db->query($query);
        }

        $url = $this->getRedirectURL($dataRow);
        return $url;

    }
    function getRedirectURL($dataRow) {
        if(sizeof($dataRow)==0) {
            return "http://uwgv.ca";
        } else {
            return $dataRow["url"];
        }
    }

}