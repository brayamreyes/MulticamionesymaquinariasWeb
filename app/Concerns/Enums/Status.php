<?php

namespace App\Concerns\Enums;

enum Status: string {

    case ACTIVE = 'Activo';
    case PUBLISHED = 'Publicado';
    case DRAFT = 'Borrador';
    case PENDING = 'Pendiente';
    case PROCESSING = 'En proceso';
    case FINISHED = 'Finalizado';
    case CANCELLED = 'Cancelado';
    case REFUNDED = 'Devuelto';
    case FAILED = 'Error';
    case UPDATE_PASSWORD = 'Actualizar contraseña';
    case SCHEDULED = 'Programado';

    case ACCEPTED = 'Aceptada';


}
