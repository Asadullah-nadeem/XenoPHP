<?php
use Illuminate\Foundation\Vite;
use Tighten\Ziggy\BladeRouteGenerator;
use Inertia\Ssr\Gateway;

$ziggy = app(BladeRouteGenerator::class)->generate();
$vite = app(Vite::class);
$ssr = null;

if (!isset($__inertiaSsrDispatched)) {
    $__inertiaSsrDispatched = true;
    try {
        $ssr = app(Gateway::class)->dispatch($page);
    } catch (Exception $e) {
        $ssr = null;
    }
}

$locale = str_replace('_', '-', app()->getLocale());
$title = e(config('app.name', 'XenoPHP'));
?>
<!DOCTYPE html>
<html lang="<?= $locale ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia><?= $title ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <?= $ziggy ?>
    <?= $vite->reactRefresh() ?>
    <?= $vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"]) ?>
    <?php if ($ssr): ?>
        <?= $ssr->head ?>
    <?php endif; ?>
</head>

<body class="font-sans antialiased">
    <?php if ($ssr): ?>
        <?= $ssr->body ?>
    <?php elseif (config('inertia.use_script_element_for_initial_page')): ?>
        <script data-page="app" type="application/json"><?= json_encode($page) ?></script>
        <div id="app"></div>
    <?php else: ?>
        <div id="app" data-page="<?= e(json_encode($page)) ?>"></div>
    <?php endif; ?>
</body>

</html>

