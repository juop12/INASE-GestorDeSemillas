# INASE Gestor de Semillas - Arquitectura del Sistema

## Diagrama de Base de Datos

```
┌─────────────────────────────────┐
│          SAMPLES                │
├─────────────────────────────────┤
│ id (PK, AUTO_INCREMENT)         │
│ codigo_muestra (UNIQUE)         │  ← Auto-generado: MUE-YYYY-NNNN
│ numero_precinto                 │
│ empresa                         │
│ especie                         │  ← Indexado
│ cantidad_semillas               │
│ created (DATETIME)              │  ← Indexado
│ modified (DATETIME)             │
└─────────────────────────────────┘
          │
          │ hasMany
          │
          ▼
┌─────────────────────────────────┐
│          RESULTS                │
├─────────────────────────────────┤
│ id (PK, AUTO_INCREMENT)         │
│ sample_id (FK)                  │  ← Foreign Key a samples.id
│ poder_germinativo (DECIMAL 5,2) │  ← Porcentaje 0-100
│ pureza (DECIMAL 5,2)            │  ← Porcentaje 0-100
│ materiales_inertes (TEXT)       │  ← Opcional
│ created (DATETIME)              │
│ modified (DATETIME)             │
└─────────────────────────────────┘
```

## Flujo de Navegación

```
┌──────────────────────┐
│   Página Principal   │
│    (Muestras)        │
└──────────────────────┘
          │
          ├─────────────────┐
          │                 │
          ▼                 ▼
┌──────────────────┐   ┌──────────────────┐
│  Nueva Muestra   │   │  Lista Muestras  │
│  (add)           │   │  (index)         │
└──────────────────┘   └──────────────────┘
                              │
                              ├──────────────┐
                              │              │
                              ▼              ▼
                    ┌─────────────────┐  ┌────────────────┐
                    │ Detalle Muestra │  │ Editar Muestra │
                    │ (view)          │  │ (edit)         │
                    └─────────────────┘  └────────────────┘
                              │
                              │ Ver/Agregar Resultados
                              │
                              ▼
                    ┌─────────────────────┐
                    │   Resultados        │
                    │   (Results/index)   │
                    └─────────────────────┘
                              │
                              ├─────────────────┐
                              │                 │
                              ▼                 ▼
                    ┌──────────────────┐  ┌──────────────────┐
                    │ Nuevo Resultado  │  │ Editar Resultado │
                    │ (add)            │  │ (edit)           │
                    └──────────────────┘  └──────────────────┘

┌─────────────────────────────────┐
│       MÓDULO DE REPORTES        │
│                                 │
│  ┌──────────────────────────┐   │
│  │   Filtros:               │   │
│  │   - Especie              │   │
│  │   - Fecha Desde          │   │
│  │   - Fecha Hasta          │   │
│  └──────────────────────────┘   │
│                                 │
│  ┌──────────────────────────┐   │
│  │   Estadísticas:          │   │
│  │   - Total Muestras       │   │
│  │   - Total Semillas       │   │
│  │   - Muestras c/Resultados│   │
│  │   - Prom. Poder Germ.    │   │
│  │   - Prom. Pureza         │   │
│  └──────────────────────────┘   │
│                                 │
│  ┌──────────────────────────┐   │
│  │   Detalle de Muestras    │   │
│  │   (Tabla completa)       │   │
│  └──────────────────────────┘   │
└─────────────────────────────────┘
```

## Arquitectura MVC

```
┌─────────────────────────────────────────────────────────┐
│                        USUARIO                           │
└─────────────────────────────────────────────────────────┘
                           │
                           │ HTTP Request
                           ▼
┌─────────────────────────────────────────────────────────┐
│                   WEBROOT/INDEX.PHP                      │
│              (Punto de entrada de CakePHP)               │
└─────────────────────────────────────────────────────────┘
                           │
                           ▼
┌─────────────────────────────────────────────────────────┐
│                    ROUTING MIDDLEWARE                    │
│          (Determina Controller y Action a llamar)        │
└─────────────────────────────────────────────────────────┘
                           │
                           ▼
        ┌──────────────────┴──────────────────┐
        │                                     │
        ▼                                     ▼
┌──────────────────┐               ┌─────────────────────┐
│  CONTROLLERS     │               │   CONTROLLERS       │
│                  │               │                     │
│  Samples         │               │   Results           │
│  - index()       │               │   - index()         │
│  - view()        │               │   - view()          │
│  - add()         │               │   - add()           │
│  - edit()        │               │   - edit()          │
│  - delete()      │               │   - delete()        │
└──────────────────┘               └─────────────────────┘
        │                                     │
        │                                     │
        ▼                                     ▼
┌──────────────────┐               ┌─────────────────────┐
│  MODELS (Table)  │◄──────────────┤  MODELS (Table)     │
│                  │    belongsTo  │                     │
│  SamplesTable    │               │  ResultsTable       │
│  - validations   │   hasMany     │  - validations      │
│  - beforeMarshal │──────────────►│  - foreign key      │
│  - auto-codigo   │               │                     │
└──────────────────┘               └─────────────────────┘
        │                                     │
        │                                     │
        ▼                                     ▼
┌──────────────────┐               ┌─────────────────────┐
│  ENTITIES        │               │   ENTITIES          │
│                  │               │                     │
│  Sample          │               │   Result            │
│  - $_accessible  │               │   - $_accessible    │
└──────────────────┘               └─────────────────────┘
        │                                     │
        ▼─────────────────────────────────────▼
┌─────────────────────────────────────────────────────────┐
│                    DATABASE (MySQL)                      │
│                                                          │
│     tables: samples, results                             │
└─────────────────────────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────────────────────────┐
│                       VIEWS                              │
│                                                          │
│  templates/Samples/*     templates/Results/*             │
│  templates/Reports/*     templates/layout/default.php    │
└─────────────────────────────────────────────────────────┘
        │
        │ HTML + CSS
        ▼
┌─────────────────────────────────────────────────────────┐
│                        USUARIO                           │
│                  (Ve la página renderizada)              │
└─────────────────────────────────────────────────────────┘
```

## Flujo de Auto-generación de Código

```
Usuario crea nueva muestra
         │
         ▼
SamplesController::add()
         │
         ▼
SamplesTable::beforeMarshal()
         │
         ├─ 1. Obtener año actual (YYYY)
         │
         ├─ 2. Buscar último código del año:
         │    SELECT codigo_muestra
         │    FROM samples
         │    WHERE codigo_muestra LIKE 'MUE-YYYY-%'
         │    ORDER BY id DESC
         │    LIMIT 1
         │
         ├─ 3. Extraer número secuencial
         │    (ej: MUE-2024-0003 → 3)
         │
         ├─ 4. Incrementar: 3 + 1 = 4
         │
         ├─ 5. Formatear nuevo código:
         │    sprintf('MUE-%s-%04d', YYYY, 4)
         │    = 'MUE-2024-0004'
         │
         └─ 6. Asignar a $data['codigo_muestra']
                │
                ▼
         Guardar en base de datos
```

## Componentes de Seguridad

- **CSRF Protection**: FlashComponent en AppController
- **SQL Injection**: Prepared statements de CakePHP ORM
- **XSS Protection**: Template escaping automático con h()
- **Validación de Datos**: Validator en cada Table
- **Foreign Keys**: Integridad referencial en BD
