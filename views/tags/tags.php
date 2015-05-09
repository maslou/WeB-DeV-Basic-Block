<div id="post_tags_<?php echo($this->post['id'])?>" class="container row">Tags:
    <ul>
        <?php foreach($this->tags as $tag): ?>
            <li><a href="/home/postByTags/<?php echo(htmlspecialchars($tag['TagText']))?>"><?php echo(htmlspecialchars($tag['TagText']))?></a></li>
        <?php endforeach; ?>
    </ul>
</div>