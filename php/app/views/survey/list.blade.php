@extends('common.layout')
@section('title','答卷列表')
@section('content')
    <h2>答卷列表</h2>
            <div class="table_style">
                    <table border="1" width="100%" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                            <td width="5%">id</td>
                            <td width="15%">email</td>
                            <td width="10%">ip</td>
                            <td width="10%">对文献检索的结果是否满意</td>
                            <td width="7%">检索结果不够精准</td>
                            <td width="7%">检索结果不全面</td>
                            <td width="10%">反馈时间超出规定天数</td>
                            <td width="8%">流程繁琐</td>
                            <td width="10%">服务态度不佳</td>
                            <td width="18%">提交时间</td>
                        </tr>
                        @foreach($surveys as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->email}}</td>
                                <td>{{$v->ip}}</td>
                                <td style="color: green;font-weight: bold">{{($v->q1==1)?'✔':''}}</td>
                                <td style="color: green;font-weight: bold">{{($v->q21==1)?'✔':''}}</td>
                                <td style="color: green;font-weight: bold">{{($v->q22==1)?'✔':''}}</td>
                                <td style="color: green;font-weight: bold">{{($v->q23==1)?'✔':''}}</td>
                                <td style="color: green;font-weight: bold">{{($v->q24==1)?'✔':''}}</td>
                                <td style="color: green;font-weight: bold">{{($v->q25==1)?'✔':''}}</td>
                                <td>{{$v->created_at}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                {{$surveys->links()}}
            </div>
@endsection