<?php if($this->islogIn){?>
<div id="add_post" class="container well">
    <form class="form-horizontal col-lg-12" method="post" action="/posts/<?php echo(htmlspecialchars($this->postAction))?>" >
        <fieldset>
            <div class="form-group col-sm-7"">
                <input type="text"  name="id" hidden="" value="<?php echo(htmlspecialchars($this->post['id'])) ?>">
                <label for="title" class="control-label" >Title*</label>
                <input type="text" name="title" class="form-control" required="" value="<?php echo(htmlspecialchars($this->post['Title']) )?>">
            </div>
            <div class="form-group col-sm-7">
                <label for="text" class="control-label">Text*</label>
                <textarea rows="10" name="text" class="form-control" required=""><?php echo(htmlspecialchars($this->post['Text'])) ?></textarea>
            </div>
            <div class="form-group col-sm-9">
                <button type="submit">Post</button>
            </div>
        </fieldset>
    </form>
</div>
<?php }?>