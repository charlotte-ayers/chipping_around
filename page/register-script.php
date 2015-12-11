<?php

$errors = array();
$blogMember = null;

$edit = array_key_exists('member_id', $_GET);
if ($edit) {
    $blogMember = Utils::getBlogMemberByGetId();
} else {
    // set defaults
    $blogMember = new BlogMember();
//    $blogMember->setDate(new DateTime());
    //$flightBooking->setPriority(Todo::PRIORITY_MEDIUM);
    //$dueOn = new DateTime("+1 day");
    //$dueOn->setTime(0, 0, 0);
    //$flightBooking->setDueOn($dueOn);
}

if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('list');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    //pretending to have values in $_POST
    //$data = array('first_name' => 'Bob', 'no_of_passengers' => 2);
//        private $id;
//    private $date;
//    private $content;
//    private $createdBy;
//    private $modifiedBy;
//    private $description;
//    private $nameOfRestaurant;
//    private $overallRating;
//    private $restaurant_id;
//    private $username;
//    private $status = self::PENDING;
    $data = array(
        'username' => $_POST ['username'],
        'email' => $_POST ['email'],
        'password' => $_POST ['password']
    );
    // map
    BlogMemberMapper::map($blogMember, $data);
    // validate
    $errors = BlogMemberValidator::validate($blogMember);

    if (empty($errors)) {
        // save
        $blogMemberDao = new BlogMemberDao();
        $blogMember = $blogMemberDao->save($blogMember);
        Flash::addFlash('Thanks for Registering Chipper!');
        // redirect
        Utils::redirect('list', array ('status'=>'pending'));
    }
}
