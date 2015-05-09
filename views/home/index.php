<div class="container well">
<div class="col-lg-3">
    <aside id="sidebar">
        <section id="widget_1">
            <div class="well">
                <a href="/home/newPosts">Newest</a>
            </div>
        </section>
        <section id="widget_2">
            <div class="well">
                <a href="/home/popular">Most Popular</a>
            </div>
        </section>
        <section id="widget_3">
            <div class="well">
                    <form class="form-horizontal" method="post" action="/home/postByTagsName">
                        <fieldset>
                            <div class="form-group">
                                <label for="selectTag" class="control-label">Select Tag</label>
                                <select name="selectTag" class="form-control" required="">
                                    <?php foreach($this->allTags as $tag):?>
                                        <option value="<?php echo(htmlspecialchars($tag['TagText']))?>"><?php echo(htmlspecialchars($tag['TagText']))?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit">Search By Tag</button>
                            </div>
                        </fieldset>
                    </form>
            </div>
        </section>
        <section id="widget_4">
            <div class="well">
            <div class="row">Popular Tags:</div>
            <div class="btn-group">
                <?php foreach($this->popTag as $tag): ?>
                    <a class="btn-link" href="/home/postByTags/<?php echo(htmlspecialchars($tag['TagText']))?>"><?php echo(htmlspecialchars($tag['TagText']))?></a>
                <?php endforeach; ?>
            </div>
            </div>
        </section>
    </aside>
</div>
<div class="col-lg-8">
    <div id="post_items" class="well row">
        <?php foreach($this->blogs as $blog): ?>
            <div  class="row">
                <div id="blog_id_<?php echo($blog['id']); ?>"class="well">
                    <div id="blog_title_<?php echo($blog['id']); ?>" class="row">
                        <a href="/posts/view/<?php echo($blog['id']); ?>" class="col-sm-6"><?php echo($blog['Title']); ?></a>
                        <div class="col-sm-6"><?php echo($blog['Date']); ?></div>
                    </div>
                    <div class="row container"><?php echo($blog['Text']);?></div>
                    <div id="blog_info_<?php echo($blog['id']); ?>" class="row">
                        <div class="col-sm-5" name = "visits">Views: <?php echo($blog['Visits']); ?></div>
                        <div class="col-sm-4">
                            <a href="/posts/view/<?php echo($blog['id']); ?>">Read</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div id="paging" class="row">
        <ul class="list-inline">
            <?php if($this->page>1){?>
                <li><a href="/home/<?php echo($this->viewAction);?>/<?php echo($this->page-1);?>">Back</a></li>
            <?php }?>
            <li><span>Page: <?php echo($this->page);?> of: <?php echo($this->allPages);?> </span></li>
            <?php if($this->page<$this->allPages){?>
                <li><a href="/home/<?php echo($this->viewAction);?>/<?php echo($this->page+1);?>">Next</a></li>
            <?php }?>
        </ul>
    </div>
</div>
</div>