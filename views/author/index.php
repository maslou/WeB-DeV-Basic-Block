<div id="author" class="container well">
    <div id="post_data" class="col-sm-9 well">
        <div id="author_header" class="row well-sm">
            <div id="author_FirstName" class="col-sm-3"><?php echo(htmlspecialchars($this->author['FirstName']))?></div>
            <div id="author_LastName" class="col-sm-3"><?php echo(htmlspecialchars($this->author['LastName']))?></div>
            <div id="author_Email" class="col-sm-3"><?php echo(htmlspecialchars($this->author['Email']))?></div>
        </div>
        <div id="author_info" class="row well-lg">
            <p><?php echo(htmlspecialchars($this->author['Info']))?></p>
        </div>
        <?php if($this->islogIn){?>
        <div id="button" class="row well-lg">
            <a href="/author/edit/">Edit</a>
        </div>
        <?php }?>
    </div>
</div>



