<?php

namespace App\Concerns\Enums;

enum Types: string {

    case PRODUCT = 'Producto';
    case POST = 'Post';
    case SIMPLE = 'Simple';
    case VARIABLE = 'Variable';
    case BILLING = 'Facturación';
    case SHIPPING = 'Envío';
    case PERCENT = 'Porcentaje';
    case AMOUNT = 'Monto';

    case CABECERA = 'Cabecera';
    case FOOTER = 'Pie de página';
    case CUSTOM = 'Personalizado';
    case PAGE = 'Página';

    case TEXT = 'Texto simple';
    case TEXTAREA = 'Área de texto';
    case CHECKBOX = 'Checkbox';
    case SELECT = 'Selector';
    case PRODUCT_SELECT = 'Selector de productos';
    case EMAIL = 'Email';
    case CELLPHONE = 'Celular';
    case COUNTRY = 'País';
    case FILE = 'Archivo';
    case DNI = 'DNI';
    case RUC = 'RUC';
    case DATE = 'Fecha';
    case SEPARATOR_TITLE = 'Título separador';

    case DEFAULT = 'Predeterminada';
    case HOME = 'Página de inicio';
    case PRODUCTS = 'Página de productos';
}
