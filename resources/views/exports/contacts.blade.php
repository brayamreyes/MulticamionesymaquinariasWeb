<table cellspacing="0" cellpadding="0" border="1">
    <tbody>
        <tr>
            @foreach ($fields as $f => $field)
                <td style="background: #000000; color: #FFFFFF; text-align: center;">{{$field['name']}}</td>
            @endforeach
            <td style="background: #000000; color: #FFFFFF; text-align: center;">Fecha de registro</td>
        </tr>
        @foreach($contacts as $contact)
            <tr>
                @foreach($contact['fields'] as $item)
                    @isset($item['field'])
                        @if($item['field']['type'] !== \App\Concerns\Enums\Types::SEPARATOR_TITLE->value)
                            <td>
                                @if(
                                    $item['field']['type'] === \App\Concerns\Enums\Types::TEXT->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::EMAIL->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::COUNTRY->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::SELECT->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::PRODUCT_SELECT->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::DNI->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::RUC->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::CELLPHONE->value ||
                                    $item['field']['type'] === \App\Concerns\Enums\Types::TEXTAREA->value)
                                    <span>{{$item['value']}}</span>
                                @endif
                                @if($item['field']['type'] === \App\Concerns\Enums\Types::CHECKBOX->value)
                                    <span>{{($item['value'] === '0' ? 'No' : 'Si')}}</span>
                                @endif
                                @if($item['field']['type'] === \App\Concerns\Enums\Types::DATE->value)
                                    <span>{{date("d/m/Y", strtotime($item['value']))}}</span>
                                @endif
                                @if($item['field']['type'] === \App\Concerns\Enums\Types::FILE->value)
                                    <a target="_blank" href="{{url($item['value'])}}">Descargar</a>
                                @endif
                            </td>
                        @endif
                    @else
                        <td>-</td>
                    @endisset
                @endforeach
                <td>{{date("d/m/Y H:i", strtotime($contact['created_at']))}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
