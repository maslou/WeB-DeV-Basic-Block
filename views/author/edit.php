<?php if($this->islogIn){?>
<div id="add_post" class="container well">
    <form class="form-horizontal col-lg-12" method="post" action="/author/edit">
        <fieldset>
            <div class="form-group col-sm-3">
                <label for="title" class="control-label">First Name:*</label>
                <input type="text" name="firstName" class="form-control" required="" value="<?php echo(htmlspecialchars($this->author['FirstName'])) ?>">
             </div>
            <div class="form-group col-sm-3">
                <label for="lastName" class="control-label">Last Name:*</label>
                <input type="text" name="lastName" class="form-control" required="" value="<?php echo(htmlspecialchars($this->author['LastName'])) ?>">
            </div>
            <div class="form-group col-sm-8">
                <label for="authorInfo" class="control-label">Info:*</label>
                <textarea rows="5" class="form-control" required="" name="authorInfo"><?php echo(htmlspecialchars($this->author['Info'])) ?></textarea>
            </div>
            <div class="form-group col-sm-5">
                <label for="email" class="control-label">Email</label>
                <input class="form-control" type="email" name="email" value="<?php echo(htmlspecialchars($this->author['Email'])) ?>">
            </div>
            <div class="form-group col-sm-9">
                <button type="submit">Edit</button>
            </div>
        </fieldset>
    </form>
</div>
<?php }?>