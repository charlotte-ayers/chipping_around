        <ul>
<!--            <li><a href="index.php">Home</a></li>-->
            <li><a href="index.php?page=list&status=pending">DashBoard</a></li>
            <b id="logout"><a href="chipping_around/page/logout.php">Log Out</a></b>
        </ul>
<h1>Make a Review</h1>

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
            <label>Name of Restaurant:</label>
            <input type="text" name="name_of_restaurant" value="<?php echo Utils::escape($blogRestaurant->getNameOfRestaurant()); ?>"/>
        </div>
        <div class="field">
            <label>Date:</label>
            <input type="date" name="date" value="<?php echo Utils::escape($blogPost->getDate()->format('Y-m-d')); ?>"/>
        </div>
        <div class="field">
            <label>Overall Rating:</label>
            <select name="overall_rating">
<?php for ($i = 1; $i < 11; ++$i): ?>
                    <option value="<?php echo $i; ?>"
                    <?php if ($i == $blogRestaurant->getOverallRating()): ?>
                                selected="selected"
                    <?php endif; ?>
                            ><?php echo $i; ?></option>
                        <?php endfor; ?>
            </select>            
        </div>
        <div class="field">
            <label>Content:</label>
            <textarea cols="50" rows="4" type="text" name="content" value="<?php echo Utils::escape($blogPost->getContent()); ?>"></textarea>
        </div>
        <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
  <script>
          tinymce.init({
              selector: "textarea",
              plugins: [
                  "advlist autolink lists link image charmap print preview anchor",
                  "searchreplace visualblocks code fullscreen",
                  "insertdatetime media table contextmenu paste"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
          });
  </script>
        
        <fieldset>
            <legend>Chip Score</legend>
            <div class="field">
                <label>Colour:</label>
                <select name="chip_colour">
<?php for ($i = 1; $i < 11; ++$i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php if ($i == $blogChip->getChipColour()): ?>
                                    selected="selected"
                        <?php endif; ?>
                                ><?php echo $i; ?></option>
                            <?php endfor; ?>
                </select>            
            </div>
            <div class="field">
                <label>Crunch:</label>
                <select name="chip_crunch">
<?php for ($i = 1; $i < 11; ++$i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php if ($i == $blogChip->getChipCrunch()): ?>
                                    selected="selected"
                        <?php endif; ?>
                                ><?php echo $i; ?></option>
                            <?php endfor; ?>
                </select>            
            </div>
            <div class="field">
                <label>Consistency:</label>
                <select name="chip_consistency">
<?php for ($i = 1; $i < 11; ++$i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php if ($i == $blogChip->getChipConsistency()): ?>
                                    selected="selected"
                        <?php endif; ?>
                                ><?php echo $i; ?></option>
                            <?php endfor; ?>
                </select>            
            </div>
            <div class="field">
                <label>Condiments:</label>
                <select name="chip_condiments">
<?php for ($i = 1; $i < 11; ++$i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php if ($i == $blogChip->getChipCondiments()): ?>
                                    selected="selected"
                        <?php endif; ?>
                                ><?php echo $i; ?></option>
                            <?php endfor; ?>
                </select>            
            </div>
            <div class="field">
                <label>Cash:</label>
                <select name="chip_cash">
<?php for ($i = 1; $i < 11; ++$i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php if ($i == $blogChip->getChipCash()): ?>
                                    selected="selected"
                        <?php endif; ?>
                                ><?php echo $i; ?></option>
                            <?php endfor; ?>
                </select>            
            </div>
            <div class="field">
                <label>Charisma:</label>
                <select name="chip_charisma">
<?php for ($i = 1; $i < 11; ++$i): ?>
                        <option value="<?php echo $i; ?>"
                        <?php if ($i == $blogChip->getChipCharisma()): ?>
                                    selected="selected"
                        <?php endif; ?>
                                ><?php echo $i; ?></option>
                            <?php endfor; ?>
                </select>            
            </div>
        </fieldset>
        <div class="wrapper">
            <input type="submit" name="cancel" value="CANCEL" class="submit" />
            <input type="submit" name="save" value="<?php echo $edit ? 'EDIT' : 'ADD'; ?>" class="submit" />
        </div>
    </fieldset>
</form>

