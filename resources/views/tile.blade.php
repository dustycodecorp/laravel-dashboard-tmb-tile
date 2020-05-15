<x-dashboard-tile :position="$position" :refresh-interval="$refreshIntervalInSeconds">
    <div class="grid grid-rows-auto-1">
        @isset($title)
            <div class="flex items-center">
                <h1 class="font-bold">
                    🚌 {{ $title }}
                </h1>
                <div class="ml-auto text-xs text-dimmed font-light">
                    Stop id: {{$stopId}}
                </div>
            </div>
        @endisset
        @if($buses && count($buses) > 0)
            <ul class="divide-y-2 my-2">
                @foreach($buses as $bus)
                    <li class="overflow-hidden py-2">
                        <div class="leading-tight">
                            <div class="text-sm flex space-between items-center ">
                                <div class="p-1 rounded mr-4 w-12 text-center text-white font-bold" style="background-color: {{ $bus['lineColor'] }}">
                                    {!! $bus['line'] !!}
                                </div>
                                <div class="mr-auto">
                                    {!! $bus['destination'] !!}
                                </div>
                                <div class="font-semibold {{ $bus['timeColor'] }}">
                                    {!! $bus['text-ca'] !!}
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="flex justify-center text-xs gray">
                Sorry, no TMB bus data have been found
            </div>
        @endif
    </div>
</x-dashboard-tile>
