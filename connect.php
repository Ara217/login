<?php
    function connect()
    {
        $con = mysqli_connect("localhost","root","","firstbase") or die ("Error");
        return $con;
    };

    function check($email)
    {
        $res = mysqli_query(connect(),"SELECT Email FROM USERS WHERE Email = '$email'");
        return $res;
    }
    function Login($logEmail,$logPass)
    {
        $result = mysqli_query(connect(),"SELECT * FROM USERS WHERE Email = '$logEmail' AND Password = '$logPass'");
        return $result;
    }

    function checkData($data, $type="s")
    {
        $data = mysqli_real_escape_string(connect(), $data);
        switch ($type)
        {
            case 'i':
                return (int)$data;break;//?
            case 's':
                return trim(strip_tags($data));break;
            case 'f':
                return (float)$data;break;
        }
    };