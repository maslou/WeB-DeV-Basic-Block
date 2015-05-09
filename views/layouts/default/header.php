<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="/content/styles.css" />
    <link rel="stylesheet" href="/content/bootstrap.min.css" />
    <title>
        <?php if (isset($this->title)) echo htmlspecialchars($this->title) ?>
    </title>
</head>

<body>
    <header>
        <a href="/"><img src="/content/images/site-logo.png"></a>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/author">Author</a></li>
            <?php if(!$this->islogIn){?>
                <li><a href="/account/logIn">Login</a></li>
            <?php }else{?>
                <li><a href="/posts/add">New Post</a></li>
                <li><a href="/account/logOut">LogOut</a></li>
            <?php }?>
        </ul>
    </header>

<?php

if (isset($_SESSION['messages'])) {
    echo '<ul>';
    foreach ($_SESSION['messages'] as $msg) {
        echo '<li class="' . $msg['type'] . '">';
        echo htmlspecialchars($msg['text']);
        echo '</li>';
    }
    echo '</ul>';
    unset($_SESSION['messages']);
}
?>