@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">กล่องข้อความ</div>

                @if($count != 0)
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-{{ session('alert') }}" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                        <th>อีเมลล์ที่แจ้ง</th>
                        <th>บันทึกเมื่อ</th>
                        <th>แก้ไขล่าสุด</th>
                        <th>สถานะ</th>
                        <th>ดำเนินการโดย</th>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                            <tr>
                                <td><a href="{{ url('inbox/'.$contact->id) }}">{{ $contact->email }}</a></td>
                                <td>{{ $contact->created_at }}</td>
                                <td>{{ $contact->updated_at }}</td>
                                <td>
                                    @if($contact->status == 0)<font color="red">ยังไม่อ่าน</font>@endif
                                    @if($contact->status == 1)<font color="green">อ่านแล้ว</font>@endif
                                </td>
                                <td>
                                    {{ $contact->received }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $contacts->render() !!}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
