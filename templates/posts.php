<div class="panel panel-default">
    <div class="panel-heading">
        POSTS. count: <?php echo(count(session('posts'))); ?>
    </div>
    <ul class="list-group">
        <?php foreach(session('posts') as $post) : ?>
            <li class="list-group-item level">
                <div class="flex">
                    <a href="http://m-lab.dev/posts/<?php echo($post['slug']); ?>"><?php echo($post['title']); ?></a>
                    <br>published at <?php echo($post['created_at']); ?> by
                    <a href="http://m-lab.dev/profiles/<?php echo($post['user']['slug']); ?>">
                        <?php echo($post['user']['name']); ?>
                    </a>
                    <br>
                    ID: <?php echo($post['id']); ?>,
                    Tags
                    [
                        <ul class="tags">
                            <?php foreach($post['tags'] as $tag) : ?>
                                <li><?php echo($tag['name']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    ]
                </div>
                <a href="/posts/destroy?id=<?php echo($post['id']); ?>">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
