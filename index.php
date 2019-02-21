<?php

require_once 'vendor/autoload.php';
use Siler\Graphql;

include 'db.php';
DB::loadDatas();

$typesDefinition = file_get_contents(__DIR__.'/schema.graphql');
$resolvers = include __DIR__.'/resolvers.php';

$schema = Graphql\schema($typesDefinition, $resolvers);
Graphql\init($schema);