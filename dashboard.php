<?php
session_start();
$fb = $_SESSION['fb'];
echo "<b>Anda berhasil login!!</b>" . "<br>";
echo "Name: ". $fb['name'] . "<br>";
echo "First name: ". $fb['first_name'] . "<br>";
echo "Last name: ". $fb['last_name'] . "<br>";
echo "Email: ". $fb['email'] . "<br>";
echo "<img src='".$fb['picture_url'] . "' /><br>";