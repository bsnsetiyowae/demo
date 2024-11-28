@php
    $currency = strtoupper(request()->segment(count(request()->segments())));
@endphp

@foreach ($data as $item)
    @if ($item['currency'] === $currency)
        <table>
            <thead>
                <tr>
                    <th>Bank Code</th>
                    <th>Bank Name</th>
                </tr>
            </thead>
            <tbody>
                @if (array_filter($item['subbanks'], function ($subbank) { return $subbank['type'] === 1; }))
                    <tr>
                        <td><strong>Deposit Code</strong></td>
                        <td></td>
                    </tr>
                    @foreach ($item['subbanks'] as $subbank)
                        @if ($subbank['type'] === 1)
                            <tr>
                                <td><code>{{ $subbank['code'] }}</code></td>
                                <td>{{ $subbank['name'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif

                @if (array_filter($item['subbanks'], function ($subbank) { return $subbank['type'] === 2; }))
                    <tr>
                        <td><strong>Withdraw Code</strong></td>
                        <td></td>
                    </tr>
                    @foreach ($item['subbanks'] as $subbank)
                        @if ($subbank['type'] === 2)
                            <tr @class(['bg-red-200' => $subbank['is_maintenance']])>
                                <td><code>{{ $subbank['code'] }}</code></td>
                                <td>{{ $subbank['name'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    @endif
@endforeach
