@foreach($historys as $history )

user Id :{{ $history->user_id }} <br>
user name :{{ $history->user_record->name }} <br>
user status :{{ $history->status ==0 ? 'Login' : 'logout' }} <br><br>
@endforeach