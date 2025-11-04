# 🚀 MVC Users - Sistema CRUD con PHP y JavaScript

Un sistema completo de gestión de usuarios desarrollado con arquitectura **MVC (Modelo-Vista-Controlador)** en PHP y frontend interactivo con JavaScript modular.

## 📋 Tabla de Contenidos

- [Características](#-características)
- [Arquitectura](#-arquitectura)
- [Requisitos del Sistema](#-requisitos-del-sistema)
- [Instalación](#-instalación)
- [Configuración](#-configuración)
- [Uso](#-uso)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [API Endpoints](#-api-endpoints)
- [Tecnologías](#-tecnologías)
- [Contribuir](#-contribuir)
- [Autor](#-autor)

## ✨ Características

- ✅ **CRUD Completo**: Crear, Leer, Actualizar y Eliminar usuarios
- ✅ **Arquitectura MVC**: Separación clara de responsabilidades
- ✅ **API RESTful**: Endpoints JSON para comunicación con el frontend
- ✅ **JavaScript Modular**: Código organizado en módulos ES6
- ✅ **Interfaz Responsiva**: Diseño con Bootstrap 5
- ✅ **Configuración Externa**: Archivos `.ini` para configuración
- ✅ **Validación de Datos**: Sanitización y validación de inputs
- ✅ **Manejo de Errores**: Gestión centralizada de errores y excepciones

## 🏗️ Arquitectura

Este proyecto implementa el patrón **MVC (Modelo-Vista-Controlador)**:

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│     VISTA       │    │   CONTROLADOR   │    │     MODELO      │
│                 │    │                 │    │                 │
│ IndexView.php   │◄──►│ UserController  │◄──►│   UserModel     │
│ (Frontend HTML) │    │ (Lógica de      │    │ (Base de Datos) │
│                 │    │  Negocio)       │    │                 │
└─────────────────┘    └─────────────────┘    └─────────────────┘
         ▲                       ▲                       ▲
         │                       │                       │
         └───────────────────────┼───────────────────────┘
                                 │
                    ┌─────────────────┐
                    │   index.php     │
                    │ (Front Controller)│
                    └─────────────────┘
```

### Flujo de Datos:

1. **index.php** recibe todas las peticiones HTTP
2. **UserController** procesa la lógica de negocio
3. **UserModel** maneja las operaciones de base de datos
4. **IndexView.php** presenta la interfaz de usuario
5. **JavaScript Modules** manejan la interactividad del frontend

## 🛠️ Requisitos del Sistema

- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Servidor Web** (Apache/Nginx)
- **Navegador Web** moderno con soporte ES6

## 📦 Instalación

1. **Clonar el repositorio**

   ```bash
   git clone https://github.com/harlericho/mvc_users_php_js.git
   cd mvc_users_php_js
   ```

2. **Configurar el servidor web**

   - Apuntar el DocumentRoot a la carpeta del proyecto
   - Asegurar que PHP esté habilitado

3. **Importar la base de datos**
   ```bash
   mysql -u root -p < script/db_users_users.sql
   ```

## ⚙️ Configuración

### Base de Datos

Editar el archivo `config/init/config.ini`:

```ini
[database]
host = localhost
user = tu_usuario
password = tu_contraseña
dbname = db_users
port = 3306
driver = mysql
charset = utf8mb4
```

### Tabla de la Base de Datos

Editar el archivo `config/init/table.ini` si es necesario:

```ini
[table]
table1 = users
```

## 🎯 Uso

### Acceso a la Aplicación

1. Abrir navegador web
2. Navegar a: `http://localhost/mvc_users`
3. La interfaz principal mostrará:
   - **Formulario**: Para crear/editar usuarios
   - **Listado**: Tabla con todos los usuarios
   - **Acciones**: Botones para editar y eliminar

### Operaciones Disponibles

- **Crear Usuario**: Llenar formulario y hacer clic en "Guardar"
- **Listar Usuarios**: Se carga automáticamente al abrir la página
- **Editar Usuario**: Hacer clic en el botón "Editar" de cualquier usuario
- **Eliminar Usuario**: Hacer clic en el botón "Eliminar" de cualquier usuario
- **Limpiar Formulario**: Hacer clic en "Nuevo" para resetear el formulario

## 📁 Estructura del Proyecto

```
mvc_users/
├── 📄 index.php                 # Front Controller - Punto de entrada
├── 📄 README.md                 # Documentación del proyecto
├── 📁 app/                      # Lógica de la aplicación
│   ├── 📁 controllers/          # Controladores MVC
│   │   ├── 📄 UserController.php
│   │   └── 📄 UserControllerTest.php
│   ├── 📁 models/               # Modelos de datos
│   │   └── 📄 UserModel.php
│   └── 📁 views/                # Vistas de la aplicación
│       └── 📄 IndexView.php
├── 📁 assets/                   # Recursos estáticos
│   ├── 📁 css/                  # Estilos CSS
│   │   └── 📄 style.css
│   ├── 📁 images/               # Imágenes del proyecto
│   └── 📁 js/                   # JavaScript modular
│       ├── 📄 AppAsset.js       # Módulo principal
│       ├── 📄 CleanAsset.js     # Limpiar formularios
│       ├── 📄 CodeAsset.js      # Utilidades de código
│       ├── 📄 CreactionAsset.js # Crear/actualizar usuarios
│       ├── 📄 ListAsset.js      # Listar usuarios
│       ├── 📄 MessageAsset.js   # Manejo de mensajes
│       └── 📄 OptionsAsset.js   # Editar y eliminar
├── 📁 config/                   # Configuración
│   ├── 📄 Db.php               # Clase de conexión a BD
│   └── 📁 init/                # Archivos de configuración
│       ├── 📄 config.ini       # Configuración de BD
│       └── 📄 table.ini        # Configuración de tablas
├── 📁 routes/                   # Enrutamiento
│   └── 📄 RoutesAsset.js
├── 📁 script/                   # Scripts de base de datos
│   └── 📄 db_users_users.sql   # Script de creación de BD
└── 📁 test/                     # Pruebas
    └── 📄 test.php
```

## 🔌 API Endpoints

| Método | Endpoint                  | Descripción                | Parámetros            |
| ------ | ------------------------- | -------------------------- | --------------------- |
| `GET`  | `/?action=index`          | Cargar página principal    | -                     |
| `GET`  | `/?action=list`           | Obtener todos los usuarios | -                     |
| `POST` | `/?action=store`          | Crear nuevo usuario        | `name`, `email`       |
| `GET`  | `/?action=show&id={id}`   | Obtener usuario específico | `id`                  |
| `POST` | `/?action=update`         | Actualizar usuario         | `id`, `name`, `email` |
| `GET`  | `/?action=delete&id={id}` | Eliminar usuario           | `id`                  |

### Ejemplo de Respuesta JSON

```json
{
  "message": "Usuario creado correctamente"
}
```

```json
[
  {
    "id": "1",
    "name": "Juan Pérez",
    "email": "juan@email.com"
  }
]
```

## 🔧 Tecnologías

### Backend

- **PHP 7.4+** - Lenguaje del servidor
- **PDO** - Abstracción de base de datos
- **MySQL** - Sistema de gestión de base de datos

### Frontend

- **HTML5** - Estructura semántica
- **CSS3** - Estilos personalizados
- **Bootstrap 5** - Framework CSS responsivo
- **JavaScript ES6+** - Módulos y programación moderna
- **Fetch API** - Comunicación con el backend

### Arquitectura

- **MVC Pattern** - Separación de responsabilidades
- **Front Controller** - Punto de entrada único
- **Active Record** - Patrón de acceso a datos
- **Dependency Injection** - Inyección de dependencias

## 🤝 Contribuir

1. Fork el proyecto
2. Crear una rama feature (`git checkout -b feature/NuevaCaracteristica`)
3. Commit los cambios (`git commit -m 'Agregar nueva característica'`)
4. Push a la rama (`git push origin feature/NuevaCaracteristica`)
5. Abrir un Pull Request

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👨‍💻 Autor

**@harlericho**

- GitHub: [@harlericho](https://github.com/harlericho)
- Proyecto: [mvc_users_php_js](https://github.com/harlericho/mvc_users_php_js)

---

⭐ **¡Si te gusta este proyecto, dale una estrella en GitHub!** ⭐
