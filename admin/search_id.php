<?php
include 'db_connection.php';
include 'validate.php';
if (isset($_POST['search'])) {

    $regex = $_POST['search'];
    $query = "SELECT users.*, userdetails.* FROM users JOIN userdetails ON users.user_id = userdetails.user_id WHERE name LIKE'%$regex%' or email LIKE'%$regex%' or education LIKE'%$regex%' or country LIKE'%$regex%' ORDER by users.name ASC";
    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $email = $row['email'];
        $address = $row['address'];
        $image = $row['image'];
        $id = $row['user_id'];
        $education = $row['education'];
        $organization = $row['company'];
        $country = $row['country'];

        echo  '<table class="table">
                            <tr>
                               <th>Image</th><th>Name</th><th>Email</th><th>Education</th><th>Country</th><th class="">ACTION</th>
                            </tr>
                            <tr>
                                <td><img src="../users/'. $image .'" style="width: 50px" /></td><td>'. $name . '</td><td>'. $email .'</td><td>'.$education.'</td><td>'.$country.'</td><td><a class="link" href="users.php?userid='. $id . '">View more</a></td>
                            </tr>
                </table>';
    }

}
?>