<?php
function createStreamingServiceIcon($provider)
{ ?>
    <div class="col-2">
        <img alt="<?= $provider['provider'] ?>"
             title="<?= $provider['provider'] ?>"
             src="<?= $provider['logo'] ?>"
             class="streamingService">
    </div>
    <?php
} ?>
