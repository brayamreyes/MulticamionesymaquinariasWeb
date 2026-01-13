<?php

namespace App\Concerns\Enums;

enum TEXTS: string {

    case TERMS_CONDITIONS = '<ul><li>La información contenida en la presente cotización es confidencial.</li>
<li>La presente cotización detalla especificaciones técnicas y capacidades máximas. Es responsabilidad del cliente utilizar el vehículo de acuerdo con la legislación vigente.</li>
<li>La facturación/boleta de la(s) unidad(es) se realiza en dólares norteamericanos. El precio en soles es referencial y se determinará de acuerdo con el tipo de cambio vigente del día que el cliente genere la compra de la unidad, de acuerdo con el artículo 1237 del Código Civil.</li>
<li>Para pagos en soles vía recaudación en los bancos BBVA Continental y Scotiabank, el tipo de cambio será el aplicable en la institución financiera.</li>
<li>No se aceptan y carecen de validez los depósitos, transferencias y/o entregas de dinero directas a personal de Multi Camiones y Maquinarias o terceros. Multi Camiones y Maquinarias no se hace responsable por este tipo de transacciones y la operación se considerará como no cancelada.</li>
<li>Es responsabilidad del cliente solicitar correctamente el documento que necesitará como comprobante de pago. El cliente no podrá solicitar un cambio de comprobante de pago (de boleta a factura o viceversa) una vez emitido el mismo.</li>
<li>Los plazos de entrega serán confirmados una vez cancelada la unidad.</li>
<li>Los plazos de entrega pueden variar debido a causas de fuerza mayor, caso fortuito o a otras ajenas a nuestra voluntad.</li>
<li>Los plazos de entrega no incluyen trámites de inscripción en registros públicos, ni entrega de placas de rodaje.</li>
<li>En caso de brindarse el servicio de trámites de placa y tarjeta de propiedad, sólo se iniciarán una vez completado el pago de la unidad y con todos los documentos completos para dicho trámite.</li>
<li>Multi Camiones y Maquinarias no responde por las demoras ocasionadas en la obtención de la TIVE (observación registral y/o inscripción de garantías mobiliarias solicitadas por las entidades financieras por los créditos otorgados) o en la producción de las placas.</li>
<li>La orden de compra emitida por el cliente deberá indicar la aceptación de los términos y condiciones generales aquí descritos.</li>
<li>Inscripción en el SAT es obligación del cliente, en caso sea necesario.</li>
<li>Vencido el plazo para el recojo de la unidad (72 horas) se procederá al respectivo almacenaje de la unidad. Multi Camiones y Maquinarias no será responsable de la cobertura del seguro de la unidad, siendo está a cuenta y cargo del cliente.</li>
<li>El correo electrónico proporcionado será utilizado para la notificación de entrega.</li>
<li>Al aceptar la presente cotización, el cliente declara y acepta tener conocimiento de la legislación vigente sobre minería ilegal, norma para la prevención del lavado de activos y del financiamiento del terrorismo, y que los fondos con los que se adquiere los bienes son de carácter lícito, manifestando que las actividades para las cuales destinará el(los) bien(es) adquirido(s) cumplen con la regulación vigente sobre la materia.</li>
<li>En todos los procesos, Multi Camiones y Maquinarias seguirá sus protocolos de seguridad y salubridad.</li></ul>';
    case WAY_TO_PAY = '<p>100% al contado<br>Financiamiento a través de entidades del sistema financiero</p>';
    case DELIVERY_TERM = '<p>01 día<br>Importante: Los tiempos de entrega son estimados y se consideran a partir de la cancelación de la unidad. El plazo indicado no considera el trámite de placas en caso de venta unidad nuevas.</p>';
}
