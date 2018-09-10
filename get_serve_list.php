<?
	$key = $json_val['key'];
	if($key != -1){
		if($key == 8){
			$sql="select 
			jm_serve_deal.id as id, 
			jm_user.truename as truename,
			jm_serve.title as s_title,
			jm_serve.url as url,
			jm_serve.unit as unit,
			jm_serve_deal.price as price,
			jm_serve_deal.total_price as total_price,
			jm_serve_deal.num as num,
			jm_serve_deal.deal_status as deal_status
			from jm_serve_deal,jm_serve_order,jm_user,jm_serve where 
			jm_serve_deal.serve_id = jm_serve.id and 
			jm_user.id = jm_serve_deal.worker_id and 
			jm_serve_deal.status=1 and jm_serve_order.status=1 and 
			jm_serve_order.user_id = $userid and 
			jm_serve_deal.order_id=jm_serve_order.id
			order by jm_serve_deal.update_time,jm_serve_deal.start_time desc";	
		}
		
		if($key != 8){
			$sql="select 
			jm_serve_deal.id as id, 
			jm_user.truename as truename,
			jm_serve.title as s_title,
			jm_serve.url as url,
			jm_serve.unit as unit,
			jm_serve_deal.price as price,
			jm_serve_deal.total_price as total_price,
			jm_serve_deal.num as num,
			jm_serve_deal.deal_status as deal_status
			from jm_serve_deal,jm_serve_order,jm_user,jm_serve where 
			jm_serve_deal.serve_id = jm_serve.id and 
			jm_serve_deal.deal_status= $key and 
			jm_user.id = jm_serve_deal.worker_id and 
			jm_serve_deal.status=1 and jm_serve_order.status=1 and 
			jm_serve_order.user_id = $userid and 
			jm_serve_deal.order_id=jm_serve_order.id
			order by jm_serve_deal.update_time,jm_serve_deal.start_time desc";
		}
		$result = mysql_query($sql);
		$order_num = mysql_num_rows($result);
		while($rs=mysql_fetch_object($result)){
			$url = $rs->url;
			$url_01 =  substr($url,0,4);
			if($url_01 == "http"){
				$url = $url;
			}else{
				$url = "../../upload_pic/".$url;	
			}
			//编写json数组
			$htmlText = $htmlText . "{'id':'".$rs->id."','truename':'".$rs->truename."','s_title':'".$rs->s_title."','img':'".$url."','unit':'".$rs->unit."','price':'".$rs->price."','num':'".$rs->num."','deal_status':'".$rs->deal_status."','order_num':'".$order_num."','total_price':'".$rs->total_price."'}|";
	
		}
		
		//去除json数组最后一位
		$htmlText = substr($htmlText, 0, -1);
		
		echo $htmlText;	
	} else {
		
		//售后订单
		$sql = "select
		jm_return_order.id as return_id,
		jm_user.truename as truename,
		jm_serve_order.order_code as order_code,
		jm_serve_deal.price as price,
		jm_serve_deal.total_price as total_price,
		jm_serve_deal.id as id,
		jm_serve.title as g_title,
		jm_serve.unit as unit,
		jm_serve.url as url,
		jm_serve_deal.user_id as user_id,
		jm_serve_deal.num as num,
		jm_return_order.ask_status as ask_status,
		jm_return_order.handle_status as handle_status,
		jm_return_order.status as status 
	 from jm_return_order,jm_serve_order,jm_serve,jm_serve_deal,jm_user where 
	 jm_return_order.serve_id = jm_serve_deal.id and 
	 jm_user.id = jm_serve_deal.worker_id and
	 jm_serve_order.id = jm_serve_deal.order_id and 
	 jm_serve_deal.serve_id = jm_serve.id and 
	 jm_serve_deal.user_id = $userid and 
	 jm_return_order.status = 1
	 order by jm_return_order.update_time desc";
		$result = mysql_query($sql);
		$order_num = mysql_num_rows($result);
		while($rs=mysql_fetch_object($result)){
			$url = $rs->url;
			$url_01 =  substr($url,0,4);
			if($url_01 == "http"){
				$url = $url;
			}else{
				$url = "../../upload_pic/".$url;	
			}
			//编写json数组
			$htmlText = $htmlText . "{'id':'".$rs->id."','truename':'".$rs->truename."','s_title':'".$rs->s_title."','img':'".$url."','unit':'".$rs->unit."','price':'".$rs->price."','num':'".$rs->num."','deal_status':'".$rs->deal_status."','order_num':'".$order_num."','total_price':'".$rs->total_price."','status':'".$rs->handle_status."'}|";
	
		}
		
		
		//去除json数组最后一位
		$htmlText = substr($htmlText, 0, -1);
		
		echo $htmlText;
		
		}

		echo "this is the modify code";
?>
