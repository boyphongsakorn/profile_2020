<?php

include('config.php');

$facebook_output = '';

if(isset($_GET['code']))
{
    try{

        if(isset($_SESSION['access_token']))
        {
            $access_token = $_SESSION['access_token'];
        }
        else
        {
            $access_token = $facebook_helper->getAccessToken();

            $_SESSION['access_token'] = $access_token;

            $facebook->setDefaultAccessToken($_SESSION['access_token']);
        }

        $graph_response = $facebook->get("/me?fields=name,email", $access_token);

        $facebook_user_info = $graph_response->getGraphUser();

        if(!empty($facebook_user_info['id']))
        {
            $_SESSION['user_id'] = $facebook_user_info['id'];

            $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
        }

        if(!empty($facebook_user_info['name']))
        {
            $_SESSION['user_name'] = $facebook_user_info['name'];
        }

        if(!empty($facebook_user_info['email']))
        {
            $_SESSION['user_email'] = $facebook_user_info['email'];
        }

        //echo $_SESSION['user_email'].$_SESSION['user_image'].$_SESSION['user_name'];

        header('location:https://profile.pwisetthon.com/');

    } catch (Exception $e) {
        try {
            if (isset($_GET["error"])) {
                header('Location: https://minecraft.pwisetthon.com/');
                //echo json_encode(array("message" => "Authorization Error"));
            
            } elseif (isset($_GET["code"])) {
                $redirect_uri = "https://profile.pwisetthon.com/checklogin.php";
                $token_request = "https://discordapp.com/api/oauth2/token";
            
                $token = curl_init();
            
                curl_setopt_array($token, array(
                    CURLOPT_URL => $token_request,
                    CURLOPT_POST => 1,
                    CURLOPT_POSTFIELDS => array(
                        "grant_type" => "authorization_code",
                        "client_id" => "691610557156950030",
                        "client_secret" => "SLSM2j6cpc5PkDYUuzsExZD4BCbX-pNv",
                        "redirect_uri" => $redirect_uri,
                        "code" => $_GET["code"]
                    )
                ));
                curl_setopt($token, CURLOPT_RETURNTRANSFER, true);
            
                $resp = json_decode(curl_exec($token));
                curl_close($token);
            
                if (isset($resp->access_token)) {
                    $access_token = $resp->access_token;
            
                    // start user info
            
                    $info = curl_init();
                    curl_setopt_array($info, array(
                        CURLOPT_URL => "https://discordapp.com/api/users/@me",
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: Bearer {$access_token}"
                        ),
                        CURLOPT_RETURNTRANSFER => true
                    ));
            
                    $user = json_decode(curl_exec($info));
                    curl_close($info);

                    $_SESSION["user_id"] = $user->id;
                    
                    header('Location: https://profile.pwisetthon.com/');
            
                    // start user guild join
            
                    //$cgui = curl_init();
                    //curl_setopt_array($cgui, array(
                    //    CURLOPT_URL => "https://discordapp.com/api/users/@me/guilds",
                    //    CURLOPT_HTTPHEADER => array(
                    //        "Authorization: Bearer {$access_token}"
                    //    ),
                    //    CURLOPT_RETURNTRANSFER => true
                    //));
            
                    //$guil = json_decode(curl_exec($cgui));
                    //curl_close($cgui);
            
                    //print_r($user);
            
                    //echo '<br><br>';
            
                    //print_r($guil);
            
                }
            } else{
                echo "server dead";
            }
        } catch (Exception $e) {
            echo "สงสัย เซิฟเวอร์ จะมีปัญหานะ อีกสักพัก ค่อยกลับมา ลองใหม่นะ";
        }
    }
}
//else
//{
    //$facebook_permissions = ['email'];

    //$facebook_login_url = $facebook_helper->getLoginUrl('https://profile.pwisetthon.com/',$facebook_permissions);

    //$facebook_login_url = '<a href="'.$facebook_login_url.'">ล็อกอิน</a>';

    //echo $facebook_login_url;
//}
?>