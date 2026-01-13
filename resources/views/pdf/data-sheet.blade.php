@extends('layouts.pdf')
@section('content')
    @php
        $settings = new \App\Settings\GeneralSetting();

        $content = $product['content'];
        $gallery = [];
        $specifies = [];

        if ($content) {
            foreach ($content as $item) {
                if ($item['type'] === 'gallery') {
                    $gallery = $item['data']['gallery'];
                }

                if ($item['type'] === 'general_specifications') {
                    $specifies = $item['data']['general_specifications'];
                }
            }
        }
    @endphp
    <header>
        <table style="width: 100%; border: none; border-bottom: 1px solid #CCC; padding-left: 40px; padding-right: 40px;">
            <tbody>
            <tr>
                <td>
                    <div style="font-size: 12px; font-weight: bold; color: #1C3E7E;">
                        {{$settings->business_name}}<br>
                        RUC: {{$settings->ruc}}
                    </div>
                </td>
                <td style="text-align: right">
                    <img src="{{url('storage/web/' . $settings->quotation_logo)}}" style="height: 40px;" />
                </td>
            </tr>
            </tbody>
        </table>
    </header>

    <footer>
        <div style="text-align: center; font-size: 12px; font-weight: bold; color: #1C3E7E;">
            {{$settings->address}}<br>
            {{config('app.url')}}
        </div>
    </footer>

    <main>
        <h4 style="text-align: center; color: #2F5496; margin-top: 10px; margin-bottom: 20px; font-size: 18px;">Ficha técnica<br> {{$product->type}} - {{($product->brand ? $product->brand['name'] . ' - ' : '')  }}{{$product['model']}} - Fabricación: {{$product['year_manufacture']}} - Modelo: {{$product['year_model']}}</h4>

        @if(count($specifies) > 0)
            <h3 style="color: #2F5496; margin-bottom: 10px; text-transform: uppercase;">Especificaciones técnicas</h3>
            <div style="margin-bottom: 30px;">
                @foreach($specifies as $specify)
                    <div>
                        <h5 style="color: #000000; margin-bottom: 5px; text-transform: uppercase;">{{$specify['title']}}</h5>
                        <div style="padding-left: 20px;">
                            <table style="width: 100%; border: none;">
                                <tbody>
                                    @foreach($specify['items'] as $item)
                                        <tr>
                                            <td style="width: 20%; border: none; padding-top: 5px; padding-bottom: 5px;">{{$item['Nombre']}}</td>
                                            <td style="width: 10%; border: none; text-align: center; padding-top: 5px; padding-bottom: 5px;">:</td>
                                            <td style="width: 70%; border: none; padding-top: 5px; padding-bottom: 5px;">{{$item['Valor']}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if($product['image_2'])
            <div style="text-align: center">
                <img src="{{url('storage/web/' . $product['image_2'])}}" style="width: 400px; display: block;" />
            </div>
        @endif
    </main>
@endsection
