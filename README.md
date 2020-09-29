## TransferenciasCripto

El proyecto web facilita la transferencia de monedas virtuales a través de la red Blockchain, en donde se conectará a un servicio web el cual hará el enlace al almacenamiento de datos a la cadena de bloques blockchain en la red.  La aplicación podrá consultar todas las transferencias realizadas por los usuarios, desde donde se mostrarán el monto de los valores transferidos, la comisión cobrada por la transacción y los destinatarios a quien ha sido realizada.

## Instalar el proyecto

# Requerimientos del sistema

1) debes tener la versión de PHP mayor o igual a la 7.2.5. 
para mas información visita la documentación oficial de Laravel: https://laravel.com/docs/7.x

2) debes tener instalado composer en tu equipo: https://getcomposer.org/

3) Debes de tener instalado git en mi caso la version de windows: https://gitforwindows.org/

# Instrucciones

- **clona el proyecto ejecutando** git clone https://github.com/fatandazdba/TransferenciaCripto.git

- **ejecuta** composer install

- copiar el archivo **".env.example"** y pegarlo con el nombre: **".env"**. 

- **ejecuta** php artisan key:generate

- **Instala ui compose package ejecutando** composer require laravel/ui

- **Instala bootstrap4 ejecutando** php artisan ui bootstrap

- **Instala bootstrap4 con autenticacio ejecutando** php artisan ui bootstrap --auth

- **Install npm ejecutando** npm install

- **Run npm ejecutando** npm run dev

- Configura la nueva base de datos modificando el archivo ".env":

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=transferencia
DB_USERNAME=root
DB_PASSWORD=

- **ojo** En la carpeta migracion corrige los unique **ejemplo** 
$table->string('name',155)->unique();

- **ejecuta** php artisan migrate:refresh --seed (En caso tengas algun problema con la DB hay un backup el cual puedes usar para crear la base)

** Editar 'trait RegistersUsers'
En el proyecto debes de buscar el metodo **register** agregar el **$request** como parametro quedando de la siguiente manera
**event(new Registered($user = $this->create($request->all(), $request)));**


**ejecuta** php artisan serve 

- Puedes hacer login con **User:admin@admin.com**   **Password:admin**
