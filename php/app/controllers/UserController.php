<?php


class UserController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth',array('except'=>array('login', 'Dologin', 'Survey')));
        $this->beforeFilter('csrf',array('on'=>'post'));
        /*
         * Route::post('login',array('before'=>'csrf','uses'=>'UserController@Dologin')); 在路由页面设置
         */
    }

    /**
     * 用户列表页
     * @return string
     */
    public function getIndex(){
        $users = User::paginate('10');
        return View::make('user.list')->with('users', $users);
    }

    /**
     * 添加用户
     * @return string
     */
     public function getAddUser(){
        return View::make('user.add');
    }

    public function postAddUser(){
        //表单验证
        $data = Input::all();
        $rule = array(
            'username'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        );
        $validator = Validator::make($data, $rule);
        if($validator -> fails()){
            $msg1 = $validator->messages()->first('username')."\n";
            $msg2 = $validator->messages()->first('email')."\n";
            $msg3 = $validator->messages()->first('password')."\n";
            $msg = $msg1.$msg2.$msg3;
            return json_encode(array(
                'success' => false,
                'msg' => $msg
                ));
        }
        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $data = array(
            'success' => true,
            'msg' => '提交成功');
        return json_encode($data);
    }

    /**
     * 修改用户密码
     * @return mixed
     */
    public function getEditUser($id){
        $user = User::find($id);
        return View::make('user.edit')->with('user',$user);
    }

    public function postEditUser(){
        //表单验证
        $data = Input::all();
        $rule = array(
            'password'=>'required|min:6|confirmed'
        );
        $validator = Validator::make($data, $rule);
        if($validator -> fails()){
            $msg = $validator->messages()->first('password');
            return json_encode(array(
                'success' => false,
                'msg' => $msg
            ));
        }
        $id = $data['id'];
        $user = User::find($id);
        $user->password = Hash::make($data['password']);
        $user->save();
        $data = array(
            'success' => true,
            'msg' => '提交成功');
        return json_encode($data);
    }

    /**
     * 用户登录
     * @return string
     */
    public function login(){
        return View::make('user.login');
    }

    /**
     *用户提交
     * @return string
     */
    public function Dologin(){
        $username=Input::get('username');
        $password=Input::get('password');
//        $datas = Input::all();
//        $username = $datas['username'];
//        $password = $datas['password'];

        if(Auth::attempt(array('username'=>$username, 'password'=>$password))){
            $data = array(
                'success' => true,
                'msg' => '成功登录，即将跳转后台页面'
            );
            return json_encode($data);
        }else{
            return json_encode(array(
                'success' => false,
                'msg' => "用户名或密码错误"
            ));
        }
    }

    /**
     * 用户注销
     * @return string
     */
    public function logout(){
        Auth::logout();
        return Redirect::to('/login');
    }
}