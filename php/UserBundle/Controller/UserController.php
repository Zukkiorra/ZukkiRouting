<?php
/**
 * handles requests for user
 */
class UserController
{
    
    public function getLoginForm()
    {
        echo "<form method='post' action='/loginUser'><input type='file' name='pera'><input type='submit' value='submit'></form>";
    }
    
    public function loginUser($user)
    {
        // echo "ovo dumpuje iz kontrolera:<br>";
        var_dump($user);
    }
}
