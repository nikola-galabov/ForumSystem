<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/public/libs/bootstrap-3.3.4-dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/public/styles.css"/>
    <title><?php echo($this->pageTitle)?></title>
</head>
<body>
<div class="page-header">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">Forum system</a>
            <?php if($this->user == null) : ?>
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            <?php endif; ?>
        </div>
        <?php
        if($this->user == null) { ?>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul id="navigation" class="nav navbar-nav navbar-right">
                    <li><a href="/users/register">Register</a></li>
                    <li><a href="/users/login">Login</a></li>
                </ul>
            </div>
        <?php
        } else { ?>
            <div class="user">
                <span class="glyphicon glyphicon-user" data-aria-hidden="true"></span>
                <span><?php $this->escapeAndPrint($this->user); ?></span>

                <form method="post" action="/users/logout"><input class="btn-link" type="submit" value="logout"/></form>
            </div>
        <?php } ?>
    </div>
</div>
<div id="content" class="container">
<?php
if(isset($_SESSION['messages'])) :
    foreach($_SESSION['messages'] as $message):
        foreach($message as $type => $text):
?>
        <div class="alert alert-<?php $this->escapeAndPrint($type); ?>"><?php $this->escapeAndPrint($text); ?></div>
<?php
        endforeach;
endforeach;

unset($_SESSION['messages']);
endif;
?>