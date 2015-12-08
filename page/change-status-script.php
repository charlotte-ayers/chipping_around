<?php
//status of list
$status = Utils::getUrlParam('status');
//command
$cmd = Utils::getUrlParam('cmd');
$blogPost = Utils::getBlogPostByGetId();
$blogPost->setStatus($cmd);
//if (array_key_exists('comment', $_POST)) {
//    $todo->setComment($_POST['comment']);
//}

$dao = new BlogPostDao();
$dao->save($blogPost);
$msg = '';
if($cmd === BlogPost::VOIDED){
    $msg = 'Review deleted successfully.';
}else{
    $msg = 'Review status changed successfully.';
}
Flash::addFlash($msg);

Utils::redirect('list', array('status' => $status));

