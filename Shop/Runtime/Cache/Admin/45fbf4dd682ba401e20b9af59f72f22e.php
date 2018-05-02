<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 管理员列表</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
    <style type="text/css">
        td{text-align: center;}
        a{color: #9cf !important;}
    </style>

</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('Admin/Admin/add');?>">添加管理员</a></span>
    <span id="search_id"> - 管理员列表</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="list-div" id="listDiv">
        <table cellspacing="1" cellpadding="3">
            <tr>
                <th>ID</th>
                <th>账号</th>
                <th>密码</th>
                <th>所属角色id</th>
                <th>是否启用 1:启用 0:禁用</th>
                <th width="60">操作</th>
            </tr>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="tron">
                    <td><?php echo ($v['id']); ?></td>
                    <td><?php echo ($v['username']); ?></td>
                    <td><?php echo ($v['password']); ?></td>
                    <td><?php echo ($v['role_name']); ?></td>
                    <td><?php echo ($v['is_use']); ?></td>
                    <td align="center">
                        <a href="<?php echo U('Admin/Admin/edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a> |
                        <a href="<?php echo U('Admin/Admin/delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>