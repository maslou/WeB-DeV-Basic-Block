<div id="post_<?php echo(htmlspecialchars($this->post['id']))?>" class="container well">
    <div class="row">
        <div id="post_data" class="col-sm-8 well">
            <div id="post_header_<?php echo(htmlspecialchars($this->post['id']))?>" class="row well-lg">
                <div id="post_title" class="col-sm-9">
                    <h3><?php echo(htmlspecialchars($this->post['Title']) )?></h3>
                </div>
                <div id="post_date" class="col-sm-3">
                    <div class="center"><?php echo(htmlspecialchars($this->post['Date'])) ?></div>
                </div>
            </div>
            <div id="post_text_<?php echo(htmlspecialchars($this->post['id']))?>" class="container row">
                <p><?php echo(htmlspecialchars($this->post['Text']));  ?></p>
            </div>
            <div id="post_tags_<?php echo(htmlspecialchars($this->post['id']))?>" class="container row">Tags:
                <?php foreach($this->tags as $tag): ?>
                    <a href="/home/postByTags/<?php echo(htmlspecialchars($tag['TagText']))?>"><?php echo(htmlspecialchars($tag['TagText']))?></a>
                <?php if($this->islogIn){?>
                    <a href="/posts/delPostTag/<?php echo(htmlspecialchars($tag['id']) .'/'. htmlspecialchars($this->post['id']) )?>"> x</a>
                <?php }?>
                <?php endforeach; ?>
            </div>
            <?php if($this->islogIn){?>
            <div id="post_text_<?php echo(htmlspecialchars($this->post['id']))?>" class="container row">
                <a href="/posts/editPost/<?php echo($this->post['id']); ?>">Edit</a>
                <a href="/posts/delPost/<?php echo($this->post['id']); ?>">X</a>
            </div>
            <?php }?>
        </div>
        <div id="post_comments" class="col-sm-4">
            <?php foreach($this->comments as $comment): ?>
                <div id="comment_id_<?php echo($comment['id'])?>" class="well">
                    <?php if($this->islogIn){?>
                    <a href="/posts/delPostComment/<?php echo(htmlspecialchars($this->post['id']. '/' . $comment['id'])); ?>">X</a>
                    <?php }?>
                    <div class="row"><?php echo(htmlspecialchars($comment['Username'])); echo("   ".htmlspecialchars($comment['date']));?></div>
                    <div class="row well-sm"><?php echo(htmlspecialchars($comment['Comment'])) ?></div>
                    <div class="row"><?php echo(htmlspecialchars($comment['Email']))?></div>
                </div>
            <?php endforeach; ?>

            <div id="paging" class="row">
                <ul class="list-inline">
                    <?php if($this->page>1){?>
                        <li><a href="/posts/<?php echo($this->viewAction);?>/<?php echo($this->post['id']);?>/<?php echo($this->page-1);?>">Back</a></li>
                    <?php }?>
                    <li><span>Page: <?php echo($this->page);?> of: <?php echo($this->allPages);?> </span></li>
                    <?php if($this->page<$this->allPages){?>
                        <li><a href="/posts/<?php echo($this->viewAction);?>/<?php echo($this->post['id']);?>/<?php echo($this->page+1);?>">Next</a></li>
                    <?php }?>
                </ul>
            </div>


        </div>
    </div>
    <?php if($this->islogIn){?>
    <div class="row well" id="addPostTags">
        <div class="col-sm-6">
            <form class="form-inline" method="post" action="/posts/addTag/<?php echo(htmlspecialchars($this->post['id']))?>">
                <fieldset>
                    <div class="form-group">
                        <label for="selectTag" class="control-label">Select Tag to add</label>
                        <select name="selectTag" class="form-control" required="">
                            <option value=" "> </option>
                            <?php foreach($this->allTags as $tag):?>
                                <option value="<?php echo(htmlspecialchars($tag['id']))?>"><?php echo(htmlspecialchars($tag['TagText']))?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input name="postId" hidden="" value="<?php echo(htmlspecialchars($this->post['id']))?>">
                        <button formaction="/posts/addTag/<?php echo(htmlspecialchars($this->post['id']))?>" type="submit">Add</button>
                    </div>
                    <div class="form-group">
                        <button formaction="/posts/delTag/<?php echo(htmlspecialchars($this->post['id']))?>" type="submit">Delete</button>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="col-sm-6">
            <form class="form-inline" method="post" action="/posts/createTag/<?php echo(htmlspecialchars($this->post['id']))?>">
                <fieldset>
                    <div class="form-group">
                        <label for="TagText" class="control-label">Tag Text:</label>
                        <input name="TagText" class="form-control" id="TagText" type="text"required>
                    </div>
                    <div class="form-group">
                        <input name="postId" hidden="" value="<?php echo(htmlspecialchars($this->post['id']))?>">
                        <button type="submit">Create</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php } ?>
</div>

<div id="add_comments<?php echo(htmlspecialchars($this->post['id']))?>" class="container well">
    <form class="form-inline" method="post" action="/posts/addComment/<?php echo(htmlspecialchars($this->post['id']))?>">
        <fieldset>
            <div class="form-group col-sm-9">
                <label for="comment" class="control-label">Comment</label>
                <textarea name="comment" class="form-control" id="commentText" required="" rows="5" cols="40"></textarea>
                <button type="submit">Comment</button>
            </div>
            <div class="form-group col-sm-3">
                <label for="name" class="control-label">Name</label>
                <input name="name" class="form-control" id="commentName" type="text"required="">
                <label for="email" class="control-label">Email</label>
                <input name="email" class="form-control" id="commentEmail" type="text"required="">
            </div>
        </fieldset>
    </form>
</div>