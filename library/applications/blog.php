<?php namespace Library\Application;

    use \stdClass;

    class Blog {

        public $data, $post;
        
        /*
		 * $this->data as multi-dimensional array
		 * $this->post as stdClass
		 * $this->post->get as dynamic function
		 * $this->post->create as dynamic function
		 * $this->post->comment as dynamic function
		 */

        public function __construct() {
            
            $this->post = new stdClass();
            
            $this->post->get = function($post_id) {

                $data = \Library\Tools\SQL::fetch_row( "SELECT * FROM `blog_posts` WHERE `id` = '$post_id'" );

                if( $data ):
                    
                    $user_id = $data['author_id'];
                    $author = \Library\Tools\SQL::fetch_row( "SELECT * FROM `users` WHERE `id` = '$user_id'" );

                    $comments = array(  );

                    if( ( (int) $data['post_comments'] ) !== 0 ):

                        $select_comments = \Library\Tools\SQL::query( "SELECT * FROM `blog_comments` WHERE `post_id` = '$post_id'" );
                        while ( $row = \Library\Tools\SQL::fetch_row($select_comments, true) ):
                            $user_id = $row['author_id'];
                            $commentor = \Library\Tools\SQL::fetch_row( "SELECT * FROM `users` WHERE `id` = '$user_id'" );
                            $comment = array(
                                'author' => $commentor['username'],
                                'content' => $row['comment_content']
                            );
                            $comments[] = $comment;
                        endwhile;

                    endif;

                    $post = new stdClass();

                    $post->data = array(
                        'id' => $data['id'],
                        'author' => $author['username'],
                        'title' => $data['post_title'],
                        'content' => $data['post_content'],
                        'comments' => $comments,
                        'posted' => strtotime( $data['post_date'] )
                    );

                    $post->comment = function($data, $author, $content) {
                        $this->post->comment( $data['id'], $author, $content );
                    };

                    return $post;
                    
                else:
                    
                    return false;
                    
                endif;
            };
            
            $this->post->create = function($author, $title, $content) {

                $title = str_replace("'", "\'", $title);
                $content = str_replace("'", "\'", $content);
                \Library\Tools\SQL::query( "INSERT INTO `blog_posts` (`id`, `author_id`, `post_date`, `post_title`, `post_content`, `post_comments`) VALUES (NULL, '$author', CURRENT_TIMESTAMP, '$title', '$content', '0')" );
            };
            
            $this->post->comment = function($post_id, $author, $content) {
                
                $content = str_replace("'", "\'", $content);
                $post = \Library\Tools\SQL::fetch_row( "SELECT * FROM `blog_posts` WHERE `id` = '$post_id'" );
                if( $post ){
                    \Library\Tools\SQL::query( "UPDATE `blog_posts` SET `post_comments` = `post_comments` + 1, `post_date` = `post_date` WHERE `id` = '$post_id'" );
                    \Library\Tools\SQL::query( "INSERT INTO `blog_comments` (`id`, `post_id`, `author_id`, `comment_content`) VALUES (NULL, '$post_id', '$author', '$content')" );
                } else {
                    return false;
                }
            };
            
            $this->data = array(  );
            $select_posts = \Library\Tools\SQL::query( "SELECT * FROM `blog_posts`" );
            while ( $row = \Library\Tools\SQL::fetch_row( $select_posts, true ) ):
                
                $post = $this->post->get->__invoke( $row['id'] );
                $this->data['posts'][] = $post;
            
            endwhile;
        }
    }

?>