<?php
function createMultiselect($arr, $label, $selectedArr): void
{
    ?>
    <label class="col-2" for="<?php echo $label; ?>"><?php echo $label; ?></label>
    <div class="col" id="<?php echo $label; ?>">
        <?php foreach ($arr as $item) { ?>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="<?php echo $label; ?>[]" value="<?php echo $item; ?>" id="<?php echo $item; ?>"
                    <?php if (in_array($item, $selectedArr)) { echo "checked"; } ?> class="required-checkbox-<?php echo $label; ?>">
                <label class="form-check-label" for="<?php echo $item; ?>">
                    <?php echo $item; ?>
                </label>
            </div>
        <?php } ?>
    </div>
    <?php
}
?>