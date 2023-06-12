<?php
echo "<p>" . ossn_print('turnstile:com:note') . "</p>";
?>

<div>
    <label><?php echo ossn_print('turnstile:com:site_key'); ?></label>
    <?php if (isset($params['turnstile']) && isset($params['turnstile']->turnstile_site_key)): ?>
        <input type="text" name="turnstile_site_key" value="<?php echo $params['turnstile']->turnstile_site_key; ?>" />
    <?php else: ?>
        <input type="text" name="turnstile_site_key" value="" />
    <?php endif; ?>
</div>

<div>
    <label><?php echo ossn_print('turnstile:com:secret_key'); ?></label>
    <?php if (isset($params['turnstile']) && isset($params['turnstile']->turnstile_secret_key)): ?>
        <input type="text" name="turnstile_secret_key" value="<?php echo $params['turnstile']->turnstile_secret_key; ?>" />
    <?php else: ?>
        <input type="text" name="turnstile_secret_key" value="" />
    <?php endif; ?>
</div>

<div>
    <input type="submit" class="btn btn-success" />
</div>
