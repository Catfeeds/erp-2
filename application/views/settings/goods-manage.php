<?php $this->load->view('header');?>

<script type="text/javascript">
var DOMAIN = document.domain;
var WDURL = "";
var SCHEME= "<?php echo sys_skin()?>";
try{
	document.domain = '<?php echo base_url()?>';
}catch(e){
}
//ctrl+F5 增加版本号来清空iframe的缓存的
$(document).keydown(function(event) {
	/* Act on the event */
	if(event.keyCode === 116 && event.ctrlKey){
		var defaultPage = Public.getDefaultPage();
		var href = defaultPage.location.href.split('?')[0] + '?';
		var params = Public.urlParam();
		params['version'] = Date.parse((new Date()));
		for(i in params){
			if(i && typeof i != 'function'){
				href += i + '=' + params[i] + '&';
			}
		}
		defaultPage.location.href = href;
		event.preventDefault();
	}
});
</script>

<link rel="stylesheet" href="<?php echo base_url()?>statics/js/common/plugins/validator/jquery.validator.css">
<script type="text/javascript" src="<?php echo base_url()?>statics/js/common/plugins/validator/jquery.validator.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>statics/js/common/plugins/validator/local/zh_CN.js"></script>
<style>
body{background: #fff;}
.ui-combo-wrap{position:static;}
.mod-form-rows .label-wrap{font-size:12px;}
.manage-wrap .ui-input{width: 198px;}
.base-form{*zoom: 1;margin:0 -10px;}
.base-form:after{content: '.';display: block;clear: both;height: 0;overflow: hidden;}
.base-form .row-item{float: left;width: 290px;height: 31px;margin: 0 10px;overflow: visible;padding-bottom:15px;}
.manage-wrapper{margin:0 auto;width:722px;}
.manage-wrap textarea.ui-input{width: 100%;height: 80px;*vertical-align:auto;overflow: hidden;box-sizing: border-box;}
#manage-form{overflow: hidden;}
#warning,#warningSku{margin-right: 20px;color: #FF5F5F;}
#warning input ,#warningSku input{vertical-align: middle;}
.contacters{margin-bottom: 10px;}
.contacters h3{margin-bottom: 10px;font-weight: normal;}
.ui-jqgrid-bdiv .ui-state-highlight { background: none; }
.operating .ui-icon{ margin:0; }
.ui-icon-plus { background-position:-80px 0; }
.ui-icon-trash { background-position:-64px 0; }
.mod-form-rows .ctn-wrap{overflow: visible;;}
.mod-form-rows .pb0{margin-bottom:0;}
.liGroup{display:block;position:relative;z-index:1;padding-top: 15px;margin-top: 40px; border-top: solid 1px #ccc;}
.liGroup.dn{display:none;}
.liGroup h3{position: absolute;top: -20px;background-color: #fff;padding: 0 10px;color: #4B4B4B;}
.liGroup a{cursor: help;border-bottom:dotted #555 1px;}
.base-form .row-item{width: 227px;padding-bottom:9px;}
.manage-wrap .ui-input{width: 135px;}
.ui-tab{border-left:none;border-bottom: 1px solid #EBEBEB; background-color: #fff;  position: fixed;  width: 100%;  top: 0;  left: 0;  z-index: 999;}
.ui-tab li {border-top:none;border-bottom:none;border-color:#EBEBEB;padding:0 20px;}
.prop-wrap{line-height: 26px;margin-bottom: 20px;}
.prop-wrap.on{background: #f4f4f4;}
.qur-wrap{line-height: 42px;margin-bottom: 20px;}
.qur-wrap.on{background: #f4f4f4;}
.prop-wrap input{vertical-align: middle;margin-right: 3px;}

.prop-wrap label {margin-right: 8px;}
.prop-wrap .content{padding: 5px 0 12px 15px;height: 35px;overflow-y: auto;}
#createSku{color:#948D8D; font-size: 20px;border: dotted 2px #948D8D;padding: 0 15px;cursor: pointer;line-height: 15px;display: inline-block;vertical-align: middle;}
#createSku:hover{color:#1680F3;border-color:#1680F3;}
.serField{padding: 10px 0;}
#isSerNum{vertical-align: middle;margin-left: 17px;}
#isWarranty{vertical-align: middle;margin-left: 17px;}
.isWarrantyData{float: left; margin-left: 17px;}
.fl{float: left;}
.cle{clear: both;}
#patchInputBox{ padding: 10px;  border: 1px solid #ccc;  background-color: #fff;}
.shadow{  -moz-box-shadow: 1px 1px 3px rgba(0,0,0,.4);  -webkit-box-shadow: 1px 1px 3px rgba(0,0,0,.4);  box-shadow: 1px 1px 3px rgba(0,0,0,.4);}


/*品牌*/
.select-menu{
    margin-bottom: 1%;
}
.select-menu-ul{
    margin-top:50px;
    list-style:none;
    opacity:0;
    display:none;
    width:145px;
    text-align:left;
    border:1px solid #ddd;
    background:white;
    position:absolute;
    z-index:1;
    height: 100px;
    overflow-y: scroll;
    overflow-x: hidden;
    cursor: pointer;
}
.select-menu-ul li{
    width: 100%;
    height: 22px;
    line-height: 22px;
    overflow: hidden;
    padding:2% 0 2% 3%;
}
.select-menu-ul li:hover{
    background:#eee;
}
.select-menu-div{
    position:relative;
    height:30px;
    width:145px;
    background-color: white;
    border:1px solid #ddd;
    line-height:30px;
}
.select-this{
    background:#d2d2d2;
}
.select-this:hover{
    background:#d2d2d2!important;
}
i{
    margin-right:5px;
    position:absolute;
    right:0;
    top:7px;

}
.select-menu-input{
    margin-left:3%;
    border:0;
    width: 130px;
    height:29px;
    line-height: 31px;
    cursor:pointer;
    user-select:none;
    background-color: white;
}
.select-menu-i{
    transform:rotate(180deg);
}
</style>
</head>
<body>
<div class="hd cf">
	<ul class="ui-tab" id="tab">
		<li class="cur tabItem">基础资料</li>
        <li class="tabItem">库存预警</li>
        <li class="tabItem">高级</li>
        <li class="tabItem">期初设置</li>
        <li class="tabItem">套餐</li>
	</ul>
</div>
<div id="tabContent">
    <div id="base" style='width:100%;height:45px;'></div>
    <div class="manage-wrapper">
        <div id="manage-wrap" class="manage-wrap">
            <form id="manage-form" action="">
                <ul class="mod-form-rows base-form cf" id="base-form">
                    <li class="row-item">
                        <div class="label-wrap"><label for="number">商品编号</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="number" id="number"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="name">商品名称</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="name" id="name"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="brand">品牌</label></div>
<!--                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="brand" id="brand"></div>-->
                        <!--品牌-->
                        <div class="select-menu  label-wrap" style="background-color: #f5f5f5;">
                            <div class="select-menu-div">
                                <input readonly class="select-menu-input"  name="brand" id="brand" placeholder=""/>
                                <i class="fa fa-caret-down"></i>
                            </div>
                            <ul class="select-menu-ul" >
<!--                                <li class="select-this">新的啊</li>-->
                                <?php foreach ($list as $list): ?>
                                    <li><?php echo $list['name'] ?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <!--品牌end-->
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="barCode">商品条码</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="barCode" id="barCode"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="specs">规格型号</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="specs" id="specs" /></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="category">商品类别</label></div>
                        <div class="ctn-wrap"><span id="category"></span></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="storage">首选仓库</label></div>
                        <div class="ctn-wrap"><span id="storage"></span></div>
                    </li>

                    <li class="row-item row-category">
                        <div class="label-wrap"><label for="unit">计量单位</label></div>
                        <div class="ctn-wrap"><span id="unit"></span></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="extract">提成点</label></div>
                        <div class="ctn-wrap"><input type="number" max="100" min="0" step="0.001" value="" class="ui-input" name="extract" id="extract"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="series">系列</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="series" id="series"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="display">陈列</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="display" id="display"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="serialNumber">序号</label></div>
                        <div class="ctn-wrap"><input type="number" value="" class="ui-input" name="serialNumber" id="serialNumber"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="nameE">英文名称</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="nameE" id="nameE"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="retailPrice">零售价</label></div>
                        <div class="ctn-wrap"><input type="number" value="" class="ui-input" name="retailPrice" id="retailPrice"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="packing">装箱规格</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="packing" id="packing"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="taobaoPrice">淘宝出货价</label></div>
                        <div class="ctn-wrap"><input type="number" value="" class="ui-input" name="taobaoPrice" id="taobaoPrice"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="fixPrice">定价</label></div>
                        <div class="ctn-wrap"><input type="number" value="" class="ui-input" name="fixPrice" id="fixPrice"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="billing">开单编号</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="billing" id="billing"></div>
                    </li>

                    <li class="row-item dn">
                        <div class="label-wrap"><label for="guarantDate">保质期天数</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input rate" name="guarantDate" id="guarantDate"></div>
                    </li>
                    <li class="row-item dn">
                        <div class="label-wrap"><label for="warnDate">报警天数</label></div>
                        <div class="ctn-wrap"><input type="text" value="" class="ui-input rate" name="warnDate" id="warnDate"></div>
                    </li>
                </ul>
                <div id="jdInfo" class="liGroup cf dn">
                    <h3>维护京东仓储信息</h3>
                    <ul class="mod-form-rows base-form cf">
                        <li class="row-item">
                            <div class="label-wrap"><label for="jianxing">商品件型</label></div>
                            <div class="ctn-wrap"><span id="jianxing"></span></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="length">长(mm)</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="length" id="length"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="width">宽(mm)</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="width" id="width"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="height">高(mm)</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="height" id="height"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="weight">重量(kg)</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input" name="weight" id="weight"></div>
                        </li>
                    </ul>
                </div>
                <div class="liGroup cf">
                    <h3>价格策略</h3>
                    <ul class="mod-form-rows base-form cf">
                        <li class="row-item">
                            <div class="label-wrap"><label for="salePrice">零售价</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input money" name="salePrice" id="salePrice"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="wholesalePrice">批发价</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input money" name="wholesalePrice" id="wholesalePrice"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="vipPrice">VIP会员价</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input money" name="vipPrice" id="vipPrice"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="discountRate1">折扣率一(%)</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input rate" name="discountRate1" id="discountRate1"></div>
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="discountRate2">折扣率二(%)</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input rate" name="discountRate2" id="discountRate2"></div>
                        </li>
                        <li class="row-item">
                        </li>
                        <li class="row-item">
                            <div class="label-wrap"><label for="purchasePrice">预计采购价</label></div>
                            <div class="ctn-wrap"><input type="text" value="" class="ui-input money" name="purchasePrice" id="purchasePrice" /></div>
                        </li>
                    </ul>
                    <ul class="mod-form-rows">
                        <li class="row-item pb0">
                            <div class="ctn-wrap" style="line-height: normal;"><textarea name="" id="note" class="ui-input ui-input-ph">添加备注信息</textarea></div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>

        <div id="initCombo" class="dn">
          <input type="text" class="textbox storageAuto" name="storage" autocomplete="off">
          <input type="text" class="textbox dateAuto" name="date" autocomplete="off">
          <input type="text" class="textbox storageAuto_warning" name="storage_warning" autocomplete="off">
          <input type="text" class="textbox skuAuto" name="sku" autocomplete="off">
          <input type="text" class="textbox skuPropAuto" name="skuProp" autocomplete="off">
          <input type="text" class="textbox goodsAuto" name="goods" autocomplete="off">
       </div>
    </div>
    <div class="manage-wrapper dn">
        <div id="manage-wrap" class="manage-wrap">
            <div class="cf">
                <!-- <h3>库存预警</h3> --><label id='warning'><input type="checkbox">启用分仓预警</label><label id='warningSku' class="dn"><input type="checkbox">根据属性设置</label>
                <ul class="mod-form-rows base-form cf">
                    <li class="row-item">
                        <div class="label-wrap"><label for="minInventory">最低库存</label></div>
                        <div class="ctn-wrap"><input type="text" class="ui-input" name="minInventory" id="minInventory"></div>
                    </li>
                    <li class="row-item">
                        <div class="label-wrap"><label for="maxInventory">最高库存</label></div>
                        <div class="ctn-wrap"><input type="text" class="ui-input" name="maxInventory" id="maxInventory"></div>
                    </li>
                </ul>
                <div class="grid-wrap">
                  <table id="gridWarning">
                  </table>
                  <div id="pageWarning"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="manage-wrapper dn">
        <div id="manage-wrap" class="manage-wrap">
            <div class="cf">
                <!-- <h3>高级设置</h3> -->
                <div class="row-item prop-wrap on dn">
                    <span class="check-wrap adjust-item">
                        <!-- <input type="checkbox" name="isItem" id="isItem"> -->
                        <label for="isItem">辅助属性分类</label>
                    </span>
                    <div class="content" id="itemList">
                    </div>
                    <div class="grid-wrap">
                      <table id="gridSku">
                      </table>
                    </div>
                </div>

                <div class="row-item qur-wrap on dn">
                        <label for="isWarranty">启用批次保质期管理</label>
                        <input type="checkbox" id="isWarranty"/>
                    <span class = "isWarrantyIn dn">
                            <label for="safeDays">保质期天数</label>
                            <input type="text" value="" class="ui-input rate" name="safeDays" id="safeDays">
                            <label for="advanceDay">报警天数</label>
                            <input type="text" value="" class="ui-input rate" name="advanceDay" id="advanceDay">
                   </span>

                </div>

                <div class="row-item serField dn">
                    <label for="isSerNum">启用序列号</label>
                    <input type="checkbox" id="isSerNum"/>
                </div>
            </div>

        </div>
    </div>
    <div class="manage-wrapper dn">
        <div id="manage-wrap" class="manage-wrap">
            <div class="cf">
                <!-- <h3>期初设置</h3> -->
                <div class="contacters">
                    <div class="grid-wrap">
                      <table id="grid">
                      </table>
                      <div id="page"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="manage-wrapper dn">
        <div id="manage-wrap" class="manage-wrap">
            <div class="cf">
                <!-- <h3>组合商品</h3> -->
                <div class="contacters">
                    <div class="grid-wrap">
                      <table id="gridCombination">
                      </table>
                      <div id="pageCombination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="patchInputBox" class="shadow target_box dn">
<script src="<?php echo base_url()?>statics/js/dist/goodsManage.js?ver=201508191130"></script>
<script>
        $(function(){
            selectMenu(0);
            selectMenu(1);
            function selectMenu(index){
                // $(".select-menu-input").eq(index).val($(".select-this").eq(index).html());//在输入框中自动填充第一个选项的值
                $(".select-menu-div").eq(index).on("click",function(e){
                    e.stopPropagation();
                    if($(".select-menu-ul").eq(index).css("display")==="block"){
                        $(".select-menu-ul").eq(index).hide();
                        $(".select-menu-div").eq(index).find("i").removeClass("select-menu-i");
                        $(".select-menu-ul").eq(index).animate({marginTop:"50px",opacity:"0"},"fast");
                    }else{
                        $(".select-menu-ul").eq(index).show();
                        $(".select-menu-div").eq(index).find("i").addClass("select-menu-i");
                        $(".select-menu-ul").eq(index).animate({marginTop:"5px",opacity:"1"},"fast");
                    }
                    for(var i=0;i<$(".select-menu-ul").length;i++){
                        if(i!==index&& $(".select-menu-ul").eq(i).css("display")==="block"){
                            $(".select-menu-ul").eq(i).hide();
                            $(".select-menu-div").eq(i).find("i").removeClass("select-menu-i");
                            $(".select-menu-ul").eq(i).animate({marginTop:"50px",opacity:"0"},"fast");
                        }
                    }

                });
                $(".select-menu-ul").eq(index).on("click","li",function(){//给下拉选项绑定点击事件
                    $(".select-menu-input").eq(index).val($(this).html());//把被点击的选项的值填入输入框中
                    $(".select-menu-div").eq(index).click();
                    $(this).siblings(".select-this").removeClass("select-this");
                    $(this).addClass("select-this");

                    //将选中的内容填入搜索框
                    // $('#brand').val($(this).html());
                    // if ($(this).html() == '') {
                    //     $('#brand').val('');
                    //     $(".select-menu-input").eq(index).val('');
                    // }
                });
                $("body").on("click",function(event){
                    event.stopPropagation();
                    if($(".select-menu-ul").eq(index).css("display")==="block"){
                        $(".select-menu-ul").eq(index).hide();
                        $(".select-menu-div").eq(index).find("i").removeClass("select-menu-i");
                        $(".select-menu-ul").eq(index).animate({marginTop:"50px",opacity:"0"},"fast");
                        a
                    }
                });
            }
        })
    </script>
</body>
</html>

