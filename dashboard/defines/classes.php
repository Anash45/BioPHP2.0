<?php

// Class for Admin side functions
class admin extends db_connection
{
    // Function to show counts on admin dashboard.
    public function counts()
    {
        $sql1 = $this->query("SELECT COUNT(id) AS `total_users` FROM `users` ");
        $row1 = mysqli_fetch_assoc($sql1);
        $total = $row1['total_users'];
        
        $sql2 = $this->query("SELECT COUNT(t_id) AS `total_tools` FROM `tools`");
        $row2 = mysqli_fetch_assoc($sql2);
        $total_tools = $row2['total_tools'];
        
        $sql3 = $this->query("SELECT COUNT(ut_id) AS `total_u_tools` FROM `user_tools`");
        $row3 = mysqli_fetch_assoc($sql3);
        $total_u_tools = $row3['total_u_tools'];
        
        $sql4 = $this->query("SELECT COUNT(c_id) AS `total_messages` FROM `contact`");
        $row4 = mysqli_fetch_assoc($sql4);
        $total_messages = $row4['total_messages'];

        return array($total,$total_tools,$total_u_tools,$total_messages);
    }
    
    // Function to check if a looged user is admin or not.
    public function admin_check()
    {
        if (!isset($_SESSION['a_id']) || $_SESSION['role'] != 'admin') {
            header('location:../ad_login.php?error=1');
            die();
        }
    }
    
    // Function to login admin.
    public function admin_login()
    {
        $email = $this->sanitize($_REQUEST['email']);
        $password = $this->sanitize($_REQUEST['password']);
        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = $this->query($sql);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result)> 0) {
            $pass_check = password_verify($password, $row['password']);
            if ($pass_check) {
                if ($row['role'] == 'admin') {
                    $_SESSION['a_id'] = $row['id'];
                    $_SESSION['name'] = nl2br($row['name']);
                    $_SESSION['role'] = $row['role'];
                    $info  = '<div class="alert alert-success" role="alert">Logged in!</div>';
                    header("refresh:1,url=dashboard/index.php");
                } else {
                    $info = '<div class="alert alert-danger" role="alert">Account not found!</div>';
                }
            } else {
                $info = '<div class="alert alert-danger" role="alert">Incorrect password!</div>';
            }
        } else {
            $info = '<div class="alert alert-danger" role="alert">Account not found!</div>';
        }
        return $info;
    }

}
// Class for user related functions.
class users extends db_connection
{
    // Function to add user by admin.
    public function signup()
    {
        $role = 'user';
        $name = $this->sanitize($_REQUEST['name']);
        $email = $this->sanitize($_REQUEST['email']);
        $password = $_REQUEST['password'];
        $date = date('Y-m-d H:i:s');
        $password= password_hash($password,PASSWORD_DEFAULT);
        $sql1 = $this->query("SELECT * FROM `users` WHERE `email` = '$email'");
        if (mysqli_num_rows($sql1) > 0) {
            $info = '<div class="alert alert-danger">Email already present!</div>';
            return $info;
            exit;
        }
        $sql = "INSERT INTO `users` (`name`,`email`,`password`,`role`,`date`) VALUES ('$name','$email','$password','$role','$date')";
        $check = $this->query($sql);
        if ($check) {
            $info = '<div class="alert alert-success">Signup successful !</div>';
        } else {
            $info = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $info;
    }
    
    // Function to show all users for admin.
    public function show_users()
    {
        $show = '';
        $sql = $this->query("SELECT * FROM `users` WHERE `id` > 0 ORDER BY `role` ASC");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                $u_id = $row['id'];
                $sql1 = $this->query("SELECT COUNT(*) AS `total_tools` FROM `tools` WHERE `u_id` = '$u_id'");
                $row1 = mysqli_fetch_assoc($sql1);

                
                $sql2 = $this->query("SELECT COUNT(*) AS `submitted_tools` FROM `user_tools` WHERE `u_id` = '$u_id'");
                $row2 = mysqli_fetch_assoc($sql2);
                
                $delete = $change = '';
                if ($row['role'] == 'user') {
                    $admin = '';
                    $delete = '<a href="?delete_user='.$row['id'].'" class="btn btn-outline-danger w-100">Delete</a>';
                } else {
                    $admin = ' text-danger';
                    $delete = '';
                }
                
                $show .= '<tr>
                <td>'.$row['id'].'</td>
                <td class="'.$admin.'">'.nl2br($row['name']).'</a></td>
                <td>'.nl2br($row['email']).'</td>
                <td>'.$row2['submitted_tools'].' | '.$row1['total_tools'].'</td>
            </tr>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<div class="alert alert-danger">No users found!</div>';
        }
        return $show;
    }
    
    // Function to show all users for admin.
    public function users_list()
    {
        $show = '';
        $sql = $this->query("SELECT * FROM `users` WHERE `id` > 0 ORDER BY `id` ASC");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                
                $show .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<option value="" disabled>No users present!</option>';
        }
        return $show;
    }

    // Function to delete user by admin.
    public function delete_user()
    {
        $u_id = $this->sanitize($_REQUEST['delete_user']);
        $sql4 = $this->query("SELECT * FROM `users` WHERE `id` = '$u_id'");
        $row4 = mysqli_fetch_assoc($sql4);

        if ($row4['role'] == 'user') {


            $sql = "DELETE FROM `users` WHERE `id` = '$u_id'";
            $check = $this->query($sql);
            if ($check) {
                $info = '<div class="alert alert-success">User deleted successful!</div>';
            } else {
                $info = '<div class="alert alert-danger">An error occurred!</div>';
            }
        }else{
            $info = '<div class="alert alert-danger">You are not allowed to do this action!</div>';
        }
        return $info;
    }
    
    
    // Function to send message by user.
    public function send_message()
    {
        $name = $this->sanitize($_REQUEST['name']);
        $email = $this->sanitize($_REQUEST['email']);
        $subject = $this->sanitize($_REQUEST['subject']);
        $message = $this->sanitize($_REQUEST['message']);
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `contact` (`name`,`email`,`subject`,`message`,`date`) VALUES ('$name','$email','$subject','$message','$date')";
        $check = $this->query($sql);
        if ($check) {
            $info = '<div class="alert alert-success">Message sent successfully!</div>';
        } else {
            $info = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $info;
    }
    // Function to show all messages for admin.
    public function show_messages()
    {
        $show = '';
        $sql = $this->query("SELECT * FROM `contact` WHERE `c_id` > 0 ORDER BY `c_id` DESC");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                $show .= '<tr>
                <td>'.$row['c_id'].'</td>
                <td>'.nl2br($row['name']).'</a></td>
                <td>'.nl2br($row['email']).'</td>
                <td>'.nl2br($row['subject']).'</td>
                <td>'.nl2br($row['message']).'</td>
                <td>'.$this->time_elapsed_string($row['date']).'</td>
                <td><a href="?delete_msg='.$row['c_id'].'" class="btn btn-outline-danger w-100">Delete</a></td>
            </tr>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<div class="alert alert-danger">No messages found!</div>';
        }
        return $show;
    }
    
    // Function to delete a message by admin.
    public function delete_message()
    {
        $c_id = $_REQUEST['delete_msg'];
        $sql = "DELETE FROM `contact` WHERE `c_id` = '$c_id'";
        $check = $this->query($sql);
        if ($check) {    
            $info = '<div class="alert alert-success">Message deleted successfully!</div>';
        } else {
            $info = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $info;
    }
    // Function to login user.
    public function user_login()
    {
        $email = $this->sanitize($_REQUEST['email']);
        $password = $this->sanitize($_REQUEST['password']);
        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = $this->query($sql);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result)> 0) {
            $pass_check = password_verify($password, $row['password']);
            if ($pass_check) {
                if ($row['role'] == 'user') {
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['name'] = nl2br($row['name']);
                    $_SESSION['role'] = $row['role'];
                    $info  = '<div class="alert alert-success" role="alert">Logged in!</div>';
                    header("refresh:1,url=index.php");
                } else {
                    $info = '<div class="alert alert-danger" role="alert">Account not found!</div>';
                }
            } else {
                $info = '<div class="alert alert-danger" role="alert">Incorrect password!</div>';
            }
        } else {
            $info = '<div class="alert alert-danger" role="alert">Account not found!</div>';
        }
        return $info;
    }
    
    // Function to check if user is logged in.
    public function user_check()
    {
        if (isset($_SESSION['u_id']) && $_SESSION['role'] == 'user') {
            return true;
        }else{
            return false;
        }
    }
}

// Class for tickets related functions.
class tools extends db_connection
{
    
    public function tools_list()
    {
        $show = '';
        $somePath = 'tools';
        $all_dirs = glob($somePath . '/*' , GLOB_ONLYDIR);
        foreach ($all_dirs as $key => $value) {
            $show .= '<option value="'.$value.'">'.$value.'</option>';
        }
        // print_r($all_dirs);
        return $show;
    }
    
    
    
    // Function to show all tools for admin.
    public function ad_show_tools()
    {
        $show = '';
        $sql = $this->query("SELECT * FROM `tools` WHERE `t_id` > 0");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                $show .= '<tr>
                <td>'.$row['t_id'].'</td>
                <td>'.nl2br($row['name']).'</a></td>
                <td>'.nl2br($row['directory']).'</td>
                <td>'.$this->time_elapsed_string($row['date']).'</td>
                <td><a href="?delete='.$row['t_id'].'" class="btn btn-danger">Delete</a></td>
            </tr>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<div class="alert alert-danger">No tools found!</div>';
        }
        return $show;
    }
    
    // Function to show all tools for admin.
    public function show_u_tools()
    {
        $show = '';
        $u_id = $_SESSION['u_id'];
        $sql = $this->query("SELECT * FROM `user_tools` WHERE `u_id` = '$u_id'");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                if ($row['status'] == 0) {
                    $status = '<b class="text-danger">Declined</b>';
                }elseif ($row['status'] == 2) {
                    $status = '<b class="text-info">In Progress</b>';
                }elseif ($row['status'] == 1) {
                    $status = '<b class="text-success">Posted</b>';
                }
                $show .= '<tr>
                <td>'.$row['ut_id'].'</td>
                <td>'.nl2br($row['name']).'</td>
                <td>'.$this->time_elapsed_string($row['date']).'</td>
                <td>'.$status.'</td>
            </tr>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<div class="alert alert-danger">No tools found!</div>';
        }
        return $show;
    }
    
    // Function to show all tools for admin.
    public function ad_show_u_tools()
    {
        $show = '';
        $sql = $this->query("SELECT * FROM `user_tools` WHERE `u_id` > 0");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                $u_id = $row['u_id'];
                $sql1 = $this->query("SELECT * FROM `users` WHERE `id` = '$u_id'");
                $row1 = mysqli_fetch_assoc($sql1);
                if (!empty($row1)) {
                    $name = $row1['name'];
                }else{
                    $name = 'Delete User';
                }
                if ($row['status'] == 0) {
                    $status = '<b class="text-danger">Declined</b>';
                }elseif ($row['status'] == 2) {
                    $status = '<b class="text-info">In Progress</b>';
                }elseif ($row['status'] == 1) {
                    $status = '<b class="text-success">Posted</b>';
                }
                $show .= '<tr>
                <td>'.$row['ut_id'].'</td>
                <td>'.$name.'</td>
                <td><a target="_blank" href="uploads/'.nl2br($row['filename']).'">'.nl2br($row['name']).'</a></td>
                <td>'.$this->time_elapsed_string($row['date']).'</td>
                <td>'.$status.'</td>
                <td>
                <select class="form-control" onchange="window.location=this.value;">
                    <option disabled selected>Change Status</option>
                    <option value="u_tools.php?status=0&ut_id='.$row['ut_id'].'">Declined</option>
                    <option value="u_tools.php?status=1&ut_id='.$row['ut_id'].'">Posted</option>
                </select>
                </td>
            </tr>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<div class="alert alert-danger">No tools found!</div>';
        }
        return $show;
    }


    
    // Function to show all tools for users.
    public function change_tool_status()
    {
        $show = '';
        $status = $this->sanitize($_REQUEST['status']);
        $ut_id = $this->sanitize($_REQUEST['ut_id']);
        $sql = $this->query("UPDATE `user_tools` SET `status` = '$status' WHERE `ut_id` = '$ut_id'");
        if ($sql) {
            $show = '<div class="alert alert-success">Status updated successfully!</div>';
        } else {
            $show = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $show;
    }
    
    // Function to show all tools for users.
    public function show_tools()
    {
        $show = '';
        $sql = $this->query("SELECT * FROM `tools` WHERE `t_id` > 0");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                $show .= '
                <a href="tool.php?t_id='.$row['t_id'].'" class="col-xl-3 col-md-4 col-sm-6 mb-3">
                    <div class="card h-100 links">
                        <div class="card-body">
                            <h5 class="card-title mb-0">'.$row['name'].'</h5>
                        </div>
                    </div>
                </a>';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '<div class="alert alert-danger">No tools found!</div>';
        }
        return $show;
    }
    
    // Function to show tool details for users.
    public function tool_details()
    {
        $show = '';
        $t_id = $this->sanitize($_REQUEST['t_id']);
        $sql = $this->query("SELECT * FROM `tools` WHERE `t_id` = '$t_id'");
        $row = mysqli_fetch_assoc($sql);
        if (!empty($row)) {
            do {
                $show = $row['directory'].'/index.php';
            } while ($row = mysqli_fetch_assoc($sql));
        } else {
            $show = '';
        }
        return $show;
    }



    // Function to create a tool by admin.
    public function add_tool()
    {
        $name = $this->sanitize($_REQUEST['name']);
        $directory = $this->sanitize($_REQUEST['directory']);
        $u_id = $_REQUEST['u_id'];
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `tools` (`name`,`u_id`,`directory`,`date`) VALUES ('$name','$u_id','$directory','$date')";
        $check = $this->query($sql);
        if ($check) {    
            $info = '<div class="alert alert-success">Tool added successfully!</div>';
        } else {
            $info = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $info;
    }
    
    // Function to create a tool by admin.
    public function add_u_tool()
    {
        $name = $this->sanitize($_REQUEST['name']);
        $u_id = $_SESSION['u_id'];
        $date = date('Y-m-d H:i:s');
        
    if(!empty($_FILES['file']['name'])){

        $target_dir = 'dashboard/uploads/';
        $temp = $_FILES['file']['tmp_name'];
        $uniq = time().rand(1000,9999);
        $info = pathinfo($_FILES['file']['name']);

        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        //    Allow certain files formats
        if ($fileType !== "zip" && $fileType !== "rar" && $fileType !== "7z" ) {
            $info = '<div class="alert alert-danger"  role="alert">Sorry only .zip, .rar and .7z formats are allowed!</div>';
            return $info;
            die();
        }

        //  Check file size
        $size = $_FILES["file"]["size"];
        if ($size > 5000000) {
        $info ='<div class="alert alert-danger" role="alert">Sorry! file cannot be larger than 5MB</div>';
        return $info;
            die();
        }
        $file_name = "file_".$uniq.".".$info['extension']; //with your created name
        if(file_exists($target_dir.$file_name)){

            while(file_exists($target_dir)) {
        $temp = $_FILES['file']['tmp_name'];
        $uniq = time().rand(1000,9999);
        $info = pathinfo($_FILES['file']['name']);
        $file_name = "file_".$uniq.".".$info['extension']; //with your created name
            }

        move_uploaded_file($temp, $target_dir.$file_name);
        }

        move_uploaded_file($temp, $target_dir.$file_name);
        $attach = "`filename` ,";
        $value = "'{$file_name}' ,";
    }else{
        $attach = "`filename` ,";
        $value = "'' ,";
    }
        $sql = "INSERT INTO `user_tools` (`name`,`u_id`,".$attach."`status`,`date`) VALUES ('$name','$u_id',".$value."'2','$date')";
        $check = $this->query($sql);
        if ($check) {    
            $info = '<div class="alert alert-success">Tool added successfully!</div>';
        } else {
            $info = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $info;
    }
    

    // Function to delete a tool by admin.
    public function delete_tool()
    {
        $t_id = $_REQUEST['delete'];
        $sql = "DELETE FROM `tools` WHERE `t_id` = '$t_id'";
        $check = $this->query($sql);
        if ($check) {    
            $info = '<div class="alert alert-success">Tool deleted successfully!</div>';
        } else {
            $info = '<div class="alert alert-danger">An error occurred!</div>';
        }
        return $info;
    }
}