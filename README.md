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
    4. 调用 xhprof_func.php 文件
    5. 选择性的使用 xhprof_start() xhprof_end() xhprof_save() 函数



 
