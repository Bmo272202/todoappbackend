# ✅ TodoApp API - Backend en Laravel 10

Este es el **backend de una aplicación tipo ToDoApp**, desarrollado con **Laravel 10** y **MySQL**, implementando **autenticación con JWT**. Es la **primera fase** del proyecto completo, enfocada exclusivamente en la creación de una API RESTful funcional y estructurada, que puede servir como **base o referencia** para desarrollar tus propias APIs.

---

## 🚀 Características

- 🔐 Autenticación con JSON Web Tokens (JWT)
- 📋 Gestión de tareas (To-Do)
- 🧑 Registro e inicio de sesión de usuarios
- 📦 Base de datos relacional con MySQL
- ✅ Código limpio y modular siguiendo buenas prácticas

---

## 🛠️ Tecnologías utilizadas

- PHP 8+
- Laravel 10
- MySQL
- JWT Auth (`tymon/jwt-auth`)
- Composer

---

## 📦 Instalación local

1. Clona el repositorio:

```bash
git clone https://github.com/tu-usuario/laravel-todoapp-api.git
cd laravel-todoapp-api
````

2. Instala las dependencias:

```bash
composer install
```

3. Crea tu archivo `.env`:

```bash
cp .env.example .env
```

4. Genera la clave de aplicación:

```bash
php artisan key:generate
```

5. Configura tu base de datos en el `.env`:

```env
DB_DATABASE=tu_basededatos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

6. Ejecuta las migraciones:

```bash
php artisan migrate
```

7. Genera el token de JWT:

```bash
php artisan jwt:secret
```

8. Inicia el servidor de desarrollo:

```bash
php artisan serve
```

---

## 📌 Endpoints principales

### 🧾 Autenticación (públicos)

| Método | Ruta          | Descripción         |
| ------ | ------------- | ------------------- |
| POST   | /userRegister | Registro de usuario |
| POST   | /userLogin    | Inicio de sesión    |

---

### 🔐 Rutas protegidas (requieren token JWT)

Prefix: `/auth/`
Header: `Authorization: Bearer {token}`

| Método | Ruta               | Descripción                |
| ------ | ------------------ | -------------------------- |
| GET    | /auth/userProfile  | Obtener perfil del usuario |
| GET    | /auth/refreshToken | Refrescar token JWT        |
| GET    | /auth/userLogout   | Cerrar sesión              |

---

### 📋 Gestión de tareas

| Método | Ruta            | Descripción                |
| ------ | --------------- | -------------------------- |
| POST   | /auth/task      | Crear una nueva tarea      |
| GET    | /auth/task      | Obtener todas las tareas   |
| GET    | /auth/task/{id} | Ver detalles de una tarea  |
| POST   | /auth/task/{id} | Actualizar tarea existente |
| DELETE | /auth/task/{id} | Eliminar tarea             |

> ⚠️ Todos estos endpoints están protegidos por middleware `auth:api` y requieren un token JWT válido en el header.

---

## 📘 Notas

* Esta API está diseñada para funcionar como **backend de una aplicación ToDo**.
* Puede ser utilizada como **referencia educativa o base de proyectos** propios.
* Más adelante se desarrollará el **frontend** correspondiente.

---

## 📄 Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

---

## 👨‍💻 Autor

**Brandon Moreno Ortega**
📧 [bmoreno27ortega@gmail.com](mailto:bmoreno27ortega@gmail.com)
🌐 [Portafolio](https://my-portfolio-eight-sandy-60.vercel.app)
🔗 [LinkedIn](https://www.linkedin.com/in/brandon-moreno-ortega/)

```
