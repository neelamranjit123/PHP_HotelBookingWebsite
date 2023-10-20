<?php

// if session status is none then start the session
//https://www.php.net/manual/en/function.session-status.php

if (session_status() === PHP_SESSION_NONE) {
  session_start();

  //function to check if the user is logged else send to the login page
  function checkUser()
  {

    $_SESSION['URI'] = '';

    if ($_SESSION['loggedin'] == 1)

      return TRUE;

    else {
      $_SESSION['URI'] = 'http://localhost/bookaroom/' . $_SERVER['REQUEST_URI']; //save current url for redirect
      header('Location: http://localhost/bookaroom/', true, 303);
    }
  }


  //just to show we are logged in
  function loginStatus()
  {

    $un = $_SESSION['username'];

    if ($_SESSION['loggedin'] == 1) {


      echo "<h6>Logged in as $un</h6>";
    } else {

      echo "<h5>Logged out</h5>";
    }
  }

  function checkAdmin()
  {
    $_SESSION['URI'] = '';
    if ($_SESSION['loggedin'] == 1)
      return TRUE;
    else {
      $_SESSION['URI'] = 'http://localhost/bookaroom/' . $_SERVER['REQUEST_URI']; //save current url for redirect      
    }
  }

  //log a user in
  function login($id, $username)
  {

    if ($_SESSION['loggedin'] == 0 and !empty($_SESSION['URI']))
      $uri = $_SESSION['URI'];

    else {
      $_SESSION['URI'] = 'http://localhost/bookaroom/bookinglisting.php';
      $uri = $_SESSION['URI'];
    }

    header('Location: ' . $uri, true, 303);
    header('Location: http://localhost/bookaroom/bookinglisting.php' , true, 303); //you can put the uri inside the location.

    $_SESSION['loggedin'] = 1;
    $_SESSION['userid'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['URI'] = '';
  }


  //simple logout function
  function logout()
  {
    $_SESSION['loggedin'] = 0;
    $_SESSION['userid'] = -1;
    $_SESSION['username'] = '';
    $_SESSION['URI'] = '';
    header('Location: http://localhost/bookaroom/login.php', true, 303);
  }
}
