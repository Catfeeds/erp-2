<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->common_model->checkpurview();
		$this->jxcsys = $this->session->userdata('jxcsys');
    }
	
	public function index(){
	    //add by michen 20170820 for 修改登录异常 begin
	    if(!strstr($_SERVER['REQUEST_URI'], 'home/index'))
	        redirect('home/index', 'refresh');
	    //add by michen 20170820 for 修改登录异常 end
	    $data['uid']      = $this->jxcsys['uid'];
		$data['name']     = $this->jxcsys['name'];
		$data['roleid']   = 0;
		$data['username'] = $this->jxcsys['username']; 
        $data['system']   = $this->common_model->get_option('system'); 
		$data['rights']   = $this->common_model->get_admin_rights(); 
		$this->load->view('index',$data);
	}
	
	public function main(){
		$this->load->view('main');
	}
	

	public function set_password(){
		$data = str_enhtml($this->input->post(NULL,TRUE));
		if (is_array($data)&&count($data)>0) {
			$info['userpwd'] = md5($data['newPassword']);
			$info['mobile']  = $data['buyerMobile'];
			$info['name']    = $data['buyerName'];
			$this->mysql_model->get_count('admin','(uid<>'.$this->jxcsys['uid'].') and mobile='.$info['mobile'].'') >0 && str_alert(-1,'该手机号已被使用,请更换手机号码'); 
		    $sql = $this->mysql_model->update('admin',$info,'(uid='.$this->jxcsys['uid'].')');
			if ($sql) {
				$this->common_model->logs('密码修改成功 UID：'.$this->jxcsys['uid'].' 真实姓名改为：'.$info['name']);
				str_alert(200,'密码修改成功');
			}
			str_alert(-1,'设置独立密码失败，请稍候重试！');
		} else {
		    $data = $this->mysql_model->get_rows('admin','(uid='.$this->jxcsys['uid'].')');    
		    $this->load->view('set_password',$data);
		}
	}
	

	public function Services(){
		die('jQuery110202928952066617039_1430920204305({"status":200,"msg":"success","data":[{"msgid":"20000000122"
,"msglinkcolor":"d9254a","msglink":"","msgtitle":"售后热线服务时间临时调整通知（5.6-5.8）>>"},{"msgid":"20000000119"
,"msglinkcolor":"d9254a","msglink":"index.html","msgtitle"
:"推荐送ipad mini，购买就返利>>"},{"msgid":"20000000115","msglinkcolor":"d9254a","msglink":"","msgtitle":">>"},{"msgid":"20000000068","msglinkcolor":"d9254a","msglink":"","msgtitle":">
>"}]})');
		 
	}

	public function ranking(){

        $sql =" SELECT * FROM `ci_admin` order by `extractCount` DESC limit 6";
        $ret = $this->mysql_model->query($sql,2);

        die(json_encode($ret));
    }

    public function run(){

        $sql =" SELECT * FROM `ci_invoice` WHERE checked = 1 and billType = 'SALE' order by `modifyTime` DESC limit 1";
        $ret = $this->mysql_model->query($sql,2);

        foreach($ret as $k=>$v){
            $salesId = $v['salesId'];
            $sql =" SELECT * FROM `ci_admin` where uid = ".$salesId;
            $rets = $this->mysql_model->query($sql,1);
            $ret[$k]['salesName'] = $rets['username'];

        }

        die(json_encode($ret));
    }
//获取折线图所需的数据
    public function k(){
        $id = $this->input->get_post('id',true);
        $e = $this->input->get_post('time',true);
        $all = $this->input->get_post('person',true);

        if(!$id){
            $id = $this->jxcsys['uid'];
        }
        if(!$e){
            $e = 7;
        }
        if($all){
            $res = $this->getData($id,$e);
            die(json_encode($res));
        }else{
            $res = $this->getAllData($e);
            die(json_encode($res));
        }


    }

    public function getData($id,$i){

        $day = date('d',time());
        $month = date('m',time());
        $year = date('Y',time());
        $res = array();
        $ri = array();
        for ($t=0;$t < $i;$t++){

            if($day == 1 && $month == 1){
                $year = $year - 1;
                $month = 12;
                $day = 31;
            }elseif ($day == 1 && ($month == 2 || $month == 4 || $month == 6 || $month == 9 || $month == 11) ){
                $year = $year;
                $month = $month-1;
                $day = 31;
            }elseif ($day == 1 && ($month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) ){
                $year = $year;
                $month = $month-1;
                $day = 30;
            }elseif ($day == 1 && $month == 3){
                if(($year%4==0&&$year%100!=0)||($year%400==0)){
                    $year = $year;
                    $month = $month-1;
                    $day = 29;
                }else{
                    $year = $year;
                    $month = $month-1;
                    $day = 28;
                }

            }else{
                $year = $year;
                $month = $month;
                $day = $day-1;
            }

            $sql = "select * from `ci_invoice` where salesId = $id and transTypeName = '销货'and year(createTime) = $year and month(createTime) = $month and day(createTime) = $day";
            $data = $this->mysql_model->query($sql,2);
            $S = $year.'.'.$month.'.'.$day.'.';
            foreach ($data as $k=>$v){
                $res[$t] += $v['totalExtractCount'];
            }

            if(!$res[$t]){
                $res[$t] = 0;
            }


            if($i == 7){
                $ri[$t] = $S;
            }else if($i == 30 ){
                if( $t%3 == 0){
                    $ri[$t] = $S;
                }else{
                    $ri[$t] = "";
                }
            }else if($i == 365){
                if( $t%30 == 0){
                    $ri[$t] = $S;
                }else{
                    $ri[$t] = "";
                }
            }
        }

        $g = array();
        $g['extract'] = array_reverse($res);
        $g['time'] = array_reverse($ri);

        return $g  ;
    }


    public function getAllData($i){

        $day = date('d',time());
        $month = date('m',time());
        $year = date('Y',time());
        $res = array();
        $ri = array();

        for ($t=0;$t < $i;$t++){

            if($day == 1 && $month == 1){
                $year = $year - 1;
                $month = 12;
                $day = 31;
            }elseif ($day == 1 && ($month == 2 || $month == 4 || $month == 6 || $month == 9 || $month == 11) ){
                $year = $year;
                $month = $month-1;
                $day = 31;
            }elseif ($day == 1 && ($month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) ){
                $year = $year;
                $month = $month-1;
                $day = 30;
            }elseif ($day == 1 && $month == 3){
                if(($year%4==0&&$year%100!=0)||($year%400==0)){
                    $year = $year;
                    $month = $month-1;
                    $day = 29;
                }else{
                    $year = $year;
                    $month = $month-1;
                    $day = 28;
                }

            }else{
                $year = $year;
                $month = $month;
                $day = $day-1;
            }

            $sql = "select * from `ci_invoice` where transTypeName = '销货' and year(createTime) = $year and month(createTime) = $month and day(createTime) = $day";
            $data = $this->mysql_model->query($sql,2);
            $S = $year.'.'.$month.'.'.$day.'.';
            foreach ($data as $k=>$v){
                $res[$t] += $v['totalExtractCount'];
            }

            if(!$res[$t]){
                $res[$t] = 0;
            }


            if($i == 7){
                $ri[$t] = $S;
            }else if($i == 30 ){
                if( $t%3 == 0){
                    $ri[$t] = $S;
                }else{
                    $ri[$t] = "";
                }
            }else if($i == 365){
                if( $t%30 == 0){
                    $ri[$t] = $S;
                }else{
                    $ri[$t] = "";
                }
            }
        }

        $g = array();
        $g['extract'] = array_reverse($res);
        $g['time'] = array_reverse($ri);

        return $g;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */