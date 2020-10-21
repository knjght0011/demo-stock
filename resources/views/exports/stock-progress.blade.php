<table>
    <thead>
    <tr>
        <th>Quote on {{$stockProgressData->start_at}} - {{$stockProgressData->stop_at}}</th>
    </tr>
    <tr>
        <th>import to excel list</th>
    </tr>
    <tr>
        <th>Symbol</th>
        <th>Last</th>
        <th>Mark</th>
        <th>Bid</th>
        <th>Ask</th>
        <th>ATR</th>
        <th>open price pe 1m</th>
        <th>ART per 1m</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{$stockData->stock_symbol}}</td>
        <td>{{$stockProgressDetailLast->value}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        @foreach($timeMileStonesOfStock as $minute)
            <td>
                {{$minute->minutes}}
            </td>

        @endforeach
    </tr>
    @foreach($stockProgressDetailHoursData as $hour)
        <tr>
            <td>{{$hour->hours}}</td>
            @foreach($timeMileStonesOfStock as $minute)
                @php
                    $flg = 0
                @endphp
                @foreach($stockProgressDetailData as $progressDetail)
                    @if($progressDetail->hours === $hour->hours && $progressDetail->minutes === $minute->minutes)
                        <td>{{$progressDetail->value}}</td>
                        @php
                            $flg = 1
                        @endphp
                    @endif
                @endforeach
                @if($flg === 0)
                    <td></td>
                @endif
            @endforeach
        </tr>
    @endforeach
    {{--    @foreach($users as $user)--}}
    {{--        <tr>--}}
    {{--            <td>{{ $user->name }}</td>--}}
    {{--            <td>{{ $user->email }}</td>--}}
    {{--        </tr>--}}
    {{--    @endforeach--}}
    </tbody>
</table>
