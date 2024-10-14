<?php
function createFilterDropdown($arr, $dropdowntype)
{
    ?>
    <div class="dropdown">
        <button class="btn dropdown-toggle dropdownbtn" type="button"
                type="button"><?php echo $dropdowntype; ?></button>
        <div class="dropdown-content filterDropdown"
             id="<?php echo strtolower(str_replace(' ', '', $dropdowntype)) . "filter"; ?>">
            <input type="text" placeholder="Search.." class="filterInput">
            <?php
            foreach ($arr as $value) {
                ?>
                <a class="filterOption"><?php echo $value ?></a>
            <?php } ?>
        </div>
    </div>
    <?php
} ?>
