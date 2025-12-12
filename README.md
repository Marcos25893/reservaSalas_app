# INSTRUCCIONES DESPLIGUE APLICACION

### Para poder desplegar la aplicación es muy sencillo, la maquina consta de una ip elastica o ip fija, por lo que no es necesario tener en cuenta la ip cuando se encienda porque será la misma que en este documento. 

1. ENTRAR EN AWS ACADEMY
- Entrar en aws learner lab y encender la maquina llamada “ ubuntu “ 
2. CONECTARSE A LA INSTANCIA
- Seleccionamos la instancia, "Estado de la instancia" -> Iniciar instancia. Una vez iniciada, la seleccionamos y le damos a conectar, y en el panel nos conectamos por la consola de Ec2
3. ENTRAR AL DIRECTORIO CORRESPONDIENTE
- Una vez en la instancia hacemos un " ls " para listar los archivos, y nos encontramos con dos archivos llamados “ practica3-incidencias” y “ reservaSalas_ap” entramos en reservaSalas_ap.
4. INICIAR BASE DE DATOS
- Una vez dentro arrancamos la bbdd en podman con el comando “podman start mariadb_lv”
5. INICIAR EL SERVIDOR
- Tras esto ya solo queda un ultimo paso tras arrancar la base de datos, ejecutamos el siguiente comnado para poder iniciar “ php artisan serve --host=0.0.0.0 –port=8000 “
6. TEST
- Nos vamos al navegador y ponemos directamente en la url:  http://184.73.39.231:8000/
