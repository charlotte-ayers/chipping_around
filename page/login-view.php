<h1>Please Log In</h1>

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
        
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo Utils::escape($blogMember->getUsername()); ?>"/>
        
        <div class="field">
            <label>Password:</label>
            <input type="text" name="password" value="<?php echo Utils::escape($blogMember->getPassword()); ?>"/>
        </div>
        </fieldset>
        <div class="wrapper">
            <input type="checkbox" name="remember" value="1">Remember Me
<!--            <input type="submit" name="cancel" value="CANCEL" class="submit" />-->
            <input type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>" class="submit" />
        </div>
    </fieldset>
</form>

