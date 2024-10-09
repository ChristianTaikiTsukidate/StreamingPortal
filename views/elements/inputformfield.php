<?php
function createinputformfield($title, $value, $type)
{
    ?>
    <div class="col">
        <label for="<?php echo $title; ?>"><?php echo $title; ?></label>
        <input type="<?php echo $type; ?>" class="form-control" id="<?php echo $title; ?>" name="<?php echo $title; ?>" placeholder="<?php echo $title; ?>" value="<?php echo $value; ?>" required>
    </div>
    <?php
}

function createinputformfieldMinMax($title, $value, $type, $min, $max, $step)
{
    ?>
    <div class="col">
        <label for="<?php echo $title; ?>"><?php echo $title; ?></label>
        <input type="<?php echo $type; ?>" class="form-control" id="<?php echo $title; ?>" name="<?php echo $title; ?>" min="<?php echo $min; ?>" max="<?php echo $max; ?>" step="<?php echo $step; ?>" placeholder="<?php echo $title; ?>" value="<?php echo $value; ?>" required>
    </div>
    <?php
}
?>