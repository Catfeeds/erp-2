<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>
<table width="1500px" class="list">
  			<tr><td class='H' align="center" colspan="22"><h3>销货记录</h3></td></tr>
  		</table>
		<table width="1500px" class="list"  border="1">
			<thead>
				<tr>
				    <th width="120" align="center">单据编号</th>
				    <th width="120" align="center">业务类别</th>
					<th width="120" align="center">客户</th>
					<th width="60" align="center">销售金额</th>
					<th width="60" align="center">折扣率(%)</th>
					<th width="60" align="center">折扣额</th>
					<th width="60" align="center">折后金额</th>
					<th width="60" align="center">本次收款</th>
					<th width="60" align="center">本次欠款</th>
					<th width="60" align="center">已收款</th>
					<th width="60" align="center">收款状态</th>
				    <th width="60" align="center">制单人</th>
					<th width="60" >已确认人</th>
					<th width="100" align="center">单据备注</th>
					<th width="100" align="center">商品</th>
					<th width="60" align="center">品牌</th>
					<th width="60" align="center">单位</th>
					<th width="60" align="center">数量</th>	
					<th width="60" align="center">销售单价</th>	
					<th width="60" align="center">折扣率(%)</th>
					<th width="60" align="center">折扣额</th>	
					<th width="60" align="center">金额</th>	
					<th width="60" align="center">仓库</th>	
					<th width="100" align="center">备注</th>	
					<th width="100" align="center">源单号</th>
				</tr>
			</thead>
			<tbody>
			    <?php 
				  $i = $n = 1;
				  $qty = $amount = 0;
				  foreach($list as $arr=>$row) {
				      $postData = unserialize($row['postData']);
				      $n = isset($postData['entries']) ? count($postData['entries'])+1 : 1;
				?>
				<tr target="id">
					<td rowspan="<?php echo $n?>" ><?php echo $row['billNo']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['transTypeName']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['contactNo'].' '.$row['contactName'];?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['totalAmount']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['disRate']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['disAmount']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['amount']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['rpAmount']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['arrears']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo abs($row['hasCheck'])?></td>
					<td rowspan="<?php echo $n?>" ><?php echo abs($row['hasCheck']) <= 0 ? '未收款' : (abs($row['hasCheck'])>=abs($row['amount'])? '全部收款' : '部分收款')?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['userName']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['checkName']?></td>
					<td rowspan="<?php echo $n?>" ><?php echo $row['description']?></td>
				<?php 
				$i = 1;
				foreach($postData['entries'] as $arr1=>$row1) {
					$qty    += abs($row1['qty']);
					$amount += abs($row1['amount']);
					if ($i==1) {
				?>
				    
					<td ><?php echo $row1['invNumber'].' '.$row1['invName'].' '.$row1['invSpec']?></td>
					<td ><?php echo $row1['brand']?></td>
					<td ><?php echo $row1['mainUnit']?></td>
					<td ><?php echo abs($row1['qty'])?></td>
					<td ><?php echo $row1['price']?></td>
					<td ><?php echo $row1['discountRate']?></td>
					<td ><?php echo $row1['deduction']?></td>
					<td ><?php echo abs($row1['amount'])?></td>
					<td ><?php echo $row1['locationName']?></td>
					<td ><?php echo $row1['description']?></td>
					<td ></td>
				</tr>
				<?php } else {?>
				<tr target="id">
					
					<td ><?php echo $row1['invNumber'].' '.$row1['invName'].' '.$row1['invSpec']?></td>
					<td ><?php echo $row1['brand']?></td>
					<td ><?php echo $row1['mainUnit']?></td>
					<td ><?php echo abs($row1['qty'])?></td>
					<td ><?php echo $row1['price']?></td>
					<td ><?php echo $row1['discountRate']?></td>
					<td ><?php echo $row1['deduction']?></td>
					<td ><?php echo abs($row1['amount'])?></td>
					<td ><?php echo $row1['locationName']?></td>
					<td ><?php echo $row1['description']?></td>
					<td ></td>
				</tr>
				<?php }$i++;}?>
				<tr target="id">
					<td >合计</td>
					<td ></td>
					<td ><?php echo $qty?></td>
					<td ></td>
					<td ></td>
					<td ></td>
					<td ><?php echo $amount?></td>
					<td ></td>
					<td ></td>
					<td ></td>
				</tr>
				<?php $qty = $amount = 0;$n = 1;}?>
				 
				
				 
				
 </tbody>
</table>	


 