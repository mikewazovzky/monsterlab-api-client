<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>API Client</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="/public/images/favicon.ico" type="image/x-icon">
+   <link rel="icon" href="/public/images/favicon.ico" type="image/x-icon">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <style>
        .panel, #status { margin-bottom: 5px; }
        .inline { display: inline; }
        .level { display: flex; align-items: center; }
        .flex { flex: 1; }
        .tags { padding-left: 0; display: inline; }
        .tags li { list-style: none; display: inline; }
        .tags li:after { content: " | "; }
        .tags li:last-child:after { content: none; }
        /* Styling Vue component(s) */
        .checkbox { display: inline; }
        .request-builder select { padding: 3px 5px; border-radius: 3px; }
        .request-builder input { padding: 3px 5px; border-radius: 3px; }
        .param { padding-top: 3px; padding-bottom: 3px; }
        .param .key { display: inline-block; width: 100px; }

    </style>
</head>
<body>
    <div id="root" class="container">
        <div class="page-header">
            <h1>M-lab API Client</h1>
        </div>

        <div class="panel panel-default controls">
            <div class="panel-body">
                <?php include('controls.php'); ?>
            </div>
        </div>

        <strong><em>Status/Response:</em></strong>
        <status message="<?php echo(session('status')); ?>"></status>

        <?php include('auth.php'); ?>

        <request-builder
            v-show="showBuilder"
            host="<?php echo(config('oauth.host')); ?>">
        </request-builder>

        <?php if (isset($_SESSION['posts'])) : ?>
            <?php include('posts.php'); ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
<!--<script src="/public/js/libs/vue.js"></script>-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="module" src='/public/js/main.js'></script>

</body>
</html>
