# 🧵 App Web de Gestión de Inventario Textil

Aplicación web simple para gestionar rollos de tela, registrar ventas y visualizar el inventario restante.

## ✨ Funcionalidades

- Agregar nuevos rollos de tela
- Registrar ventas parciales por metros
- Ver el inventario actualizado
- Validación de stock para evitar ventas negativas

## 🛠️ Tecnologías

- PHP (sin framework)
- MySQL
- HTML + CSS (Bootstrap 5)
- JavaScript básico

## 🗃️ Estructura de la base de datos

### Tabla `rollos`

| Campo         | Tipo         |
|---------------|--------------|
| id            | INT (PK)     |
| tipo_tela     | VARCHAR(50)  |
| color         | VARCHAR(30)  |
| largo         | FLOAT        |
| fecha_ingreso | DATE         |

### Tabla `ventas`

| Campo          | Tipo         |
|----------------|--------------|
| id             | INT (PK)     |
| rollo_id       | INT (FK)     |
| metros_vendidos| FLOAT        |
| fecha_venta    | DATETIME     |

## 📦 Instalación local

1. Clona este repositorio:
   ```bash
   git clone https://github.com/S4qk/inventario_textil.git

#Nota Adicional
El historial para git lo olvide y solo hice dos specs
