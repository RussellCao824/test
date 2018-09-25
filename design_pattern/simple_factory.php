<?php
    //返回提示数目的虚拟父类
    class GetNewNum{
        public $result_num;
        public function __construct()
        {
        }
    }

    //简单工厂类
    class CreateGetNewNum{
        public function getClass($class_name){
            $new_class = null;
            switch ($class_name){
                case "rob_order": $new_class = new RobOrderNum();break;
                case "send_order": $new_class = new SendOrderNum();break;
                case "good_order": $new_class = new GoodOrderNum();break;
                case "serve_order": $new_class = new ServeOrderNum();break;
                case "good_after": $new_class = new GoodAfterNum();break;
                case "serve_after": $new_class = new ServeAfterNum();break;
                case "rob_send_after": $new_class = new RobSendAfterNum();break;
                default:break;
            }
            return $new_class;
        }
    }

    //各种需要返回最新未处理数量的项目

    //抢派单管理
    //抢单
    class RobOrderNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_send_orders where status != 4 and send_type = 2 and refund_apply_status = 0 and cancel_status = 1";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }

    //派单
    class SendOrderNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_send_orders where status != 4 and send_type = 1 and refund_apply_status = 0 and cancel_status = 1";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }

    //订单管理
    //商品订单
    class GoodOrderNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_cart_order,jm_cart_deal where jm_cart_deal.order_id = jm_cart_order.id and jm_cart_deal.deal_status != 6 and jm_cart_deal.id not in (select cart_id from jm_return_order where cart_id is not null)";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }

    //服务订单
    class ServeOrderNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_serve_deal where status != 4 and refund_apply_status = 0 and cancel_status = 1";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }

    //商品售后
    class GoodAfterNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_return_order where cart_id is not null and (handle_status = 1 or jm_interpose = 1)";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }

    //服务售后
    class ServeAfterNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_return_order where serve_id is not null and (handle_status = 1 or jm_interpose = 1)";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }

    //抢派单售后
    class RobSendAfterNum extends GetNewNum{
        public function __construct(){
            $sql = "select count(*) from jm_return_order where order_id is not null and (handle_status = 1 or jm_interpose = 1)";
            $result = mysql_query($sql);
            $rs = mysql_fetch_array($result);
            $this->result_num = $rs[0];
        }
    }
