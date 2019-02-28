<?php
// Bootstrap the app
require 'Outlinks.php';
$allowedDomains = require 'allowed.php';
$app = new Outlinks($_GET, $allowedDomains);
$app->autoRedirect();

// Here comes the view!
function e(string $string): string
{
    return htmlspecialchars($string, ENT_COMPAT|ENT_HTML5, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="referrer" content="no-referrer">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Outlinks</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <div class="container my-2 my-sm-4 my-md-5">
            <h1>Outlinks</h1>
            <hr />
            <?php if ($app->isValidUrl()): ?>
                <dl class="row">
                    <dt class="col-sm-2 col-lg-1">Secure?</dt>
                    <dd class="col-sm-10 col-lg-11"><?= $app->isHttps() ? '🔐 Yes' : '⚠️ No' ?></dd>
                    <dt class="col-sm-2 col-lg-1">Host</dt>
                    <dd class="col-sm-10 col-lg-11 text-break"><code><?= e($app->getHost()) ?></code></dd>
                </dl>
                <div class="alert alert-info lead text-break py-lg-4 mb-5">
                    <a class="alert-link" href="<?= e($app->getUrl()) ?>"><?= e($app->getUrl()) ?></a>
                </div>
                <details class="text-muted">
                    <summary class="mb-2">All query parameters</summary>
                    <pre class="small text-muted"><?= e(print_r($_GET, true)) ?></pre>
                </details>
            <?php else: ?>
                <p>⛔️ Invalid URL specified</p>
            <?php endif; ?>
        </div>
    </body>
</html>
