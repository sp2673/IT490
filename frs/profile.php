<?php
require 'includes/init.php';

if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){
    $user_data = $user_obj->find_user_by_id($_SESSION['user_id']);
    if($user_data ===  false){
        header('Location: logout.php');
        exit;
    }
    // FETCH ALL USERS WHERE ID IS NOT EQUAL TO MY ID
    $all_users = $user_obj->all_users($_SESSION['user_id']);
}
else{
    header('Location: logout.php');
    exit;
}
// REQUEST NOTIFICATION NUMBER
$get_req_num = $frnd_obj->request_notification($_SESSION['user_id'], false);
// TOTAL FRIENDS
$get_frnd_num = $frnd_obj->get_all_friends($_SESSION['user_id'], false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo  $user_data->username;?></title>
    <link rel="stylesheet" href="">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
</head>
<body>
    <div class="profile_container">
        
        <div class="inner_profile">
            <div class="img">
                <!-- <img src="profile_images/<?php echo $user_data->user_image; ?>" alt="Profile image"> -->
            </div>
            <h1><?php echo  $user_data->username;?></h1>
        </div>
        <nav>
            <ul>
                <li><a href="profile.php" rel="noopener noreferrer" class="active">Home</a></li>
                <li><a href="notifications.php" rel="noopener noreferrer">Requests<span class="badge <?php
                if($get_req_num > 0){
                    echo 'redBadge';
                }
                ?>"><?php echo $get_req_num;?></span></a></li>
                <li><a href="friends.php" rel="noopener noreferrer">Friends<span class="badge"><?php echo $get_frnd_num;?></span></a></li>
                <li><a href="logout.php" rel="noopener noreferrer">Logout</a></li>
            </ul>
        </nav>
        <div class="all_users">
            <h3>All Users</h3>
            <div class="usersWrapper">
                <?php
                if($all_users){
                    foreach($all_users as $row){
                        echo '<div class="user_box">
                                <div class="user_img"><img src="profile_images/'.$row->user_image.'" alt="Profile image"></div>
                                <div class="user_info"><span>'.$row->username.'</span>
                                <span><a href="user_profile.php?id='.$row->id.'&email='.$row->user_email.'" class="see_profileBtn">See profile</a></div>
                            </div>';
                    }
                }
                else{
                    echo '<h4>There is no user!</h4>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>