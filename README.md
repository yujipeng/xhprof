# xhprof
当前使用的xhprof，进行了简单封装



关于xhprof的说明:

    关于xhprof的手册 参考 ：http://php.net/manual/zh/book.xhprof.php
    关于xhprof的扩展信息 参考 :  http://pecl.php.net/package/xhprof
    关于graphviz的安装 参考 ：http://www.graphviz.org/Download..php
    关于github的地址 : https://github.com/phacility/xhprof
    当前使用版本 0.9.4

关于当前封装使用说明:

    1. 可以进入 extension 中进行扩展安装
    2. 注意在php.ini中补充 `extension=xhprof.so`
    3. 对于日志目录 xhprof_log 设置可写权限 例如： `chmod 777 -R xhprof_log/*`
    4. 调用 `require XHPROF_ROOT_PATH . '/xhprof_func.php'` 文件
    5. 选择性的使用 xhprof_start() xhprof_end() xhprof_save() 函数

函数调用方式：

    1. 自定义起止位置方式

        记录开始 xhprof_start()
        记录结束 xhprof_end()

    2. 自调用开始直接到页面输出，执行结束，自动记录的方式

        直接调用 xhprof_save()


函数说明:

     /** 
      * xhprof_start 
      * 开始记录
      * @param mixed $flag  统计数据的标志位，默认只统计执行时间，默认为空
      * example : $flag = XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY;
      * @param array $ignored_functions 统计忽略方法列表，默认为空
      * example : $ignored_functions = array('Util_Array::hashmap', 'quote_user::tidyList');
      * @access public
      * @return void
      */
     function xhprof_start($flag = null, $ignored_functions = array()){}
     
     /**
      * xhprof_end 
      * 结束记录
      * @param string $namespace 命名标识，默认是url和参数处理后的字符串
      * @access public
      * @return void
      */
     function xhprof_end($namespace = ''){}
      
     
     /**
      * xhprof_save 
      * 从调用到页面结束记录
      * @param mixed $flag  统计数据的标志位，默认只统计执行时间，默认为空
      * @param array $ignored_functions 统计忽略方法列表，默认为空
      * @param string $namespace 命名标识，默认是url和参数处理后的字符串
      * @param int $save_percent 按照百分比进行记录，比如 1/10，这里设置1，默认10
      * @param int $percent_max 按照百分比进行记录，比如 1/10，这里设置10，默认10
      * @param int $percent_min 按照百分比进行记录，比如 1/10，这里设置0，默认0
      * @access public
      * @return void
      */
     function xhprof_save($flag = null, $ignored_functions = array(), $namespace = '', $save_percent = 10, $percent_max = 10, $percent_min = 0) {}

报告字段含义说明：

    Function Name：方法名称。
    Calls：方法被调用的次数。
    Calls%：方法调用次数在同级方法总数调用次数中所占的百分比。
    Incl.Wall Time(microsec)：方法执行花费的时间，包括子方法的执行时间。（单位：微秒）
    IWall%：方法执行花费的时间百分比。
    Excl. Wall Time(microsec)：方法本身执行花费的时间，不包括子方法的执行时间。（单位：微秒）
    EWall%：方法本身执行花费的时间百分比。
    Incl. CPU(microsecs)：方法执行花费的CPU时间，包括子方法的执行时间。（单位：微秒）
    ICpu%：方法执行花费的CPU时间百分比。
    Excl. CPU(microsec)：方法本身执行花费的CPU时间，不包括子方法的执行时间。（单位：微秒）
    ECPU%：方法本身执行花费的CPU时间百分比。
    Incl.MemUse(bytes)：方法执行占用的内存，包括子方法执行占用的内存。（单位：字节）
    IMemUse%：方法执行占用的内存百分比。
    Excl.MemUse(bytes)：方法本身执行占用的内存，不包括子方法执行占用的内存。（单位：字节）
    EMemUse%：方法本身执行占用的内存百分比。
    Incl.PeakMemUse(bytes)：Incl.MemUse峰值。（单位：字节）
    IPeakMemUse%：Incl.MemUse峰值百分比。
    Excl.PeakMemUse(bytes)：Excl.MemUse峰值。单位：（字节）
    EPeakMemUse%：Excl.MemUse峰值百分比。
