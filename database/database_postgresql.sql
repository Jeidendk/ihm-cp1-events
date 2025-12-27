-- Esquema de Base de Datos para EventMaster (PostgreSQL/Supabase)
-- Sistema de Gestión de Eventos - Tablas en Español

-- Tabla: ubicaciones (debe crearse primero por las referencias)
CREATE TABLE IF NOT EXISTS ubicaciones (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    latitude DECIMAL(10,8) NULL,
    longitude DECIMAL(11,8) NULL,
    capacity INTEGER NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tabla: contactos (debe crearse antes de eventos por las referencias)
CREATE TABLE IF NOT EXISTS contactos (
    id BIGSERIAL PRIMARY KEY,
    greeting VARCHAR(255) NULL,
    name VARCHAR(255) NOT NULL,
    identification_number VARCHAR(255) NULL,
    email VARCHAR(255) NULL UNIQUE,
    phone VARCHAR(255) NULL,
    position VARCHAR(255) NULL,
    photo_path VARCHAR(2048) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tabla: eventos
CREATE TABLE IF NOT EXISTS eventos (
    id BIGSERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    timezone VARCHAR(255) NOT NULL DEFAULT 'UTC',
    description TEXT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'planificado',
    location_id BIGINT NULL REFERENCES ubicaciones(id) ON DELETE SET NULL,
    contact_id BIGINT NULL REFERENCES contactos(id) ON DELETE SET NULL,
    has_reminder BOOLEAN NOT NULL DEFAULT FALSE,
    repetition VARCHAR(255) NULL,
    classification VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tabla: sesiones (para Laravel sessions)
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);

-- Índices
CREATE INDEX IF NOT EXISTS sessions_user_id_index ON sessions(user_id);
CREATE INDEX IF NOT EXISTS sessions_last_activity_index ON sessions(last_activity);
CREATE INDEX IF NOT EXISTS eventos_ubicacion_id_index ON eventos(location_id);
CREATE INDEX IF NOT EXISTS eventos_contacto_id_index ON eventos(contact_id);
