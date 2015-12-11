<h1>Register</h1>

<?php if (!empty($errors)): ?>
    <ul class="errors">
        <?php foreach ($errors as $error): ?>
            <?php /* @var $error Error */ ?>
            <li><?php echo $error->getMessage(); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="#" method="post">
    <fieldset>
        <div class="field">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo Utils::escape($blogMember->getUsername()); ?>"/>
        </div>
                <div class="field">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo Utils::escape($blogMember->getEmail()); ?>"/>
        </div>
        <div class="field">
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo Utils::escape($blogMember->getPassword()); ?>"/>
        </div>
        <div class="field">
            <label>Confirm Password:</label>
            <input type="password" name="password" value="<?php echo Utils::escape($blogMember->getPassword()); ?>"/>
        </div>
        
        
        </fieldset>
        <div class="wrapper">
<!--            <input type="submit" name="cancel" value="CANCEL" class="submit" />-->
            <input type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>" class="submit" />
        </div>
    </fieldset>
</form>

