<?php
$userId =intval($_GET['user_id']);

$news = "
SELECT posts.content,
posts.created,
users.alias as author_name,  
count(likes.id) as like_number,  
GROUP_CONCAT(DISTINCT tags.label) as taglist 
FROM posts
JOIN users ON  users.id=posts.user_id
LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
LEFT JOIN likes      ON likes.post_id  = posts.id 
GROUP BY posts.id
ORDER BY posts.created DESC  
LIMIT 5
";


$adminTags = "
SELECT tags.id AS tag_id, tags.label AS tag_label FROM `tags` LIMIT 50";


$adminUsers = "SELECT users.id AS user_id, users.alias AS user_alias FROM `users` LIMIT 50";
$feedUsers = "SELECT * FROM `users` WHERE id= '$userId' ";
$feedPosts = "
SELECT posts.content,
posts.created,
users.alias as author_name,  
count(likes.id) as like_number,  
GROUP_CONCAT(DISTINCT tags.label) AS taglist 
FROM followers 
JOIN users ON users.id=followers.followed_user_id
JOIN posts ON posts.user_id=users.id
LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
LEFT JOIN likes      ON likes.post_id  = posts.id 
WHERE followers.following_user_id='$userId' 
GROUP BY posts.id
ORDER BY posts.created DESC  
";
$requests = array("news"=>$news,"adminTags"=> $adminTags, "adminUsers"=> $adminUsers);


function request($folderName){
    global $requests;
    foreach($requests as $key => $value){
        if ($folderName == $key) {
            $laQuestionEnSql = $value;
            return $laQuestionEnSql;
        }
    }
}
?>