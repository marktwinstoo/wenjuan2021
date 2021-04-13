<?php


class SurveyController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth',array('except'=>array('login', 'Dologin','Survey')));
        $this->beforeFilter('csrf',array('on'=>'post'));
        /*
         * Route::post('login',array('before'=>'csrf','uses'=>'UserController@Dologin')); 在路由页面设置
         */
    }

    /**
     * 前台首页
     * @return string
     */
    public function Survey($email=""){
        return View::make('index')->withEmail($email);
    }

    /**
     * 前台问卷逻辑提交
     * @return
     */
    /**
     * @return false|string
     */
    public function SubmitSurvey(){
        $datas=Input::all();
        $rules=array(
            'email'=>'required|email|unique:records'
        );
        $validator = Validator::make($datas,$rules);
        if($validator->fails()){
            $msg=$validator->messages()->first('email');
            return json_encode(array('success'=>false,'msg'=>$msg));
        }
        $survey = new Survey();
        $survey->email=$datas['email'];
        $survey->ip=$_SERVER['REMOTE_ADDR'];
        $survey->q1=$datas['q1'];
        if ($survey->q1==0){
            $survey->q21=$datas['q21'];
            $survey->q22=$datas['q22'];
            $survey->q23=$datas['q23'];
            $survey->q24=$datas['q24'];
            $survey->q25=$datas['q25'];
        }
        $survey->save();

        $data = array('success'=>true,'msg'=>'提交成功');
        return json_encode($data);
    }

    /**
     * 后台问卷列表
     * @return string
     */
    public function getIndex(){
        $surveys = Survey::orderby('created_at','desc')->paginate(10);
        return View::make('survey.list')->with('surveys',$surveys);
    }

    /**
     * 后台首页
     * @return string
     */
    public function AdminIndex(){
        return View::make('adminindex');
    }

    /**
     *图表数据请求
     */
    public function ShowChart(){
        $result=Survey::all();
        $aList=array('q11'=>0,'q12'=>0,'q21'=>0,'q22'=>0,'q23'=>0,'q24'=>0,'q25'=>0,);
        foreach ($result as $v){
            if($v->q1==1)
                $aList['q11']++;
            else{
                $aList['q12']++;
                $aList['q21'] += $v->q21;
                $aList['q22']+= $v->q22;
                $aList['q23']+= $v->q23;
                $aList['q24']+= $v->q24;
                $aList['q25']+= $v->q25;
            }
        }
        return json_encode($aList);
    }
}