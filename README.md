# Turnos Médicos API

API REST para gestionar turnos médicos, desarrollada con Laravel. Permite administrar especialidades, médicos, pacientes y turnos, con validaciones pensadas para el ámbito de la salud.

## Tecnologías

- PHP 8.4
- Laravel
- SQLite
- Laravel Herd (entorno de desarrollo local)

## Modelo de datos

- **Especialidad**: tiene muchos médicos.
- **Médico**: pertenece a una especialidad y tiene muchos turnos.
- **Paciente**: tiene muchos turnos.
- **Turno**: pertenece a un paciente y a un médico.

## Instalación

1. Clonar el repositorio:

```bash
git clone https://github.com/VIKK7OR13/turnos-medicos.git
cd turnos-medicos
```

2. Instalar las dependencias:

```bash
composer install
```

3. Crear el archivo de configuración y generar la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

4. Crear las tablas y cargar los datos de prueba (si Laravel pregunta si querés crear el archivo de la base SQLite, respondé `yes`):

```bash
php artisan migrate:fresh --seed
```

5. Levantar el proyecto (con Laravel Herd queda disponible en `http://turnos-medicos.test`; sin Herd, se puede usar `php artisan serve`).

## Endpoints

Cada recurso tiene las cinco operaciones del CRUD:

| Método | Ruta | Acción |
|--------|------|--------|
| GET | `/api/{recurso}` | Listar todos |
| POST | `/api/{recurso}` | Crear uno |
| GET | `/api/{recurso}/{id}` | Ver uno |
| PUT/PATCH | `/api/{recurso}/{id}` | Modificar |
| DELETE | `/api/{recurso}/{id}` | Eliminar |

Recursos disponibles: `especialidades`, `medicos`, `pacientes` y `turnos`.

Los médicos se devuelven con su especialidad, y los turnos con su paciente y su médico (incluida la especialidad).

### Ejemplo: crear un turno

`POST /api/turnos`

```json
{
  "paciente_id": 1,
  "medico_id": 2,
  "fecha": "2026-12-15",
  "hora": "09:30",
  "motivo": "Control anual"
}
```

## Reglas de negocio y validaciones

- No se pueden asignar dos turnos al mismo médico en la misma fecha y hora.
- La fecha de un turno no puede ser anterior a hoy.
- El estado de un turno puede ser `pendiente` (valor por defecto), `confirmado` o `cancelado`.
- El DNI de los pacientes y la matrícula de los médicos no pueden repetirse.
- La fecha de nacimiento de un paciente debe ser anterior a hoy.
- El teléfono y la obra social del paciente son opcionales.

## Autor

Victor - [@VIKK7OR13](https://github.com/VIKK7OR13)