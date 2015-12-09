<?php

$errors = array();
$blogPost = null;

$edit = array_key_exists('id', $_GET);
if ($edit) {
    $blogPost = Utils::getBlogPostByGetId();
} else {
    // set defaults
    $blogPost = new SimpleBlogPost();
    $blogPost->setDate(new DateTime());
    $blogRestaurant = new BlogRestaurant();
    $blogChip = new BlogChip();
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
        'name_of_restaurant' => $_POST ['name_of_restaurant'],
        'overall_rating' => $_POST ['overall_rating'],
        'content' => $_POST ['content'],
        'chip_colour' => $_POST ['chip_colour'],
        'chip_crunch' => $_POST ['chip_crunch'],
        'chip_condiments' => $_POST ['chip_condiments'],
        'chip_consistency' => $_POST ['chip_consistency'],
        'chip_cash' => $_POST ['chip_cash'],
        'chip_charisma' => $_POST ['chip_charisma'],
        'date' => $_POST ['date'] . ' 00:00:00'
    );
    // map
    BlogPostMapper::simpleMap($blogPost, $data);
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
