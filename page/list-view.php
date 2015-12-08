<?php require 'partials/flashes.php' ?>
<?php require 'partials/flashes.php'?>
<h1>Dashboard</h1>
<p>Hello Chipper!</p>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
</div>
</body>

<a href="index.php?page=add-edit">Make a Review</a>
<h1><?php echo $title; ?></h1>

<?php if (empty($blogPosts)): ?>
    <p>No reviews found.</p>

<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name of Restaurant</th>
                <th>Overall Rating</th>
                <th>Created by</th>
                <th>Modified By</th>

                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($blogPosts as $blogPost): ?>
                <tr>
                    <td><?php echo Utils::escape(Utils::formatDateTime($blogPost->getDate())); ?></td>
                    <td><?php echo $blogPost->getNameOfRestaurant(); ?></td>
                    <td><?php echo $blogPost->getOverallRating(); ?></td>
                    <td><?php echo $blogPost->getCreatedBy(); ?></td>
                    <td><?php echo $blogPost->getModifiedBy(); ?></td>
                    <td><?php echo $blogPost->getDescription(); ?></td>
                    
                    <td><a href="index.php?page=add-edit&id=<?php echo $blogPost->getId(); ?>">Edit</a> | 
                        <a href="index.php?page=change-status&id=<?php echo $blogPost->getId(); ?>&cmd=<?php echo BlogPost::VOIDED; ?>&status=<?php echo $blogPost->getStatus(); ?>">Delete</a></td>
                </tr>
    <?php endforeach; ?>
        </tbody>
    </table>
        <?php endif; ?>
