<?php

function bar($x) {
  if ($x > 0) {
    bar($x - 1);
  }
}

function foo() {
  for ($idx = 0; $idx < 5; $idx++) {
    bar($idx);
    $x = strlen("abc");
  }
}

// 调用xhprof文件
require dirname(__FILE__) . '/../xhprof_func.php';
echo '<xmp>';
echo 'start'.chr(10);
// 使用方式 1

// xhprof_start();

// foo();

// xhprof_end();


// 使用方式 2

xhprof_save();

foo();


echo 'end'.chr(10);
