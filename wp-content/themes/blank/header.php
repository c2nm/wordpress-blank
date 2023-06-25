<?php
echo \WP\Core::asciiArt();
?>

<!DOCTYPE html>
<html <?= language_attributes() ?>
        class="font-base responsive-typography selection-color scrollbar <?= (!\WP\Core::isProduction() ? 'dev' : '') ?>">
<head>
    <meta charset="<?= get_bloginfo('charset') ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, minimum-scale=1"/>
    <?= wp_head() ?>
</head>
<body <?= body_class() ?>>
<?php include '_templates/_common/header.php'; ?>
