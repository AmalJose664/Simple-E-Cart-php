
<?php
//the request is received from login.html or signup.html from accounts folder
session_start();
$debug_mode=false;
include('../utils/connect.php');

if(!$debug_mode){
    header('Content-Type: application/json');

    // If this is for a POST request
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //if the client side request was a post method only
        //this is the first if ; this checks if the request method was post or get;
        $input = json_decode(file_get_contents('php://input'), true);
        //the input is an array with users all details recieved from clent side
        $name = $input['name'] ?? "";
        $email = $input['email'] ?? '';
        $pass = $input['pass'] ?? "";
        $role = 'user';
        $action = $input['action'];
        //$_SESSION['user_name'] = $name;



        if ($action === 'login') {
			//the action variable specify what type of action ; like login or sign up
			//this was submitted from login page then check if the user is in the database ; if yes then display home page for the user; if no display invalid user
			$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ss", $email, $pass);
			$stmt->execute();
			$result = $stmt->get_result();

            if (mysqli_num_rows($result) > 0) { //this checks if entered data are in the database or not
                session_regenerate_id(true);
                while ($row = mysqli_fetch_assoc($result)) {
					//the entered data of the  user was found in databse so take his details from db and store it in session to access it across multiply pages
					$_SESSION['user_id'] = $row['uid'];
					$_SESSION['user_name'] = $row['name'];
					$_SESSION['user_email'] = $row['email'];
					$_SESSION['user_role'] = $row['role'];

                    break;
                }
                //sent success messege for login due to correct detils entered by him /her
                $response = [
                    'message' => 'succes for a login',
                    'status' => true,
                    'next' => "../home.php",
                ];
            } else {
                //NO USER was found so display this to user
                $response = [
                    'message' => 'Email or Passowrd Incorrect',
                    'status' => false,
                ];
            }
        } elseif ($action === 'signup') {
            //if the action was for signup
            // this was submitted from sign up page ;so insert user to the database
            $sql = "select * from users where email = '$email'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) == 0) {
				//this if checks if the user entered email is already  taked by another user 
				$sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
				$stmt = $conn->prepare($sql);

				// Bind parameters to the placeholders
				$stmt->bind_param("ssss", $name, $email, $pass, $role);

				// Execute the prepared statement
				if ($stmt->execute()) {
                    //this if confirms that data has entered the databses or inserted succesfully
                    $sql = "select * from users where name='$name' and email='$email'";
                    $result = $conn->query($sql);
                    //this while takes the inserted data from db and place it in session for multiple use
                    while ($row = mysqli_fetch_assoc($result)) {
                        session_regenerate_id(true);
                        $_SESSION['user_id'] = $row['uid'];
                        $_SESSION['user_name'] = $row['name'];
                        $_SESSION['user_email'] = $row['email'];
                        $_SESSION['user_role'] = $row['role'];
                        break;
                    }
                    //display sign up success for user
                    $response = [
                        'message' => "Signup up success ",
                        'status' => true,
                        'next' => '../home.php'
                    ];
                } else {
                    //this will be a mysql error on data insertion
                    $response = [
                        'message' => 'Server mysql error',
                        'status' => false,
                    ];
                }
            } else {
                //this else is for when the entered email by the user is already taken by another user
                $response = [
                    'message' => 'Email Already taken',
                    'status' => false,
                ];
            }
        }
    } else {
        //ignore this code below these were for testing purposes 
        //this else case only executes when the user tries get method instead of post method;

        // //$name='amal';
        // //$pass='123456';
        // $email= 'hmal446446@gmail.com';
        // include('../connect.php');
        // //$pass=password_hash("12345", PASSWORD_DEFAULT);
        // $sql = "select * from users where email = '$email'";
        // $result = $conn->query($sql);
        // $test=mysqli_num_rows($result);

        $response = [
            //this response will be displayed directly on chrome page where other response are only displayed on login page
            //to see this response go to this link ==== "http://localhost/projects/account/loginconnect.php"
            //if you have a port then use this link ==== ""http://localhost:<ENTER PORT NUMBER HERE AFTER REMOVING THESE GREATER AND LESSTHAN SYMBOLS>/projects/account/loginconnect.php""
            'message' => "Nice try for a get request  ",
            // 's' => "$email",

        ];
    }
    echo json_encode($response);
}else{
    header('Content-Type: text/html');
    // If this is for a POST request
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $email =  $_POST['email'];
        $pass = $_POST['password'];
        $role = 'user';
        $action = $_POST['action'];
        //$_SESSION['user_name'] = $name;



        if ($action === 'login') {
            //the action variable specify what type of action ; like login or sign up
            //this was submitted from login page then check if the user is in the database ; if yes then display home page for the user; if no display invalid user
            $sql = "select * from users where email = '$email' and password = '$pass'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) { //this checks if entered data are in the database or not
                session_regenerate_id(true);
                
                //sent success messege for login due to correct detils entered by him /her
                
                echo "login sucesss email = $email  password = $pass";
            } else {
                //NO USER was found so display this to user
                echo "login falied no username or password found email = $email  password = $pass";
            }
        } elseif ($action === 'signup') {
            $name = $_POST['username'];
            //if the action was for signup
            // this was submitted from sign up page ;so insert user to the database
            $sql = "select * from users where email = '$email'";
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) == 0) {
                //this if checks if the user entered email is already  taked by another user 
                $sql = "insert into users(name,email,password,role) values('$name','$email','$pass','$role')";

                if ($conn->query($sql) === TRUE) {
                    //this if confirms that data has entered the databses or inserted succesfully
                    $sql = "select * from users where name='$name' and email='$email'";
                    $result = $conn->query($sql);
                    //this while takes the inserted data from db and place it in session for multiple use
                    
                    //display sign up success for user
                
                    echo "signup sucesss email = $email  password = $pass name = $name";
                } else {
                    //this will be a mysql error on data insertion
                    
                    echo "Server error not inserted the data email = $email  password = $pass name = $name";
                }
            } else {
                //this else is for when the entered email by the user is already taken by another user
                
                echo "Email already taken email = $email  password = $pass name = $name";
            }
        }
    } else {
       
        echo "That was a get request";
    }
}
