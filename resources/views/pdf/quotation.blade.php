@extends('layouts.pdf')
@section('content')
    @php
        $settings = new \App\Settings\GeneralSetting();

        $content = $quotation->product['content'];
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
            {{$quotation["code"]}}<br>
            {{$settings->address}}<br>
            {{config('app.url')}}
        </div>
    </footer>

    <main>
        <h4 style="text-align: center; color: #2F5496; margin-top: 10px; margin-bottom: 20px; font-size: 18px;">Cotización Nro {{$quotation["code"]}}</h4>

        <div style="margin-bottom: 20px;">
            <p><b>Estimado(s):</b> {{$quotation['first_name']}} {{$quotation['last_name']}}</p>
            <p><b>RUC:</b> {{$quotation['ruc']}}</p>
            <p><b>Razón Social</b> {{$quotation['business_name']}}</p>
        </div>

        <p style="margin-bottom: 5px;">Por la presente, le hacemos llegar con mucho gusto nuestra oferta más atractiva para la siguiente unidad:</p>

        <h4 style="color: #2F5496; margin-bottom: 30px;">{{$quotation->product->type}} - {{($quotation->product->brand ? $quotation->product->brand['name'] . ' - ' : '')  }}{{$quotation->product['model']}} - Fabricación: {{$quotation->product['year_manufacture']}} - Modelo: {{$quotation->product['year_model']}} - {{$quotation->product['plate']}}</h4>

        @if($quotation->product['image_2'])
            <div style="margin-bottom: 30px;">
                <img src="{{url('storage/web/' . $quotation->product['image_2'])}}" style="width: 400px; display: block;" />
            </div>
        @endif

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

        <h3 style="color: #2F5496; margin-bottom: 10px; text-transform: uppercase;">Precio de venta</h3>

        <table style="width: 100%; border: none; margin-bottom: 30px;">
            <tbody>
                <tr>
                    <td style="width: 30%; border: none; padding: 5px 10px; background-color: #578cec;">
                        <b style="color: #000;">VALOR VENTA</b>
                    </td>
                    <td style="width: 40%; border: none; text-align: center; padding: 5px 10px; background-color: #578cec;">
                        <b style="color: #000;">USD {{number_format($quotation['dollar_price'], 2)}}</b>
                    </td>
                    <td style="width: 30%; border: none; padding: 5px 10px; background-color: #578cec;">
                        <b style="color: #000;">PEN {{number_format($quotation['pen_price'], 2)}}</b>
                    </td>
                </tr>

                <tr>
                    <td style="width: 30%; border: none; padding: 5px 10px; background-color: #326BD6;">
                        <b style="color: #000;">IGV (18%)</b>
                    </td>
                    <td style="width: 40%; border: none; text-align: center; padding: 5px 10px; background-color: #326BD6;">
                        <b style="color: #000;">USD {{number_format($quotation['dollar_igv'], 2)}}</b>
                    </td>
                    <td style="width: 30%; border: none; padding: 5px 10px; background-color: #326BD6;">
                        <b style="color: #000;">PEN {{number_format($quotation['pen_igv'], 2)}}</b>
                    </td>
                </tr>

                <tr>
                    <td style="width: 30%; border: none; padding: 5px 10px; background-color: #1C3E7E;">
                        <b style="color: #FFF;">PRECIO DE VENTA</b>
                    </td>
                    <td style="width: 40%; border: none; text-align: center; padding: 5px 10px; background-color: #1C3E7E;">
                        <b style="color: #FFF;">USD {{number_format($quotation['dollar_final_price'], 2)}}</b>
                    </td>
                    <td style="width: 30%; border: none; padding: 5px 10px; background-color: #1C3E7E;">
                        <b style="color: #FFF;">PEN {{number_format($quotation['pen_final_price'], 2)}}</b>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; border: none; padding: 5px 10px;" colspan="3">
                        <b style="color: #000;">TC Referencial {{$settings->exchange}}</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <ul style="margin-bottom: 30px;">
            <li>Precio de la cotización fijado en dólares americanos. Tipo de cambio utilizado para el cálculo referencial es de S/ {{$settings->exchange}} por dólar americano.</li>
            <li>El precio indicado puede sufrir modificaciones por causas ajenas a nuestra voluntad, como variaciones del tipo de cambio, fluctuaciones de mercado, tributos, entre otros.</li>
        </ul>

        <h3 style="color: #2F5496; margin-bottom: 0; text-transform: uppercase;">Forma de pago</h3>
        <div style="margin-bottom: 30px;">
            {!! $quotation['way_to_pay'] !!}
        </div>

        <h3 style="color: #2F5496; margin-bottom: 0; text-transform: uppercase;">Plazo de entrega</h3>
        <div style="margin-bottom: 30px;">
            {!! $quotation['delivery_term'] !!}
        </div>

        <h3 style="color: #2F5496; margin-bottom: 0; text-transform: uppercase;">Lugar de entrega</h3>
        <div style="margin-bottom: 30px;">
            <p style="margin-bottom: 5px;">Multi Camiones y Maquinarias procederá con la entrega de la unidad en su almacén ubicado en Av. Defensores del Morro 4263, Chorrillos, Lima. Es requisito que el cliente firme los siguientes documentos: Acta de Entrega, Guía de Remisión Remitente y Check List de la unidad.</p>
            <p>El cliente es responsable, bajo su cuenta, costo, riesgo y de forma exclusiva, por el carrozado o transformación a realizarse a la unidad vendida por Multi Camiones y Maquinarias, eximiendo a Multi Camiones y Maquinarias de cualquier responsabilidad en torno a los aspectos técnicos de la carrocería o estructura. Asimismo, efectuada la entrega física de la unidad, el cliente declara haber recibido la unidad a su entera satisfacción.</p>
        </div>

        <h3 style="color: #2F5496; margin-bottom: 0; text-transform: uppercase;">Validez de la oferta</h3>
        <div style="margin-bottom: 30px;">
            <p style="margin-bottom: 5px;">Emisión: {{date('d/m/Y')}}<br>7 días calendarios</p>
        </div>

        <h3 style="color: #2F5496; margin-bottom: 10px; text-transform: uppercase;">Garantía</h3>
        <div style="margin-bottom: 30px;">
            <p>Por tratarse de una venta de una unidad de segunda mano, la venta está bajo la modalidad "Ad Corpus", es decir, "como está y donde está".</p>
        </div>

        <h3 style="color: #2F5496; margin-bottom: 10px; text-transform: uppercase;">Servicios adicionales</h3>
        <div style="margin-bottom: 30px;">
            <p>En caso de que Multi Camiones y Maquinarias brinde el servicio de trámite de tarjeta de propiedad y placas de rodaje, se procederá con los trámites mencionados al momento de contar con todos los documentos completos del carrocero necesarios para la inmatriculación. De presentarse demoras o retrasos en la inmatriculación u obtención de placas de rodaje, por incumplimiento del cliente, observación registral y/o inscripción de garantías mobiliarias solicitadas por las entidades financieras por los créditos otorgados, no generarán responsabilidad alguna por parte de Multi Camiones y Maquinarias.</p>
        </div>

        <h3 style="color: #2F5496; margin-bottom: 10px; text-transform: uppercase;">Términos y condiciones especiales</h3>
        <div style="margin-bottom: 30px;">
            {!! $quotation['terms_conditions'] !!}
        </div>

        @php
            $admin = \App\Models\Admin::find($quotation->admin_id);
        @endphp
        <div style="padding-top: 50px;">
            <table style="width: 100%; border: none;">
                <tbody>
                    <tr>
                        <td style="text-align: center">
                            <div>
                                @if($admin)
                                    @if($admin->signature_file)
                                        <img src="{{url('storage/web/' . $admin->signature_file)}}" style="height: 80px;" /><br>
                                    @endif
                                    {{$admin->name}}<br>
                                @endif
                                {{$settings->business_name}}<br>
                                RUC {{$settings->ruc}}
                            </div>
                        </td>
                        <td style="text-align: center">
                            <div>
                                @if($admin->signature_file)
                                    <div style="height: 80px;"></div><br>
                                @endif
                                {{$quotation->first_name . ' ' . $quotation->last_name}}<br>
                                {{$quotation->business_name}}<br>
                                RUC {{$quotation->ruc}}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
