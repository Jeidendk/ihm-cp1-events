# Informe Técnico: Sistema de Gestión de Eventos

**Fecha:** 26 de Diciembre, 2025
**Proyecto:** Event Management System / Stitch Event Creation

## 1. Diseño de Navegación (Wireflow)

El siguiente diagrama ilustra el flujo de navegación de la aplicación. El usuario aterriza en el **Dashboard** principal, desde donde puede navegar a las secciones de gestión de **Eventos**, **Ubicaciones** y **Contactos**. Cada una de estas secciones permite visualizar, crear, editar y eliminar registros (CRUD).

```mermaid
graph TD
    User((Usuario)) --> |Visita /| Dashboard[Dashboard Principal]
    
    Dashboard --> |Clic en Eventos| Events[Gestión de Eventos]
    Dashboard --> |Clic en Ubicaciones| Locations[Gestión de Ubicaciones]
    Dashboard --> |Clic en Contactos| Contacts[Gestión de Contactos]
    
    subgraph "Módulo de Eventos (/events)"
        Events --> listEvents[Ver Lista de Eventos]
        Events --> createEvent[Crear Nuevo Evento]
        Events --> editEvent[Editar Evento Existente]
        Events --> deleteEvent[Eliminar Evento]
        createEvent --> |Guardar| listEvents
        editEvent --> |Actualizar| listEvents
    end

    subgraph "Módulo de Ubicaciones (/locations)"
        Locations --> listLoc[Ver Lista de Ubicaciones]
        Locations --> createLoc[Crear Nueva Ubicación]
        Locations --> editLoc[Editar Ubicación]
        createLoc --> |Guardar| listLoc
        editLoc --> |Actualizar| listLoc
    end

    subgraph "Módulo de Contactos (/contacts)"
        Contacts --> listContact[Ver Lista de Contactos]
        Contacts --> createContact[Crear Nuevo Contacto]
        Contacts --> editContact[Editar Contacto]
        createContact --> |Guardar| listContact
        editContact --> |Actualizar| listContact
    end
```

## 2. Diseño de Pantallas y Funcionalidades

### 2.1 Dashboard Principal (`/dashboard`)
**Funcionalidad:**
-   Punto de entrada principal.
-   Muestra métricas clave (ej. total de eventos, ubicaciones).
-   Acceso rápido a las secciones principales mediante tarjetas de navegación.

### 2.2 Gestión de Eventos (`/events`)
**Funcionalidad:**
-   **Listado:** Muestra todos los eventos registrados con detalles como nombre, fecha y ubicación.
-   **Creación:** Formulario (generalmente en modal o nueva página) para agregar nombre del evento, fecha, imagen y asignar una ubicación.
-   **Edición/Eliminación:** Controles para modificar o borrar eventos.
-   **Integración:** Utiliza las ubicaciones registradas.

### 2.3 Gestión de Ubicaciones (`/locations`)
**Funcionalidad:**
-   **Listado:** Visualiza las sedes disponibles.
-   **Gestión:** Permite agregar direcciones, nombres de sedes y capacidades.
-   **Mapa:** (Si implementado) Muestra la ubicación en un mapa (Google Maps).

### 2.4 Gestión de Contactos (`/contacts`)
**Funcionalidad:**
-   **Directorio:** Lista de personas de contacto u organizadores.
-   **Datos:** Almacena nombre, email, teléfono y rol.

## 3. Código Fuente

El código fuente completo está disponible públicamente en el siguiente repositorio:

**Repositorio GitHub:** [INSERTE_URL_DEL_REPOSITORIO_AQUI]

*Nota: Asegúrese de que el repositorio sea público para su validación.*

## 4. Evidencias de Ejecución

Esta sección debe completarse con capturas de pantalla de la aplicación corriendo en el entorno desplegado (Vercel).

**URL del Proyecto:** [INSERTE_URL_VERCEL_AQUI]

### Capturas Sugeridas:
1.  **Home/Dashboard:** Vista general cargada.
2.  **Eventos:** Tabla de eventos llena.
3.  **Modal/Formulario:** Pantalla de creación abierta.
4.  **Base de Datos:** Captura del panel de Supabase (opcional pero recomendada para mostrar datos reales).
