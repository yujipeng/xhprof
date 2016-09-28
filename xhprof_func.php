<?php

/**
 * xhprof 性能分析工具 封装
 * @version $id$ v 1.1
 * @copyright 2012-2015
 * @author yujipeng <jeep.yujipeng@gmail.com> 
 * @license PHP Version 5.5 {@link http://php.net/license/3_01.txt}
 */

ini_set('xhprof.output_dir' , dirname(__FILE__) . '/xhprof_log/'); 

/**
 * xhprof_save 
 * 从调用到页面结束记录
 * @param mixed $flag  统计数据的标志位，默认只统计执行时间，默认为空
 * @param array $ignored_functions 统计忽略方法列表，默认为空
 * @param string $namespace 命名标识，默认是url和参数处理后的字符串
 * @param int $save_percent 按照百分比进行记录，比如 1/10，这里设置1，默认10
 * @param int $percent_max 按照百分比进行记录，比如 1/10，这里设置10，默认10
 * @param int $percent_min 按照百分比进行记录，比如 1/10，这里设置0，默认0
 * @access public
 * @return void
 */
function xhprof_save($flag = null, $ignored_functions = array(), $namespace = '', $save_percent = 10, $percent_max = 10, $percent_min = 0) {
    $random = mt_rand($percent_min, $percent_max);
    if($random > $save_percent) return false;
    // start
    xhprof_start($flag, $ignored_functions);
    // register  xhprof_end
    register_shutdown_function('xhprof_end', $namespace);
}
// xhprof_save();

/**
 * xhprof_start 
 * 开始记录
 * @param mixed $flag  统计数据的标志位，默认只统计执行时间，默认为空
 * example : $flag = XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY;
 * @param array $ignored_functions 统计忽略方法列表，默认为空
 * example : $ignored_functions = array('Util_Array::hashmap', 'array_unique');
 * @access public
 * @return void
 */
function xhprof_start($flag = null, $ignored_functions = array()){
    include_once dirname(__FILE__) . "/xhprof_lib/utils/xhprof_lib.php";
    include_once dirname(__FILE__) . "/xhprof_lib/utils/xhprof_runs.php";
    // start profiling
    if($ignored_functions && is_array($ignored_functions))
        $ignored_functions = array(
            'ignored_functions' => $ignored_functions,
        );
    xhprof_enable($flag, $ignored_functions);
}


/**
 * xhprof_end 
 * 结束记录
 * @param string $namespace 命名标识，默认是url和参数处理后的字符串
 * @access public
 * @return void
 */
function xhprof_end($namespace = ''){
    if(!$namespace) 
        $namespace = isset($_SERVER['REQUEST_URI']) ? str_replace(array('/','?','&','='), array('-','|',';',':'), ltrim($_SERVER['REQUEST_URI'], '/')) : '';
    $run = xhprof_disable();
    $xhprof = new XHProfRuns_Default; 
    return $xhprof->save_run($run, $namespace);
}

