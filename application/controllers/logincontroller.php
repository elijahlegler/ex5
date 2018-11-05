<?php

class LoginController extends Controller{

   protected $userObject;

   public function do_login() {
	   $this->userObject = new users();

		 if ($this->userObject->checkUser($_POST['email'],$_POST['password'])) {
       $userInfo = $this->userObject->getUserFromEmail($_POST['email']);

       $_SESSION['uID'] = $userInfo['uID'];

       if (strlen($_SESSION['redirect']) > 0) {
         $view = $_SESSION['redirect'];
         unset($_SESSION['redirect']);
         header('Location: ' . BASE_URL . $view);
       }
       else {
         header('Location: ' . BASE_URL);
       }

       header('Location: ' .BASE_URL);
		 }
		 else {
			 $this->set('error', 'Wrong Password/Email Combination');
		 }
   }

   public function logout() {

     //unset session ID
     unset($_SESSION['uID']);

     //close the session
     session_write_close();

     //send to the homepage
     header('Location:' . BASE_URL);
   }
}
