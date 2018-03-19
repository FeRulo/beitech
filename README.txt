README

EJECUCIÓN.

	Desde el cmd y habiendo instalado angular/cli en la máquina, se puede correr el aplicativo escribiendo:
		ng serve --o

	En la carpeta assets se encuentra el script.sql para la creación de la base de datos con mysql. Por defecto la configuración es:
		DB_HOST=localhost
		DB_USERNAME=root
		DB_PASSWORD (sin password)
		DE_NAME= beitech

MÉTODOS apiREST

	la URL base es: http://localhost/beitech/index.php

	De la tabla order
		get: 		 	 
		 	api: /createOrder/:products/:customer/:address
	 		descripción: ingresa con método get los mapámetros productos (lista como string), el cliente y la dirección de una nueva orden

	 		api: /Order/getOrder/:user/:date
	 		descripción: lista las ordenes por cliente representado por el identificador :user y dada una fecha
	 	post: 
	 		api: /orders
	 		descripción: crea una orden en la base de datos dado un objeto json enviado en el body con estas características:
	 			{
	 				"customer_id":"valor",
					"products_id":"lista",
					"delivery_address":"dirección"
				}

	Tabla Product
		get:
			api: /Product/listProducts/:id/
			descripción: lista los productos permitidos para un cliente
			función: el id corresponde al identificador del cliente

	Tabla Customer
		get:
			api: /Customer/listCustomers
			descripción: lista de clientes
			función: devuelve lista de identificadores de cada cliente