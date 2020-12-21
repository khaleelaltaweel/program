<?php
//  connect this page with all pages in my project

//session_start();


//  Connect to my database :

$connect = @mysqli_connect("localhost" ,"root" , "" , "index" );

//   Collect all the Data From mY form:
    
    $x1 = @$_POST["fullname"];
    $x2 = @$_POST["username"];
    $x3 = @$_POST["email"];
    $x4 = @$_POST["password"];
    $x5 = @$_POST["password10"];
    $x6 = @$_POST["submit"];
    

    $errors = array();


    //  Validation:

    if (empty($x1)){
        array_push($errors , "Full Name is empty");
    }

    if (empty($x2)){
        array_push($errors , "UserName is empty");
    }

    if (empty($x3)){
        array_push($errors , "Email is empty");
    }

    if (empty($x4)){
        array_push($errors , "Password is empty or wrong");
    }

    if (empty($x5)){
        array_push($errors , "re_password is empty or wrong");
    }

    if ($x4!=$x5){

        array_push($errors , "the Passwords Dont Match");
    }
    


if (isset($_POST["submit"])) {
    // Get Image Dimension
    $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
    //$width = $fileinfo[0];
   // $height = $fileinfo[1];
    
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
    
    // Get image file extension
    $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
    
    // Validate file input to check if is not empty
    if (! file_exists($_FILES["file-input"]["tmp_name"])) {
        $response = array(
            "type" => "error",
            "message" => "Choose image file to upload."
        );
    }    // Validate file input to check if is with valid extension
    else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valiid images. Only PNG and JPEG are allowed."
        );
        echo $result;
    }    // Validate image file size
    else if (($_FILES["file-input"]["size"] > 2000000)) {
        $response = array(
            "type" => "error",
            "message" => "Image size exceeds 2MB"
        );
    }    // Validate image file dimension
    else {
        $target = "profile/" . basename($_FILES["file-input"]["name"]);
        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
           
            $response = array(
                "type" => "success",
                "message" => "Image uploaded successfully."
     
    
            );
        
        } else {
            $response = array(
                "type" => "error",
                "message" => "Problem in uploading image files."
            );
        }
      
    }
}
  

if (count($errors)==0){
    //  $W1 = md5 (md5($x4));
    
    $insert1 = "INSERT INTO khaleel (fullname , username , email , password , photo ) VALUES ('$x1' , '$x2' , '$x3' , '$x4' , '$target')";
    $result1 = mysqli_query($connect , $insert1);
    $response = array(
        "type" => "success",
        "message" => "Seccessfully Register"
    );
  
    //header("location:profile.php");


}



   
    //   Login Page:

    //  Get All Data From Login Form:

    // $y1 = @$_POST["name1"];
    // $y2 = @$_POST["name2"];
    // $y3 = @$_POST["name3"];

    // // Validation:

    //  if (empty($y1)){
    //     array_push($errors , "Please Fill out Your Email");
    //  }

    //  if (empty($y2)){
    //      array_push($errors , "Please Fill out Your Password");
    //  }

    // if (isset ($_POST["$y3"])){
        
    //     $select ="SELECT * FROM khaleel WHERE email = '$y1' and password ='$y2'";
    //     $result10 = mysqli_query($connect , $select);
    //     if (mysqli_num_rows($result10)==1){
    //         header("location:3.php");
    //     }
    //     else {
    //     array_push($errors , "password or email is incorrect");
    //     }
    // }
    // if (isset ($_POST["name3"])){
    //     $username = @mysqli_real_escape_string($connect, $_POST["email"]);
    //     $password = @mysqli_real_escape_string($connect, $_POST["password"]);

    //     if (empty ($username )){ 
    //         array_push($errors , "username is empty");
    //     }

    //     if (empty ($password)){
    //         array_push($errors , "password is empty");
    //     }

    //     if (count($errors)==0){
    //         // $password5 =  md5($password);
    //         $select = "SELECT * FROM khaleel WHERE email = '$username' and password = '$password'";
    //         $result12 = mysqli_query($connect , $select);
    //     }
        
    //     if (@mysqli_num_rows($result12 )==1){
            
    //     // $_SESSION["username"] = $username;
    //     // $_SESSION["success"] = "Login Successfully !!!!!!!!!!!!!!!";
    //     header("location:3.php");
       
    //     }
    //     else {
           
    //         array_push($errors , "username and/or password is incoorect");
    //     }

    // }





//     if (isset ( $_POST["admin"])){
//     $a = @$_POST["admin1"];
//     $a1 = @$_POST["admin2"];
//     $sel = "SELECT * FROM admin WHERE uesrname = '$a' and password ='$a1'";
//     $re = mysqli_query($connect , $sel);
//     if (mysqli_num_rows($re)==1){
//         header("location: dashboard.php");
//     }
//         else
//         { 
//             header("location: admin.php");
//             array_push($errors , "password or email is incorrect");

        

//     }
// }


    $c1 = @$_POST["Submit"];
    $c2 = @$_POST["email1"];
    $c3 = @$_POST["message"];
    $c4 = @$_POST["id"];
    $errors1 = array();


    //  Validation:

    if (empty($c2)){
        array_push($errors1 , "email is empty");
    }

    if (empty($c3)){
        array_push($errors1 , "massage is empty");
    }
     if (count($errors1)==0){
        
        $c5 = "INSERT INTO contactus (email , massege) VALUES ('$c2' , '$c3')";
        $c6 = mysqli_query($connect , $c5);
        echo '<span style="color:black;text-align:center;margin-left: 50%;margin-top: 30%;">Thank you for contacting us</span>';
        

    }



    ?>





