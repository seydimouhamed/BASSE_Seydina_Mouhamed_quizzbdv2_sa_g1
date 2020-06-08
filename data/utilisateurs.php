<?php 
require_once "../db/connexion.php";

    global $db;

    $action=$_GET['action'];

if($action =='connexion')
{

         
        $login=$_POST['login'];
        $pwd=$_POST['pwd'];
        if($login==""|| $pwd=="" )
        {
            $message['msg'] = array('text' => 'Veillez renseiner tout les champs',"type"=>'alert' );
            echo json_encode($message);
        }
        else
        {
            $result=checkUserLog($login,$pwd);;

            if($result!==false)
            {
                
                $message['msg'] = array('text' => "connecter avec succes","type"=>'success' );
                $message['info_user']=$result;
                echo json_encode($message);
            }
            else
            {
                $message['msg'] = array('text' => "L'enregistrement n'a pas pu se faire","type"=>'alert' );
                echo json_encode($message);
            }

        }
}
else if($action=="inscription")
{
      $d=$_POST;
      $f=$_FILES;

      if(getUserByUserName($d["login"])!==false)
      {
      $result=registeruser($d["login"],$d["pwd"],$d["firstname"],$d["lastname"],"admin",$f["avatar"]);

            if($result)
            {
                    $userInfo=getUserByUserName($d["login"]);
                    $message['msg'] = array('text' => "connecter avec succes","type"=>'success' );
                    $message['info_user']=$userInfo;
                    
                    echo json_encode($message);
            }
            else
            {
                    $message['msg'] = array('text' => "Echec lors de l'inscription","type"=>'alert' );
                    echo json_encode($message);
            }

        }else
        {
            $message['msg'] = array('text' => "Ce login existe déjà","type"=>'alert' );
            echo json_encode($message);
        }
                
}


    
	function checkUserLog($log,$pwd)
	{
        $db=$GLOBALS['db'];
        $req=$db->prepare('SELECT c.id,c.profil,c.login,u.firstname, u.lastname, u.photo FROM connexions c JOIN utilisateur u on c.id=u.id_connexions WHERE c.login = :login AND c.password = :password');

        $req->execute(array('login'=>$log,'password'=>$pwd));

        return $req->fetch();
        

    }	


    function getUserByUserName($login)
    {
         $db=$GLOBALS['db'];
            $req=$db->prepare('SELECT * FROM connexions WHERE login = :login');

            $req->execute(array('login'=>$login));

            return $req->fetch();

    }

//     $limit = $_POST['limit'];
//     $offset = $_POST['offset'];
//     $date = $_POST['date'];


//     $sql ="
//             SELECT * 
//             FROM vente
//             ORDER BY id DESC
//             LIMIT {$limit} 
//             OFFSET {$offset}
//     ";

//     if($date==1){
//         $date = date('Y-m-d');
//         $sql = "
//         SELECT * 
//         FROM vente
//         WHERE date= DATE('{$date}')
//         ORDER BY id DESC
//         LIMIT {$limit} 
//         OFFSET {$offset}
// ";
        
//     }
//     $req = $db->query($sql);
//     $result = $req->fetchAll(2);

//    echo json_encode($result);

function registeruser($log,$pwd,$fn,$ln,$pfl,$f_imguser)
{ 
        $db=$GLOBALS['db'];        
            $avatar=registerUserAvatar($f_imguser);

            //hachage du mot de passe!
            $passwordHash = password_hash($pwd, PASSWORD_BCRYPT, array("cost" => 12));

            $infocon=array("login"=>$log,"pwd"=>$passwordHash,"profil"=>$pfl);

            $sql_con=('INSERT INTO connexions VALUES(DEFAULT,:login,:pwd,:profil)');
            $sql_user=('INSERT INTO utilisateur VALUES(DEFAULT,:firstname,:lastname,:photo,now(),:id)');
            
            try
            {
            //commencer la transaction

                $db->beginTransaction();
                $req_con=$db->prepare($sql_con);

                $req_con->execute($infocon);
                $id=$db->lastInsertId();

                
                $userInfo=array("firstname"=>$fn,"lastname"=>$ln,"photo"=>$avatar,"id"=>$id);
                
                $req_insert=$db->prepare($sql_user);
                $req_insert->execute($userInfo);

                $db->commit();
                return true;

            }
            catch(PDOException $e)
            {
                return false;
            }
            
}



    function registerUserAvatar($avatar)
    {
        $target_dir = "../assets/images/";
        //avoir le temps en millisecondes
        $mt = explode(" ",microtime());
        $currenttime = (((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000)));
        $newBasename=$currenttime.basename($avatar["name"]);
        $target_file = $target_dir .$newBasename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($avatar["tmp_name"]);
            if($check !== false)
            {
                //dsklsfdkml
                $uploadOk = 1;
            } 
            else
            {
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) 
        {
            $uploadOk = 0;
        }
        // Check file size
        if ($avatar["size"] > 500000)
        {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" )
        {
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) 
        {
            return "default.png";
        } 
        else 
        {
            if (move_uploaded_file($avatar["tmp_name"], $target_file))
            {
                return $newBasename;
                
            } else 
            {
                return "default.png";
            }
        }
    }
