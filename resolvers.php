<?php

return [
    'Query' => [
        'version' => function($root, $args){
            return "1.0";
        },
        'users' => function($root, $args){
            return DB::$dbdatas['users'];
        },
        'posts' => function($root, $args){
            return DB::$dbdatas['posts'];
        }
    ],
    'Post' => [
        'author' => function($root, $args){
            return DB::$dbdatas['users'][$root['author']];
        }
    ],
    'User' => [
        'posts' => function($root, $args){
            $posts = DB::$dbdatas['posts'];
            $userPosts = [];
            foreach ($posts as $post) {
                if($post["id"] == $root["author"]){
                    $userPosts[] = $post;
                }
            }
            return $userPosts;
        }
    ],
    "Mutation"=>[
        'changerUserFirstname'=> function($root, $args){
            DB::$dbdatas['users'][$args['id']]['firstname'] = $args['firstname'];
            DB::saveDatas();
            return 'OK';
        }
    ]
];