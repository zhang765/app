<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function request(Request $request){
        $data=$request->all();

        dump($data);
        return redirect()->route('index');
    }
    public function get(){
        $data=array_rand(range(1,3000),1500);
        shuffle($data);
        //快速排序
        function getdata($data){
            if(!isset($data[1])){
                return $data;
            }
            $left=array();
            $right=array();
            foreach ($data as $item) {
                if($item>$data[0]){
                    $right[]=$item;
                }
                if($item<$data[0]){
                    $left[]=$item;
                }
      }
            $left=getdata($left);
            $left[]=$data[0];
            $right=getdata($right);
            return array_merge($left,$right);
        }
        //冒泡排序
        function getmaop($data){
            for ($i=0,$length=count($data);$i<$length;$i++){
                for ($j=$length-1;$j>$i;$j--){
                    if($data[$i]<$data[$j]){
                        $data[$i]=$data[$j]+$data[$i];
                        $data[$j]=$data[$i]-$data[$j];
                        $data[$i]=$data[$i]-$data[$j];
                    }
                }
            }
            return $data;
        }
        //选择排序
        function select_sort($data){
            for ($i=0,$len=count($data);$i<$len;$i++){
                $p=$i;
                for($j=$i+1;$j<$len;$j++){
                    if($data[$p]>$data[$j]){
                        $p=$j;
                    }
                }
                if($p!=$i){
                    $tmp=$data[$p];
                    $data[$p]=$data[$i];
                    $data[$i]=$tmp;
                }
            }
            return $data;
        }

        //插入排序
        function insert_sort($data){
            for ($i=1,$len=count($data);$i<$len;$i++){
                $tmp=$data[$i];
                for ($j=$i-1;$j>=0;$j--){
                    if($tmp<$data[$j]){
                        $data[$j+1]=$data[$j];
                        $data[$j]=$tmp;
                    }else{
                        break;
                    }
                }
            }
            return $data;
        }


        $t1=microtime(true);
        $data=getdata($data);
        $t2=microtime(true);
        dump(($t2-$t1)*1000 .'ms <br/>');
        dump($data);


        $t1=microtime(true);
        $data=getmaop($data);
        $t2=microtime(true);
        dump(($t2-$t1)*1000 .'ms <br/>');
        dump($data);

        $t1=microtime(true);
        $data=select_sort($data);
        $t2=microtime(true);
        dump(($t2-$t1)*1000 .'ms <br/>');
        dump($data);

        $t1=microtime(true);
        $data=insert_sort($data);
        $t2=microtime(true);
        dump(($t2-$t1)*1000 .'ms <br/>');
        dump($data);

    }
    public function setSession(Request $request){
       $request->session()->flash('name','zhang');
    }

    /**
     * @param Request $request
     */
    public function getSession(Request $request){
        function myHash($str){
            $hash=0;
            $str=md5($str);
            $send=5;
            for ($i=0;$i<32;$i++){
                $hash= ($hash << $send)+$hash+ord($str{$i});
            }
            return $hash & 0x7FFFFFFF;
        }
        dump(myHash('zhangkaizhi'));

    }
    public function delSession(Request $request){
            $request->session()->forget('name');
            return redirect('get');
    }
    public function setCookie(){

        dump(date('Y-m-d H:s:i'));
        return response('adf')
            ->header('Content-Type', 'text/html')
            ->cookie('name', 'value', 30);
    }
    public function getCookie()
    {
        $d=new SphinxClient();
        $c=new SphinxClient();
        dd($d,$c);
    }

}
