<?php
$arUrlRewrite=array (
  10 =>
  array (
    'CONDITION' => '#^/information/links/([a-zA-Z0-9_]+)/\\?{0,1}(.*)$#',
    'RULE' => '/information/links/index.php?SECTION_CODE=\\1&\\2',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  110 =>
  array (
    'CONDITION' => '#^/result/([0-9]+)/([0-9]+)/([0-9]+)/([0-9]+)/#',
    'RULE' => '/result/index.php?id_sub=$1&id_years=$2&id_step=$3&region=$4',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  9 =>
  array (
    'CONDITION' => '#^/board/([a-zA-Z0-9_]+)/\\?{0,1}(.*)$#',
    'RULE' => '/board/index.php?SECTION_CODE=\\1&\\2',
    'ID' => '',
    'PATH' => '',
    'SORT' => 100,
  ),
  3 =>
  array (
    'CONDITION' => '#^/nationalnews/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/nationalnews/index.php',
    'SORT' => 100,
  ),
  46 =>
  array (
    'CONDITION' => '#^/commission_m/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/commission_m/index.php',
    'SORT' => 100,
  ),
  6 =>
  array (
    'CONDITION' => '#^/job/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/job/vacancy/index.php',
    'SORT' => 100,
  ),
  118 =>
  array (
    'CONDITION' => '#^/method_doc/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/method_doc/index.php',
    'SORT' => 100,
  ),
  5 =>
  array (
    'CONDITION' => '#^/job/resume/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/job/resume/index.php',
    'SORT' => 100,
  ),
  117 =>
  array (
    'CONDITION' => '#^/experts_r/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/experts_r/index.php',
    'SORT' => 100,
  ),
  116 =>
  array (
    'CONDITION' => '#^/normative/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/normative/index.php',
    'SORT' => 100,
  ),
  115 =>
  array (
    'CONDITION' => '#^/subjects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/subjects/index.php',
    'SORT' => 100,
  ),
  13 =>
  array (
    'CONDITION' => '#^/experts/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/experts/index.php',
    'SORT' => 100,
  ),
  2 =>
  array (
    'CONDITION' => '#^/themes/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/themes/index.php',
    'SORT' => 100,
  ),
  4 =>
  array (
    'CONDITION' => '#^/forum/#',
    'RULE' => '',
    'ID' => 'bitrix:forum',
    'PATH' => '/forum/index.php',
    'SORT' => 100,
  ),
  7 =>
  array (
    'CONDITION' => '#^/photo/#',
    'RULE' => '',
    'ID' => 'bitrix:photogallery_user',
    'PATH' => '/photo/index.php',
    'SORT' => 100,
  ),
  8 =>
  array (
    'CONDITION' => '#^/blogs/#',
    'RULE' => '',
    'ID' => 'bitrix:blog',
    'PATH' => '/blogs/index.php',
    'SORT' => 100,
  ),
  0 =>
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  11 =>
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
);
