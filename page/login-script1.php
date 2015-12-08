<?php

$errors = array();
$blogMember = null;

$edit = array_key_exists('id', $_GET);
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
    Utils::redirect('home');
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    //pretending to have values in $_POST
    //$data = array('first_name' => 'Bob', 'no_of_passengers' => 2);
    $data = array(
        'username' => $_POST ['username'],
        'overall_rating' => $_POST ['overall_rating'],

    );
    // map
    BlogPostMapper::map($blogPost, $data);
    BlogRestaurantMapper::map($blogRestaurant, $data);
    BlogChipMapper::map($blogChip, $data);
    // validate
    $errors = BlogPostValidator::validate($blogPost);
    $errors = BlogRestaurantValidator::validate($blogRestaurant);
    $errors = BlogChipValidator::validate($blogChip);

    if (empty($errors)) {
        // save
        $blogPostDao = new BlogPostDao();
        $blogRestaurantDao = new BlogRestaurantDao();
        $blogChipDao = new BlogChipDao();
        $blogPost = $blogPostDao->save($blogPost);
        $blogRestaurant = $blogRestaurantDao->save($blogRestaurant);
        $blogChip = $blogChipDao->save($blogChip);
        Flash::addFlash('Thanks for the review Chipper!');
        // redirect
        Utils::redirect('home');
    }
}
