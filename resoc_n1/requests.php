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

$admin = "
SELECT tags.id AS tag_id, tags.label AS tag_label FROM `tags` LIMIT 50";

$requests = array("news" => $news, "admin" => $admin);

function request($folderName){
    for ($i=0; $i < count($requests) ; $i++) { 
        if ($folderName == $requests[$i]) {
            $laQuestionEnSql = $requests[$i];
            return $laQuestionEnSql;
        }
    }
}
?>