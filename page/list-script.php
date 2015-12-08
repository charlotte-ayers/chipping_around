<?php
$status = Utils::getUrlParam('status');
//TodoValidator::validateStatus($status);
//
$blogPostDao = new BlogPostDao();
$blogRestaurantDao = new BlogRestaurantDao();
//$blogChipDao = new BlogChipDao();

// data for template
$title = ucfirst($status) . ' reviews';
$blogPosts = $blogPostDao->find($status);
//$blogRestaurants = $blogRestaurantDao->find($status);
//$blogChips = $blogChipDao->find($status);

