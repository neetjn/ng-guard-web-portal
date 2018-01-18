<?php
    
    global $web;
    
    $blog = new \Library\Application\Blog();
    define( MAX_LEN, 150 );
    
    $view = $_GET['view'];
    
?>
<!-- Marker: Home Begin -->
<div id='home' class="page panel wrapper">
    <?php if( !$view or $view !== 'post' && $view !== 'all' ): ?>
    <div id='home' class="page panel left">
        <?php foreach( array_splice( array_reverse( $blog->data['posts'] ), 0, 3 ) as $post ): ?>
        <div class="blog post wrapper">
            <h1 class="blog post title">
                <a class="blog post link" href="https://guard.neetgroup.net/index.php?page=home&view=post&id=<?php echo $post->data['id']; ?>">
                    <?php echo $post->data['title']; ?>
                </a>
            </h1>
            <p class="blog post content">
                <?php
                    
                    if( strlen( $post->data['content'] ) > MAX_LEN ):
                        
                        $content = str_split( $post->data['content'] );
                        for( $index = 0; $index < MAX_LEN; $index++ ) {
                            echo $content[$index];
                        }
                        echo '...';
                        
                    else:
                        
                        echo $post->data['content'];
                        
                    endif;
                    
                ?>
            </p>
            <div class="blog post nodes wrapper">
                <ul class="blog post nodes list">
                    <li class="blog post node"><i class="fa fa-user"></i>&nbsp;<?php echo $post->data['author']; ?></li>
                    <li class="blog post node"><i class="fa fa-comments"></i>&nbsp;<?php echo sizeof( $post->data['comments'] ); ?></li>
                    <li class="blog post node"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo date( 'D n/j/Y g:i a', $post->data['posted'] ); ?></li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div id='home' class="page panel right">
        <div class="blog post panel">
            <form class="blog post form">
                <p class='input section'>
                    <label class='input label' for='title'>
                        Post Title<br>
                        <input id='title' class='blog input textbox info' type='text' name='title' />
                    </label>
                </p>
                <p class='input section'>
                    <label class='input label' for='content'>
                        Post Content<br>
                        <textarea id="content" class="blog input textarea info"></textarea>
                    </label>
                </p>
                <p class='input section'>
                    <input id='post' class='input button info small' type='submit' value='Post' onclick="return false;" />
                </p>
            </form>
        </div>
        <h1 id='source' class='blog global header small'>
            <a href="https://github.com/neetVeritas/Blog" style="text-decoration:none;color:inherit;">
                <i class="fa fa-coffee"></i>&nbsp;Blog&copy; 1.1.2
            </a>
        </h1>
    </div>
    <?php elseif( $view == 'post' ): ?>
    <div id='home' class="page panel left">
        <?php
        
            $post_id = $_GET['id'];
            if( !$post_id ):
                $post_id = $blog->data['posts'][ sizeof( $blog->data['posts'] )-1 ]->data['id'];
            else:
                
                $post_valid;
                foreach( $blog->data['posts'] as $post ):
                    if( $post_id == $post->data['id'] ):
                        $post_valid = true;
                        break;
                    endif;
                endforeach;
                
                if( !$post_valid ):
                    $post_id = $blog->data['posts'][ sizeof( $blog->data['posts'] )-1 ]->data['id'];
                endif;
                
            endif;
            $post = $blog->post->get->__invoke($post_id);
            
        ?>
        <script>
            $post_id = <?php echo $post_id; ?>;
        </script>
        <div class="blog post wrapper">
            <h1 id="magnify" class="blog post title">
                <?php echo $post->data['title']; ?>
            </h1>
            <p id="magnify" class="blog post content">
                <?php echo $post->data['content']; ?> <!-- left here -->
            </p>
            <?php if( sizeof( $post->data['comments'] ) > 1 ): ?>
            <p class='input section' style="float:right;">
                <input id="show-comments" class="input button valid small" type="button" value='Show Comments' onclick="return false;" style="width:140px;" />
            </p>
            <?php endif; ?>
            <div class="blog post nodes wrapper">
                <ul class="blog post nodes list">
                    <li class="blog post node"><i class="fa fa-user"></i>&nbsp;<?php echo $post->data['author']; ?></li>
                    <li class="blog post node"><i class="fa fa-comments"></i>&nbsp;<?php echo sizeof( $post->data['comments'] ); ?></li>
                    <li class="blog post node"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo date( 'D n/j/Y g:i a', $post->data['posted'] ); ?></li>
                </ul>
            </div>
        </div>
    </div>
    <div id='home' class="page panel right">
        <?php if( sizeof( $post->data['comments'] ) > 0 ): ?>
        <?php
        
            $comment = array_splice( array_reverse( $post->data['comments'] ), 0, 1); 
            $comment = $comment[0];
             
        ?>
        <div id="first" class="blog comment wrapper">
            <p class="blog comment content">
                <i class="fa fa-quote-left"></i>
                &nbsp;<?php echo $comment['content']; ?>&nbsp;
                <i class="fa fa-quote-right"></i>
            </p>
            <a class="blog comment author" href="#"><i class="fa fa-user"></i>&nbsp;<?php echo $comment['author']; ?></a>
        </div>
        <?php endif; ?>
		<div class="blog comment panel">
            <form class="blog comment form">
                <p class='input section'>
                    <label class='input label' for='content'>
                        Comment Content<br>
                        <textarea id="content" class="blog input textarea info"></textarea>
                    </label>
                </p>
                <p class='input section'>
                    <input id='comment' class='input button info small' type='submit' value='Comment' onclick="return false;" />
                </p>
            </form>
        </div>
		<h1 id='source' class='blog global header small'>
            <a href="https://github.com/neetVeritas/Blog" style="text-decoration:none;color:inherit;">
                <i class="fa fa-coffee"></i>&nbsp;Blog&copy; 1.1.2
            </a>
        </h1>
        <?php if( sizeof( $post->data['comments'] ) > 1 ): ?>
        <?php foreach( array_splice( array_reverse( $post->data['comments'] ), 1, sizeof( $post->data['comments'] ) ) as $comment ): ?>
        <div id="lower" class="blog comment wrapper" style="display:none;">
            <p class="blog comment content">
                <i class="fa fa-quote-left"></i>
                &nbsp;<?php echo $comment['content']; ?>&nbsp;
                <i class="fa fa-quote-right"></i>
            </p>
            <a class="blog comment author" href="#"><i class="fa fa-user"></i>&nbsp;<?php echo $comment['author']; ?></a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php elseif( $view == 'all' ): ?>
    <div id='home' class="page panel left">
        <?php foreach( array_reverse( $blog->data['posts'] ) as $post ): ?>
        <div class="blog post wrapper">
            <h1 class="blog post title">
                <a class="blog post link" href="https://guard.neetgroup.net/index.php?page=home&view=post&id=<?php echo $post->data['id']; ?>">
                    <?php echo $post->data['title']; ?>
                </a>
            </h1>
            <p class="blog post content">
                <?php echo $post->data['content']; ?>
            </p>
            <div class="blog post nodes wrapper">
                <ul class="blog post nodes list">
                    <li class="blog post node"><i class="fa fa-user"></i>&nbsp;<?php echo $post->data['author']; ?></li>
                    <li class="blog post node"><i class="fa fa-comments"></i>&nbsp;<?php echo sizeof( $post->data['comments'] ); ?></li>
                    <li class="blog post node"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo date( 'D n/j/Y g:i a', $post->data['posted'] ); ?></li>
                </ul>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div id='home' class="page panel right">
        <div class="blog post panel">
            <form class="blog post form">
                <p class='input section'>
                    <label class='input label' for='title'>
                        Post Title<br>
                        <input id='title' class='blog input textbox info' type='text' name='title' />
                    </label>
                </p>
                <p class='input section'>
                    <label class='input label' for='content'>
                        Post Content<br>
                        <textarea id="content" class="blog input textarea info"></textarea>
                    </label>
                </p>
                <p class='input section'>
                    <input id='post' class='input button info small' type='submit' value='Post' onclick="return false;" />
                </p>
            </form>
        </div>
        <h1 id='source' class='blog global header small'>
            <a href="https://github.com/neetVeritas/Blog" style="text-decoration:none;color:inherit;">
                <i class="fa fa-coffee"></i>&nbsp;Blog&copy; 1.1.2
            </a>
        </h1>
    </div>
    <?php endif; ?>
    <?php Doc::load_uncached_script('guard.neetgroup.net/source/js/blog.js'); ?>
</div>
<!-- Marker: Home End -->