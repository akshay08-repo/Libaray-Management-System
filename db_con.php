<?php


$conn = mysqli_connect('localhost', 'root', '', 'library_management');

if($conn)
{
    echo "connected";
}
else
{
    echo "not connected";
}

?>