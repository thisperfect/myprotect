<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 新增商品</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css" />
<script type="text/javascript" charset="utf-8" src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
<style type="text/css">
    .content{display:none;}
</style>
<script type="text/javascript">
    UE.getEditor('goods_desc',{
        'initialFrameWidth':'100%',
        'initialFrameHeight':200,
        'maximumWords':200
    });
    $(function(){
        // 时间选择器
        $('#promote_start_time').datepicker({dateFormat:"yy-mm-dd"});
        $('#promote_end_time').datepicker({dateFormat:"yy-mm-dd"});

        // 选项卡切换
        $("#tabbar-div p span").click(function(){
            var index=$(this).index();
            $(this).removeClass('tab-back').addClass('tab-front').siblings().removeClass('tab-front').addClass('tab-back');
            $('.content').eq(index).show().siblings().hide();
        });

        // 下拉框选择
        $('select[name=type_id]').change(function(){
            // 获取选中的类型的id
            var type_id=$(this).val();
            $.get("<?php echo U('ajaxGetAttr');?>",{'type_id':type_id},function(res){
                var json=JSON.parse(res);
                console.log(json);
                if(json==null){
                    $('#attr_container').html('');
                    return;
                }
                var html='';
                for(var i=0;i<json.length;i++){
                    html+='<p>'+json[i].attr_name+': ';
                    // 1.如果属性是可选的，那就有一个+号
                    // 2.如果属性有可选值，那就是一个下拉框
                    // 3.如果属性是唯一的，那就是一个文本框
                    if(json[i].attr_type==1)
                        html+='<a href="javascript:void(0)" onclick="addNew(this)">[+]</a>';
                    if(json[i].attr_option_values==''){ // 是否有可选值
                        html+='<input type="text" />';
                    }else{
                        var attrs=json[i].attr_option_values.split(',');
                        html+='<select>';
                        html+='<option values="请选择"></option>';
                        for(var j=0;j<attrs.length;j++){
                            html+='<option values="'+attrs[j]+'">'+attrs[j]+'</option>';
                        }
                        html='</select>';
                    }
                    html+='</p>';
                }
                $('#attr_container').html(html);
            });
        });
    });
    function addNew(a){
        var p=$(a).parent();
        if($(a).html()=='[+]'){
            var newP=p.clone();
            newP.find('a').html('[-]');
            p.after(newP);
        }else{
            p.remove();
        }
    }
</script>

</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
    <span id="search_id"> - 新增商品</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="tab-div">
        <div id="tabbar-div">
            <p>
                <span class="tab-front" id="general-tab">基本信息</span>
                <span class="tab-back" id="general-tab">商品描述</span>
                <span class="tab-back" id="general-tab">会员价格</span>
                <span class="tab-back" id="general-tab">商品属性</span>
                <span class="tab-back" id="general-tab">商品相册</span>
            </p>
        </div>
        <div id="tabbody-div">
            <form method="POST" action="/Admin/Goods/add.html" style="margin:5px;">
                <div class="content" style="display:block;">
                    <p>商品名称:<input type="text" name="goods_name" value="" /></p>
                    <p>主分类的id：<input type="text" name="cat_id" value="" /></p>
                    <p>品牌的id：<input type="text" name="brand_id" value="" /></p>
                    <p>市场价：<input type="text" name="market_price" value="0.00" /></p>
                    <p>本店价：<input type="text" name="shop_price" value="0.00" /></p>
                    <p>赠送积分：<input type="text" name="jifen" value="" /></p>
                    <p>赠送经验值：<input type="text" name="jyz" value="" /></p>
                    <p>如果要用积分兑换，需要的积分数：
                        <input type="text" name="jifen_price" value="" /></p>
                    <p>是否促销：<input type="text" name="is_promote" value="0" /></p>
                    <p>促销价：<input type="text" name="promote_price" value="0.00" /></p>
                    <p>促销开始时间：<input id="promote_start_time" type="text" name="promote_start_time" value="0" />
                        促销结束时间：<input id="promote_end_time" type="text" name="promote_end_time" value="0" />
                    </p>
                    <p>logo原图：<input type="file" name="logo" value="" /></p>
                    <p>是否热卖：
                        <input type="radio" name="is_hot" value="1" />是
                        <input type="radio" name="is_hot" value="0" checked="checked" />否
                    </p>
                    <p>是否新品：
                        <input type="radio" name="is_new" value="1" />是
                        <input type="radio" name="is_new" value="0" checked="checked" />否
                    </p>
                    <p>是否精品：
                        <input type="radio" name="is_best" value="1" />是
                        <input type="radio" name="is_best" value="0" checked="checked" />否
                    </p>
                    <p>是否上架：1：上架，0：下架：
                        <input type="radio" name="is_on_sale" value="1" checked="checked" />上架
                        <input type="radio" name="is_on_sale" value="0" />下架
                    </p>
                    <p>seo优化[搜索引擎【百度、谷歌等】优化]_关键字：
                        <input type="text" name="seo_keyword" value="" />
                    </p>
                    <p>seo优化[搜索引擎【百度、谷歌等】优化]_描述：
                        <input type="text" name="seo_description" value="" />
                    </p>
                    <p>商品类型id：<input type="text" name="type_id" value="0" /></p>
                    <p>排序数字：<input type="text" name="sort_num" value="100" /></p>
                    <p><input type="submit" class="btn btn-primary" value="确定" /></p>
                </div>
                <div class="content">
                    <p><textarea name="goods_desc" id="goods_desc"></textarea></p>
                </div>
                <div class="content">会员价格</div>
                <div class="content">
                    <p>商品类型：
                        <select name="type_id">
                            <?php if(is_array($typeData)): $i = 0; $__LIST__ = $typeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v['id']); ?>" <?php if($type_id==$v['id']) echo 'selected="selected"';?>><?php echo ($v['type_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </p>
                    <div id="attr_container"></div>
                </div>
                <div class="content">商品相册</div>
            </form>
        </div>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>