<?php

$errors = array();
$blogMember = null;
$year = time() + 31536000;
setcookie('remember_me', $_POST['username'], $year);

if($_POST['remember']) {
setcookie('remember_me', $_POST['username'], $year);
}
elseif(!$_POST['remember']) {
	if(isset($_COOKIE['remember_me'])) {
		$past = time() - 100;
		setcookie(remember_me, gone, $past);
	}
}

$edit = array_key_exists('member_id', $_GET);
if ($edit) {
    $blogMember = Utils::getBlogMemberByGetId();
} else {
    // set defaults
    $blogMember = new BlogMember();
    //$flightBooking->setPriority(Todo::PRIORITY_MEDIUM);
    //$dueOn = new DateTime("+1 day");
    //$dueOn->setTime(0, 0, 0);
    //$flightBooking->setDueOn($dueOn);
}

if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('list-view.php');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    //pretending to have values in $_POST
    //$data = array('first_name' => 'Bob', 'no_of_passengers' => 2);
    $data = array(
        'username' => $_POST ['username'],
        'password' => $_POST ['password'],

    );
    // map
    BlogMemberMapper::map($blogMember, $data);
    // validate
    $errors = BlogMemberValidator::validate($blogMember);


    if (empty($errors)) {
        // save
        $blogMemberDao = new BlogMemberDao();
        $blogMember = $blogMemberDao->save($blogMember);
        Flash::addFlash('Login Succesful!');
        // redirect
        Utils::redirect('list-view.php');
    }
}
