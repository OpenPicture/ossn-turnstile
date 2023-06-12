<?php
$turnstileCom = new OssnComponents();

$turnstile = $turnstileCom->getSettings('turnstile');
?>

<div class="margin-top-10">
  <div class="cf-turnstile" data-sitekey="<?= $turnstile->turnstile_site_key ?>"></div>
</div>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<style>
@media only screen and (max-width: 500px) {
.cf-turnstile {
transform:scale(0.77);
transform-origin:0 0;
}
}
@media only screen and (max-width: 991px) and (min-width: 768px) {
.cf-turnstile {
transform:scale(0.86);
transform-origin:0 0;
}
}
</style>